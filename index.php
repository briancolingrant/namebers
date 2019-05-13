<?php

//Composer
require 'vendor/autoload.php';

date_default_timezone_set('America/Chicago');

//Namespace Aliases
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// $log = new Logger('name');
// $log->pushHandler(new StreamHandler('app.txt', Logger::WARNING));

// Load Slim framework, override default Slim Views to use Twig templating
$app = new \Slim\Slim(array(
	'view' => new \Slim\Views\Twig()
));
$view = $app->view();
$view->parserOptions = array(
	'debug' => true,
);
$view->parserExtensions = array(
  new \Slim\Views\TwigExtension(),
);

//Add Slim middleware SessionCookie to persist flash messages
$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '20 minutes',
    'path' => '/',
    'domain' => null,
    'secure' => false,
    'httponly' => false,
    'name' => 'slim_session',
    'secret' => 'CHANGE_ME',
    'cipher' => MCRYPT_RIJNDAEL_256,
    'cipher_mode' => MCRYPT_MODE_CBC
)));

/* GET ROUTES */
$app->get('/', function () use ($app){
	$app->render('namebers.twig');
})->name('home');

$app->run();
