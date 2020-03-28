<?php

namespace PtfDemo\Controller\Article\Action;

use PtfDemo\Model\DB\Table\BlogEntries as BlogEntriesTable;
use Ptf\Controller\Http\Action\Base as BaseAction;
use Ptf\Core\Http\{Request, Response};

/**
 * The action for the "article/edit" route.
 */
class Edit extends BaseAction
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

        $blogEntries = new BlogEntriesTable($context);
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

        $suffix = ($view instanceof \Ptf\View\Plain) ? '.php' : '';
        $view->setTemplateName('edit.tpl' . $suffix);
    }
}
