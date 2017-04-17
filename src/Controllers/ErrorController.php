<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'error.twig');
    }
}
