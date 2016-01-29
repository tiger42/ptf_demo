<?php

namespace PtfDemo\App;

/**
 * The demo application's context
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
     * Initialize the application specific settings
     */
    protected function init()
    {
        include 'routes.php';
        $this->routingTable = $routes;   // Set our override routes

        // Initialize the view to use
//         $this->view = new \Ptf\View\Smarty($this->getConfig('ViewSmarty'), $this);
        $this->view = new \Ptf\View\Plain($this->getConfig('ViewPlain'), $this);   // You may omit this line, the Plain view is used as a fallback anyway

        // Initialize the session to use
//         $this->session = \Ptf\Core\Session\Memcache::getInstance();
//         $this->session->init($this->getConfig('SessionMemcache'), $this);
        $this->session = \Ptf\Core\Session\File::getInstance();
        $this->session->init($this->getConfig('SessionFile'), $this);

        $this->session->start();
    }

    /**
     * Get the application's namespace
     *
     * @return  string                      The namespace of the application
     */
    public function getAppNamespace()
    {
        return 'PtfDemo';
    }

    /**
     * Get the name of the default controller
     *
     * @return  string                      The name of the default controller
     */
    public function getDefaultControllerName()
    {
        return 'Show';
    }

    /**
     * Get the application's session
     *
     * @return \Ptf\Core\Session            The session object
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Get the application's authentication object
     *
     * @return    \PtfDemo\Core\Auth\PtfDemo  The Auth object
     */
    public function getAuth()
    {
        if ($this->auth === null) {
            $this->auth = \PtfDemo\Core\Auth\PtfDemo::getInstance();
            $this->auth->init($this->getConfig('AuthDB'), $this->session, $this);
        }
        return $this->auth;
    }
}
