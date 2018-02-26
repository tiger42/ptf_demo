<?php

namespace PtfDemo\Controller\Article\Action;

use PtfDemo\Model\DB\Table\BlogEntries as BlogEntriesTable;
use Ptf\Controller\Http\Action\Base as BaseAction;
use Ptf\Core\Http\{Request, Response};

/**
 * The action for the "article/delete" route.
 */
class Delete extends BaseAction
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

        if (!$auth->checkAuth()) {
            $this->forward('show/login');

            return;
        }

        $id = (int)$request->getGetVar('id');
        $blogEntries = new BlogEntriesTable($context);
        $blogEntries['id'] = $id;
        $blogEntries->delete();   // Delete the blog entry with the set ID

        $this->forward('show/blog');
    }
}
