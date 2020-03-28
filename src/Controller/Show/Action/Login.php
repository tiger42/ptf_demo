<?php

namespace PtfDemo\Controller\Show\Action;

use Ptf\Controller\Http\Action\Base as BaseAction;
use Ptf\Core\Http\{Request, Response};

/**
 * The action for the "show/login" route.
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
        $view    = $context->getView();

        $suffix = ($view instanceof \Ptf\View\Plain) ? '.php' : '';
        $view->setTemplateName('login.tpl' . $suffix);
    }
}
