<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// SIGN UP
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/sign-up', 'Signup::showSignUpPage');
    $routes->post('/sign-up', 'Signup::submit');

});

// SIGN IN
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/sign-in', 'Signin::showLoginPage');
    $routes->post('/sign-in', 'Signin::submit'); 
});





  