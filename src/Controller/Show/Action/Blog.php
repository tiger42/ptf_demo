<?php

namespace PtfDemo\Controller\Show\Action;

/**
 * The action for the "show/blog" route
 */
class Blog extends \Ptf\Controller\Base\Action\Base
{
    /**
     * Maximum number of blog entries to display per page
     */
    const MAX_ENTRIES_PER_PAGE = 3;

    /**
     * Execute the action
     *
     * @param   \Ptf\Core\Http\Request $request   The current request object
     * @param   \Ptf\Core\Http\Response $response The response object
     */
    public function execute(\Ptf\Core\Http\Request $request, \Ptf\Core\Http\Response $response)
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
     * Display the blog articles, initialize the pagination
     *
     * @param   \PtfDemo\App\Context $context The application's context
     * @param   integer $page                 The page to display
     */
    private function displayBlog(\PtfDemo\App\Context $context, $page)
    {
        $view = $context->getView();

        $blogEntries = new \PtfDemo\Model\DB\Table\BlogEntries($context);

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
                $pagination = new \Ptf\View\Helper\Pagination($page, self::MAX_ENTRIES_PER_PAGE, $entryCount);
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

        $view->setTemplateName('index.tpl');
    }

}
