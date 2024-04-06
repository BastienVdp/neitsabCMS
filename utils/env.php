<?php

use Dotenv\Dotenv;

/**
 * 
 * Load environment variables from .env file
 * @param string $path
 * 
 */
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();