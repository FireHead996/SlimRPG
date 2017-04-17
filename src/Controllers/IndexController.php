<?php

namespace App\Controllers;

class IndexController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'index.twig');
    }
}