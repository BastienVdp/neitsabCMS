<?php 

use Dotenv\Dotenv;
use App\Core\Application;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../utils/env.php';
require_once __DIR__ . '/../utils/functions.php';

$app = new Application(dirname(__DIR__));

