<?php

namespace PtfDemo\Controller\Auth\Action;

use Ptf\Controller\Http\Action\Base as BaseAction;
use Ptf\Core\Http\{Request, Response};

/**
 * The action for the "auth/login" route.
 */
class Login extends BaseAction
{
    /**
     * Execute the action.
     *
     * @param Request  $request   The current request object
     * @param Response $response  The response object
     */
    public function execute(Request $request, Response $response): void
    {
        $context = \Ptf\Application::getContext();
        $auth    = $context->getAuth();

        $username = $request->getPostVar('username');
        $password = $request->getPostVar('password');

        if ($auth->login($username, $password)) {
            $this->forward('/');
        } else {
            $view = $context->getView();
            $view['username'] = htmlspecialchars($username, ENT_QUOTES | ENT_HTML5);
            $view['error']    = strlen($username) || strlen($password);
            $this->forward('show/login');
        }
    }
}
