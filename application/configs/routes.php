<?php

$router = Zend_Controller_Front::getInstance()->getRouter();

$route = new Zend_Controller_Router_Route(
    'index/show-details/:id',
    [
        'controller' => 'index',
        'action' => 'show-details'
    ],
    [
        'id' => '\d+'
    ]
);

$router->addRoute('index/show-details/:id', $route);
