<?php

namespace App\Routing;

use App\Models\UserModel;
use FastRoute;
use FastRoute\Dispatcher;
class Router {

    protected $routes;

    public function addRoute($httpMethod, $path, $handler)
    {
        $this->routes[] = [
            'httpMethod' => $httpMethod,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function route()
    {
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r){
            foreach($this->routes as $route)
            {
                $r->addRoute($route['httpMethod'], $route['path'], $route['handler']);
            }
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $req = [
                    'httpMethod' => $httpMethod,
                    'path' => $uri,
                    'params' => $routeInfo[2],
                    'query' => $_GET
                ];

                $xh = explode('::',$handler);
                $controller = $xh[0];
                $method = $xh[1];

                $sessionUser = null;
                if( array_key_exists('userEmail', $_SESSION) )
                {
                    $userModel = new UserModel();
                    $sessionUser = $userModel->getUserByEmail($_SESSION['userEmail']);
                }

                $controller = new $controller();
                $controller->$method();

                break;
        }
    }
}