<?php

namespace PtfDemo\Controller\Show\Action;

use PtfDemo\App\Context;
use PtfDemo\Model\DB\Table\BlogEntries as BlogEntriesTable;
use Ptf\Controller\Http\Action\Base as BaseAction;
use Ptf\Core\Http\{Request, Response};
use Ptf\View\Helper\Pagination;

/**
 * The action for the "show/blog" route.
 */
class Blog extends BaseAction
{
    /**
     * Maximum number of blog entries to display per page
     */
    const MAX_ENTRIES_PER_PAGE = 3;

    /**
     * Execute the action.
     *
     * @param Request  $request   The current request object
     * @param Response $response  The response object
     */
    public function execute(Request $request, Response $response): void
    {
        $context = \Ptf\Application::getContext();
        $session = $context->getSession();

        $page = $request->getGetVar('page');
        if (!strlen($page)) {
            $page = $session->page;
        }
        if (!is_numeric($page)) {
            $page = 1;
        }
        $session->page = $page;

        $this->displayBlog($context, $page);
    }

    /**
     * Display the blog articles, initialize the pagination.
     *
     * @param Context $context  The application's context
     * @param int     $page     The page to display
     */
    private function displayBlog(Context $context, int $page): void
    {
        $view = $context->getView();

        $blogEntries = new BlogEntriesTable($context);

        // Determine the number of blog entries
        $entryCount = $blogEntries->count();
        $blogEntries->clear();   // Reset the query settings
        $view['entryCount'] = $entryCount;

        $blogEntries
            ->joinUsers()
            ->setOrder('created_at', 'desc')
            ->setAlias('id', 'be_id');

        if ($entryCount) {
            // Initialize pagination if necessary
            if ($entryCount > self::MAX_ENTRIES_PER_PAGE) {
                $pagination = new Pagination($page, self::MAX_ENTRIES_PER_PAGE, $entryCount);
                $view['pagination'] = $pagination;   // This assignment is needed by the view's pagination plugins
                $offset = $pagination->getOffset();
                $view['showPagination'] = true;
            } else {
                $offset = 0;
                $view['showPagination'] = false;
            }

            $view['blogEntry'] = $blogEntries;   // Assign blog entries to the view
            $view['offset']    = $offset;
            $view['count']     = self::MAX_ENTRIES_PER_PAGE;
        } else {
            $view['showPagination'] = false;
        }

        $view['loggedIn'] = $context->getAuth()->checkAuth();

        $suffix = ($view instanceof \Ptf\View\Plain) ? '.php' : '';
        $view->setTemplateName('index.tpl' . $suffix);
    }
}
