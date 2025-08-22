<?php

require_once dirname( __DIR__) . '/vendor/autoload.php';

use App\Routing\Router;

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

session_start();

$router = new Router();
// Public routes
$router->addRoute('GET', '/', 'App\Controllers\PublicController::showHome');
$router->addRoute('GET', '/report-bug', 'App\Controllers\PublicController::showReport');
$router->addRoute('POST', '/report-bug', 'App\Controllers\PublicController::checkReport');
$router->addRoute('GET', '/search', 'App\Controllers\PublicController::showSearch');
$router->addRoute('GET', '/register', 'App\Controllers\AuthController::showRegister');
$router->addRoute('POST', '/register', 'App\Controllers\AuthController::handleRegister');
$router->addRoute('GET', '/login', 'App\Controllers\AuthController::showLogin');
$router->addRoute('POST', '/login', 'App\Controllers\AuthController::checkLogin');
// Authenticated User Routes
$router->addRoute('GET', '/account', 'App\Controllers\ProfileController::showProfile');
$router->addRoute('GET', '/logout', 'App\Controllers\AuthController::logout');
$router->addRoute('GET', '/new-message', 'App\Controllers\ProfileController::showNewMessage');
$router->addRoute('POST', '/new-message', 'App\Controllers\ProfileController::checkNewMessage');
// FTP Routes
$router->addRoute('GET', '/ftp', 'App\Controllers\FTPController::showFtp');
$router->addRoute('POST', '/ftp', 'App\Controllers\FTPController::checkFtpLogin');
$router->addRoute('GET', '/download', 'App\Controllers\FTPController::downloadFile');
//    $router->addRoute('GET', '/test/{id:\d+}', 'AuthController::showLogin');
//    $router->addRoute(['GET', 'POST'], '/test', 'handler');
$router->route();