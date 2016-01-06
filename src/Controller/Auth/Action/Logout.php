<?php

namespace PtfDemo\Controller\Auth\Action;

/**
 * The action for the "auth/logout" route
 */
class Logout extends \Ptf\Controller\Http\Action\Base
{
    /**
     * Execute the action
     *
     * @param   \Ptf\Core\Http\Request $request   The current request object
     * @param   \Ptf\Core\Http\Response $response The response object
     */
    public function execute(\Ptf\Core\Http\Request $request, \Ptf\Core\Http\Response $response)
    {
        $auth = \Ptf\Application::getContext()->getAuth();

        $auth->logout();
        $this->forward('/');
    }

}
