<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/sign-up', 'Signup::showSignUpPage');
    $routes->post('/sign-up', 'Signup::submit');
    $routes->get('/sign-in', 'Signup::showLoginPage');
});