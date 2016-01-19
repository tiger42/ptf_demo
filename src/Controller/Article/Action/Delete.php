<?php

namespace PtfDemo\Controller\Article\Action;

/**
 * The action for the "article/delete" route
 */
class Delete extends \Ptf\Controller\Http\Action\Base
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
        $auth    = $context->getAuth();

        if (!$auth->checkAuth()) {
            $this->forward('show/login');
            return;
        }

        $id = (int)$request->getGetVar('id');
        $blogEntries = new \PtfDemo\Model\DB\Table\BlogEntries($context);
        $blogEntries['id'] = $id;
        $blogEntries->delete();   // Delete the blog entry with the set ID

        $this->forward('show/blog');
    }
}
