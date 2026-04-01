<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// HOME PAGE
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->post('/', 'Home::submit');
});

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

// MOVIE SEARCH
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/movies', 'SearchController::processSearchBar', ['filter' => 'before']);
});

// MOVIE DETAIL
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/movie/(:num)', 'Detail::showDetail/$1', ['filter' => 'before:movie_details']);
    $routes->post('/movie/(:num)', 'Detail::submitComment/$1', ['filter' => 'before:movie_details']);
    $routes->post('/favorites', 'Detail::addToFavorites', ['filter' => 'before:movie_details']);
    $routes->post('/shared', 'Detail::share', ['filter' => 'before:movie_details']);
});

// FAVORITES
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/favorites', 'Favorites::showFavorites', ['filter' => 'before']);
});

// LOGOUT
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/logout', 'Logout::logout');
});



  