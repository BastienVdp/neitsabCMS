<?php 

namespace App\Core;

use App\Core\Config;
use App\Core\Database;

class Application 
{

	public static $rootDir;
	public static $app;

	public Config $config;
	public Database $database;
	public Request $request;
	public Response $response;

	public function __construct(string $path)
	{
		self::$rootDir = $path;
		self::$app = $this;

		$this->config = new Config();
		$this->database = new Database($this->config->get('database'));
		$this->request = new Request();
		$this->response = new Response();
		
	}
}