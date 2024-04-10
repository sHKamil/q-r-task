<?php

namespace App\Router;

use App\Services\RequestService;

class Router
{

    private $routes = [];

    public function add($uri, $class, $class_method, $method)
    {
        $this->routes [] = [
            'uri' => $uri,
            'class' => $class,
            'class_method' => $class_method,
            'method' => $method,
            // 'authorization' => NULL
        ];
        return $this;
    }

    public function get($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'GET');
    }

    public function post($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'POST');
    }

    // public function onlyAuthorized()
    // {
    //     $this->routes[array_key_last($this->routes)]['authorization'] = true;
    // }
    
    public function route($uri)
    {
        foreach ($this->routes as $route)
        {
            if($route['uri'] === $uri)
            {
                if(RequestService::methodVerify($route['method'])) {
                    $class = new $route['class']();
                    return call_user_func([$class, $route['class_method']]);
                }
            }
        }
        return RequestService::httpResponse(404, json_encode(["message" => "Page not found"]));
    }
}