<?php 

namespace App\Core;

use App\Core\Request;
use App\Core\Response;
use App\Models\Page;

class Router
{
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $page = $this->findPageBySlug($path);

        if ($page) {
            // Afficher la page
            $this->renderPage($page);
        } else {
            // Page non trouvée
            $this->response->setStatusCode(404);
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