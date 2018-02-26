<?php

namespace PtfDemo\Controller;

/**
 * The Controller for the "show/*" route.
 */
class Show extends \Ptf\Controller\Http
{
    /**
     * Get the name of the controller's default action.
     *
     * @return string  The name of the default action
     */
    public function getDefaultActionName(): string
    {
        return 'Blog';
    }
}
