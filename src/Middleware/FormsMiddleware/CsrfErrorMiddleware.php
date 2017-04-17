<?php

namespace App\Middleware\FormsMiddleware;

use App\Middleware\Middleware;

class CsrfErrorMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        $this->container->flash->addMessage('danger', 'Błędna weryfikacja CSRF');
        return $response->withRedirect($this->container->router->pathFor('err'));
    }
}