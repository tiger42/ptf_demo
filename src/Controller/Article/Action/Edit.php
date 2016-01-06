<?php

namespace PtfDemo\Controller\Article\Action;

/**
 * The action for the "article/edit" route
 */
class Edit extends \Ptf\Controller\Http\Action\Base
{
    /**
     * Execute the action
     *
     * @param   \Ptf\Core\Http\Request $request   The current request object
     * @param   \Ptf\Core\Http\Response $response The response object
     */
    public function execute(\Ptf\Core\Http\Request $request, \Ptf\Core\Http\Response $response)
    {
        $context = \Ptf\Application::getContext();
        $auth    = $context->getAuth();

        if (!$auth->checkAuth()) {
            $this->forward('show/login');
            return;
        }

        $blogEntries = new \PtfDemo\Model\DB\Table\BlogEntries($context);
        $id = $request->getGetVar('id');
        if ($id === null)  {
            $id = $request->getPostVar('blogEntry:id');
        }
        if ($id !== null) {
            $blogEntries->id = (int)$id;
            $blogEntries->fetch();   // Fetch the blog entry with the set ID
        }

        $view = $context->getView();
        $view['blogEntry'] = $blogEntries;   // Assign the blog entry to the view

        $view->setTemplateName('edit.tpl');
    }

}
