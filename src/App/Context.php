<?php

namespace PtfDemo\App;

use PtfDemo\Core\Auth\PtfDemo as Auth;
use Ptf\Core\Session;
use Ptf\Core\Session\File as FileSession;
use Ptf\Core\Session\Memcache as MemcacheSession;
use Ptf\Core\Session\Standard as StandardSession;
use Ptf\View\Plain as PlainView;
use Ptf\View\Smarty as SmartyView;

/**
 * The demo application's context.
 */
class Context extends \Ptf\App\Context
{
    /**
     * The Auth object used by the application
     * @var \PtfDemo\Core\Auth\PtfDemo
     */
    protected $auth;

    /**
     * The application's session
     * @var \Ptf\Core\Session
     */
    protected $session;

    /**
     * Initialize the application specific settings.
     */
    protected function init(): void
    {
        //// Configure some individual routes just for demonstration purposes
        include 'routes.php';
        $this->routingTable = $routes;   // Set the included override routes

        //// Initialize the view to use (choose one)
        /* Smarty */
        // $this->view = new SmartyView($this->getConfig('ViewSmarty'), $this);
        /* Plain PHP */
        $this->view = new PlainView($this->getConfig('ViewPlain'), $this);   // You may omit this line, the Plain view is used as a fallback anyway

        //// Initialize the session to use (choose one)
        /* Memcached */
        // $this->session = MemcacheSession::getInstance();
        // $this->session->init($this->getConfig('SessionMemcache'), $this);
        /* File system storage */
        // $this->session = FileSession::getInstance();
        // $this->session->init($this->getConfig('SessionFile'), $this);
        /* Standard PHP */
        $this->session = StandardSession::getInstance();
        $this->session->init($this->getConfig('Session'), $this);

        $this->session->start();
    }

    /**
     * Get the application's namespace.
     *
     * @return string  The namespace of the application
     */
    public function getAppNamespace(): string
    {
        return 'PtfDemo';
    }

    /**
     * Get the name of the default controller.
     *
     * @return string  The name of the default controller
     */
    public function getDefaultControllerName(): string
    {
        return 'Show';
    }

    /**
     * Get the application's session.
     *
     * @return Session  The session object
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * Get the application's authentication object.
     *
     * @return Auth  The Auth object
     */
    public function getAuth(): Auth
    {
        if ($this->auth === null) {
            $this->auth = Auth::getInstance();
            $this->auth->init($this->getConfig('AuthDB'), $this->session, $this);
        }

        return $this->auth;
    }
}
