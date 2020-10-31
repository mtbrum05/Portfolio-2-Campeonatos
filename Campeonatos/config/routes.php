<?php

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    $routes->setExtensions(['json']);
    // $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    // $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);


    $routes->resources('TipoCampeonato', ['path' => 'tipo_campeonato']);

    $routes->fallbacks(DashedRoute::class);
});