<?php
// Application middleware

$app->add(new \App\Middleware\FormsMiddleware\ValidationErrorsMiddleware($container));

$app->add(new \App\Middleware\FormsMiddleware\OldInputMiddleware($container));

$app->add(new \App\Middleware\FormsMiddleware\CsrfViewMiddleware($container));

$app->add($container->csrf);