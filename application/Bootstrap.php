<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Application routing
     */
    protected function _initRoutes()
    {
        require_once APPLICATION_PATH . "/configs/routes.php";
    }
}
