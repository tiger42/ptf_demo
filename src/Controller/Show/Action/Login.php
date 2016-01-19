<?php

namespace PtfDemo\Controller\Show\Action;

/**
 * The action for the "show/login" route
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
        $context = \Ptf\Application::getContext();
        $view = $context->getView();

        $view->setTemplateName('login.tpl');
    }
}
