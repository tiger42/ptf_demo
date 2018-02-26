<?php

namespace PtfDemo\Controller\Article\Action;

use PtfDemo\App\Context;
use PtfDemo\Core\Auth\PtfDemo as Auth;
use PtfDemo\Model\DB\Table\BlogEntries as BlogEntriesTable;
use Ptf\Controller\Http\Action\Base as BaseAction;
use Ptf\Core\Exception\DBQuery as DBQueryException;
use Ptf\Core\Http\{Request, Response};

/**
 * The action for the "article/save" route.
 */
class Save extends BaseAction
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

        $view = $context->getView();

        if (!$this->saveData($request, $auth, $context)) {
            $view['saveSuccess'] = false;
            $this->forward('edit');
        } else {
            $view['saveSuccess'] = true;
            $this->forward('show/blog');
        }
    }

    /**
     * Save the POST data from the edit form to the database.
     *
     * @param Request $request  The current request object
     * @param Auth    $auth     The application's authentication object
     * @param Context $context  The application's context
     *
     * @return bool  Could the data be saved?
     */
    private function saveData(Request $request, Auth $auth, Context $context): bool
    {
        // Get the POST data from the "blogEntry" namespace
        $data = $request->getPostVars('blogEntry');

        // Fetch the user ID from the logged in user
        $userId = $auth->getUserId();

        $blogEntries = new BlogEntriesTable($context);

        // Transfer all form data to the DB table object at once
        $blogEntries->fromArray($data, function ($value) {
            return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5);
        });
        $blogEntries['user_id'] = $userId;

        try {
            if (is_numeric($data['id'])) {
                $blogEntries->update('id = ' . $data['id']);   // Update the record with the given user ID
            } else {
                $blogEntries['created_at'] = \Ptf\Util\now();
                $blogEntries->insert();   // Insert a new record
            }
        } catch (DBQueryException $e) {
            return false;
        }

        return true;
    }
}
