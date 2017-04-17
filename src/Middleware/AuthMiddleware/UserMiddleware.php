<?php

namespace App\Middleware\AuthMiddleware;

use App\Middleware\Middleware;

class UserMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (!$this->container->auth->check())
        {
            $this->container->flash->addMessage('danger', 'Zaloguj się aby dostać się do tej podstrony');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }
        
        $response = $next($request, $response);
        return $response;
    }
}