<?php

namespace Ptf\Core;

/**
 * Class for handling the URL path to controller/action routing.
 *
 * This class overrides the original class from the Ptf core, just for demonstration purposes.
 * The debug echo's have been added to the original code.
 *
 * Generally it is not recommended to override any core classes, because your application
 * might break after you uprade Ptf to a newer version!
 */
class Router
{
    /**
     * Match the given route string to the corresponding controller and action
     *
     * @param   string $route               The route string to match (case insensitive)
     * @param   \Ptf\App\Context $context   The application's context
     * @return  boolean                     Was a matching controller and action found?
     */
    public static function matchRoute($route, \Ptf\App\Context $context)
    {
        echo "<b>Called route:</b> $route<br />";

        $context->getLogger()->logSys(__METHOD__, "Trying to match route: " . $route);

        $parts = self::lookup($route, $context);
        $controllerName = $parts[0];
        $actionName     = $parts[1];

        $controller = \Ptf\Controller\Factory::createController($controllerName, $context);
        try {
            $controller->dispatch($actionName);
        } catch (Exception\InvalidAction $e) {
            $context->getLogger('error')->logSys(__METHOD__, $e->getMessage(), \Ptf\Util\Logger::ERROR);
            return false;
        }
        return true;
    }

    /**
     * Match the route given in the request to the corresponding controller and action
     *
     * @param   \Ptf\App\Context $context   The application's context
     * @return  boolean                     Was a matching controller and action found?
     */
    public static function matchRequestRoute(\Ptf\App\Context $context)
    {
        $request = $context->getRequest();
        $controllerName = $request->getRequestVar('controller');
        $actionName     = $request->getRequestVar('action');

        return static::matchRoute($controllerName . '/' . $actionName, $context);
    }

    /**
     * Look up the given route in the route mapping table
     *
     * @param   string $route               The route string to look up (case insensitive)
     * @param   \Ptf\App\Context $context   The application's context
     * @return  string[]                    The mapped route if the string was found in the table
     */
    private static function lookup($route, \Ptf\App\Context $context)
    {
        $routingTable = $context->getRoutingTable();
        $route = strtolower($route);

        // We have to do this in a loop, as array_key_exists is case sensitive
        foreach ($routingTable as $source => $target) {
            if (strtolower($source) == $route) {
                $route = $target;
                $context->getLogger()->logSys(__METHOD__, "Mapping route to: " . $route);
                break;
            }
        }
        echo "<b>Mapped route:</b> $route<br />";
        return explode('/', $route);
    }

}
