<?php
/**
 * Services are globally registered in this file
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Text,
    Phalcon\Mvc\Dispatcher as MvcDispatcher,
    Phalcon\Events\Manager as EventsManager;
/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a router
 */
$di['router'] = function () {

    $router = new Router();

    $router->setDefaultModule("frontend");
    $router->setDefaultNamespace("Area\Frontend\Controllers");
    
    //$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);

    $router->add("/profile/change-password", array(
        'namespace'  => 'Area\Frontend\Controllers',
        'controller' => 'profile',
        'action'     => 'changepassword'
    ));

    $router->add("/profile/recorded-lesson", array(
        'namespace'  => 'Area\Frontend\Controllers',
        'controller' => 'profile',
        'action'     => 'recordedlesson'
    ));

    $router->removeExtraSlashes(TRUE);

    return $router;
};

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di['url'] = function () {
    $url = new UrlResolver();
    $url->setBaseUri('/phalcon-starter/');
    //$url->setBaseUri('/responsive/');


    return $url;
};

/**
 * Start the session the first time some component request the session service
 */
$di['session'] = function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
};

$di['dispatcher'] = function() {

    $eventsManager = new \Phalcon\Events\Manager();

    //Attach the plugin to 'dispatch' events
    $eventsManager->attach('dispatch', new \Libraries\AnnotationsInitializer());

    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
};

$di['authorization'] = function () {
    $auth = new Libraries\Authorization();
    return $auth;
};
