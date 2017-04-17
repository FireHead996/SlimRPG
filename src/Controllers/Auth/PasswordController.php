<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;

class PasswordController extends Controller
{
    public function getChangePassword($request, $response)
    {
        return $this->view->render($response, 'auth/password/change.twig');
    }

    public function postChangePassword($request, $response)
    {
        if ($this->validator->validatePasswordChangeForm($request)->getErrorsCount() > 0) {
            $_SESSION['errors'] = $this->validator->getErrors();
            return $response->withRedirect($this->router->pathFor('auth.password.change'));
        }

        $this->auth->user()->setPassword($request->getParam('password1'));

        $this->flash->addMessage('success', 'Hasło zostało zmienione');

        return $response->withRedirect($this->router->pathFor('auth.password.change'));
    }
}
