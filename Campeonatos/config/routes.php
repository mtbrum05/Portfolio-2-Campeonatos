<?php

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    $routes->resources('TipoCampeonato', ['path' => 'tipo_campeonato']);
    $routes->resources('TipoProfissional', ['path' => 'tipo_profissional']);
    $routes->resources('Equipe', ['path' => 'equipe']);
    $routes->resources('Profissional', ['path' => 'profissional']);
    $routes->resources('EquipeProfissional', ['path' => 'equipe_profissional']);




    $routes->fallbacks(DashedRoute::class);
    
});