<?php

require __DIR__.'/../vendor/autoload.php';

use App\Core\View;
use App\Core\Database;
use App\Core\Environment;

// Middlewares
use \App\Http\Middlewares\RequireAdminLogin;
use \App\Http\Middlewares\RequireAdminLogout;
use \App\Http\Middlewares\Queue as MiddlewareQueue;

Environment::load(__DIR__.'/../');

if(getenv('APP_DEBUG')) {
  ini_set('display_errors', 1); 
  ini_set('display_startup_errors', 1); 
  error_reporting(E_ALL);
}


Database::config(
  getenv('DB_HOST'),
  getenv('DB_NAME'),
  getenv('DB_USER'),
  getenv('DB_PASS'),
  getenv('DB_PORT')
);

define('ROOT', dirname(__DIR__));

define('URL', getenv('BASE_URL'));

define('URL_ADMIN', getenv('BASE_URL').'/admin');

// Definindo o mapeamento de middlewares
MiddlewareQueue::setMap([]);

View::init([
  'URL' => URL
]);
