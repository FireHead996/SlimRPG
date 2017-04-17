<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// DIC configuration

$container = $app->getContainer();

// Twig renderer
$container['view'] = function($c)
{
    $settings = $c->get('settings')['twig'];

    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache']
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $c->router,
        $c->request->getUri()
    ));

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $c->auth->check(),
        'user' => $c->auth->user(),
    ]);

    $view->getEnvironment()->addGlobal('flash', $c->flash);

    return $view;
};

// Database connection

$settings = $container->get('settings')['db'];

$capsule = new Capsule;
$capsule->addConnection($settings);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($c)
{
    return $capsule;
};

// Controllers

$container['IndexController'] = function($c)
{
    return new \App\Controllers\IndexController($c);
};

$container['ErrorController'] = function($c)
{
    return new \App\Controllers\ErrorController($c);
};

$container['AuthController'] = function($c)
{
    return new \App\Controllers\Auth\AuthController($c);
};

$container['PasswordController'] = function($c)
{
    return new \App\Controllers\Auth\PasswordController($c);
};

// Addons

$container['validator'] = function($c)
{
    return new \App\Validation\Validator;
};

$container['csrf'] = function($c)
{
    $guard = new \Slim\Csrf\Guard;
    return $guard->setFailureCallable(new \App\Middleware\FormsMiddleware\CsrfErrorMiddleware($c));
};

$container['flash'] = function($c)
{
    return new \Slim\Flash\Messages;
};

$container['auth'] = function($c)
{
    return new \App\Auth\Auth;
};