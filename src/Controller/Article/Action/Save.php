<?php

namespace PtfDemo\Controller\Article\Action;

/**
 * The action for the "article/save" route
 */
class Save extends \Ptf\Controller\Http\Action\Base
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
     * Save the POST data from the edit form to the database
     *
     * @param   \Ptf\Core\Http\Request $request   The current request object
     * @param   \PtfDemo\Core\Auth\PtfDemo $auth  The application's authentication object
     * @param   \PtfDemo\App\Context $context     The application's context
     * @return  boolean                           Could the data be saved?
     */
    private function saveData(\Ptf\Core\Http\Request $request, \PtfDemo\Core\Auth\PtfDemo $auth, \PtfDemo\App\Context $context)
    {
        // Get the POST data from the "blogEntry" namespace
        $data = $request->getPostVars('blogEntry');

        // Fetch the user ID from the logged in user
        $userId = $auth->getUserId();

        $blogEntries = new \PtfDemo\Model\DB\Table\BlogEntries($context);
        $blogEntries->fromArray($data);   // Transfer all form data to the DB table object at once
        $blogEntries['user_id'] = $userId;

        try {
            if (is_numeric($data['id'])) {
                $blogEntries->update('id = ' . $data['id']);   // Update the record with the given user ID
            } else {
                $blogEntries['created_at'] = \Ptf\Util\now();
                $blogEntries->insert();   // Insert a new record
            }
        } catch (\Ptf\Core\Exception\DBQuery $e) {
            return false;
        }
        return true;
    }
}
