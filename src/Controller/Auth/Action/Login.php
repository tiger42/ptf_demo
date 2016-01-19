<?php

namespace PtfDemo\Controller\Auth\Action;

/**
 * The action for the "auth/login" route
 */
class Login extends \Ptf\Controller\Http\Action\Base
{
    /**
     * Execute the action
     *
     * @param   \Ptf\Core\Http\Request $request    The current request object
     * @param   \Ptf\Core\Http\Response $response  The response object
     */
    public function execute(\Ptf\Core\Http\Request $request, \Ptf\Core\Http\Response $response)
    {
        $auth = \Ptf\Application::getContext()->getAuth();

        $username = $request->getPostVar('username');
        $password = $request->getPostVar('password');

        if ($auth->login($username, $password)) {
            $this->forward('/');
        } else {
            $view = \Ptf\Application::getContext()->getView();
            $view['username'] = $username;
            $view['error']    = strlen($username) || strlen($password);
            $this->forward('show/login');
        }
    }
}
