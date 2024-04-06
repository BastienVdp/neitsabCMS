<?php 

namespace App\Core;

use App\Core\Config;
use App\Core\Router;
use App\Core\Database;

class Application 
{

	public static $rootDir;
	public static $app;

	public Config $config;
	public Database $database;
	public Request $request;
	public Response $response;
	public Router $router;
	
	public function __construct(string $path)
	{
		self::$rootDir = $path;
		self::$app = $this;

		$this->config = new Config();
		$this->database = new Database($this->config->get('database'));
		$this->request = new Request();
		$this->response = new Response();
		$this->router = new Router($this->request, $this->response);
	}

	public function run()
	{
		echo $this->router->resolve();
	}
}