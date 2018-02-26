<?php

namespace PtfDemo\Controller\Auth\Action;

use Ptf\Controller\Http\Action\Base as BaseAction;
use Ptf\Core\Http\{Request, Response};

/**
 * The action for the "auth/logout" route.
 */
class Logout extends BaseAction
{
    /**
     * Execute the action.
     *
     * @param Request  $request   The current request object
     * @param Response $response  The response object
     */
    public function execute(Request $request, Response $response): void
    {
        $auth = \Ptf\Application::getContext()->getAuth();

        $auth->logout();
        $this->forward('/');
    }
}
