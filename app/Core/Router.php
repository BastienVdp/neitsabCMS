<?php 

namespace App\Core;

use App\Core\Request;
use App\Core\Response;
use App\Http\Controllers\AdminController;
use App\Models\Page;

class Router
{
    protected $request;
    protected $response;
    protected $routes;
    protected $action;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        $this->routes = [
            'get' => [
                '/admin' => [AdminController::class, 'dashboard'],
                '/admin/login' => [AdminController::class, 'login'],
            ],
            'post' => [],
            'delete' => []
        ];
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if($this->request->startsWith('/admin')) {
            $this->resolveAdminRoutes($path, $callback);
        } else {
            $page = $this->findPageBySlug($path);
            $this->handleRoute($path, $page);
        }
    }

    protected function resolveAdminRoutes(string $path, mixed $callback)
    {
        $method = $this->request->getMethod();
        if (!$callback) {
            $callback = $this->getCallback($path, $method);
            if ($callback === false) {
                $this->response->setStatusCode(404);
                return 'Not Found';
            }
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
            $this->action = $callback[1];
            
            Application::$app->controller = $callback[0];
            // Middleware::runMiddlewares($callback[0]->middlewares);
        }
        
        return call_user_func($callback, $this->request, $this->response);
    }

    protected function getCallback(string $path, string $method): mixed
    {
        $path = trim($path, '/');
        $routes = $this->routes[$method];

        foreach ($routes as $route => $callback) {
            $route = trim($route, '/');
            
            if (preg_match(
                "@^" . preg_replace("/\{(\w+)\}/", "(\w+)", $route) . "$@", 
                $path, 
                $matches
            )
            ) {
                $routeName = $this->extractRouteNames($route);
                $values = array_slice($matches, 1);
                
                $params = array_combine($routeName, $values);
                
                $this->request->setParams($params);
                
                return $callback;
            }
        }

        return false;
    }

    private function extractRouteNames(string $route): array
    {
        preg_match_all("/\{(\w+)\}/", $route, $matches);
        return $matches[1];
    }

    protected function handleRoute(string $path, Page|null $page)
    {
        if ($page) {
            // Afficher la page
            $this->renderPage($page);
        } else {
            // Page non trouvée
            $this->response->setStatusCode(404);
            echo 'Page not found';
        }
    }

    protected function findPageBySlug($slug)
    {
        // Recherche la page correspondant au slug dans la base de données
        return Page::where('slug', $slug)->first();
    }

    protected function renderPage($page)
    {
        // Affiche le titre de la page
        echo $page->title;

        // TODO: Générer le contenu de la page en fonction du modèle de la page
    }
}