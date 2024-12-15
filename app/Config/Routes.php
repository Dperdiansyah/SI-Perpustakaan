<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('auth', 'Auth::index');
$routes->get('register', 'Auth::register');
$routes->post('auth/proseslogin', 'Auth::proseslogin');
$routes->post('auth/prosesregister', 'Auth::prosesRegister');
$routes->get('logout', 'Auth::logout');

$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

$routes->group('user', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('aktif/(:num)', 'UserController::aktif/$1');
    $routes->get('nonaktif/(:num)', 'UserController::nonaktif/$1');
    $routes->get('new', 'UserController::new');
    $routes->post('create', 'UserController::create');
    $routes->get('detail/(:num)', 'UserController::detail/$1');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});

$routes->group('categories', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'CategoryController::index');
    $routes->get('new', 'CategoryController::new');
    $routes->post('create', 'CategoryController::create');
    $routes->get('edit/(:num)', 'CategoryController::edit/$1');
    $routes->post('update/(:num)', 'CategoryController::update/$1');
    $routes->get('delete/(:num)', 'CategoryController::delete/$1');
    
});

$routes->group('racks', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'RackController::index');
    $routes->get('new', 'RackController::new');
    $routes->post('create', 'RackController::create');
    $routes->get('edit/(:num)', 'RackController::edit/$1');
    $routes->post('update/(:num)', 'RackController::update/$1');
    $routes->get('delete/(:num)', 'RackController::delete/$1');
});


$routes->group('books', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'BookController::index');
    $routes->get('new', 'BookController::new');
    $routes->post('create', 'BookController::create');
    $routes->get('detail/(:num)', 'BookController::detail/$1');
    $routes->get('edit/(:num)', 'BookController::edit/$1');
    $routes->post('update/(:num)', 'BookController::update/$1');
    $routes->get('delete/(:num)', 'BookController::delete/$1');
});

$routes->group('borrowings', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'BorrowingController::index');
    $routes->get('new', 'BorrowingController::new');
    $routes->post('create', 'BorrowingController::create');
    $routes->get('detail/(:num)', 'BorrowingController::detail/$1');
    $routes->post('approve/(:num)', 'BorrowingController::approve/$1');
    $routes->get('check-return/(:num)', 'BorrowingController::checkReturn/$1');
    $routes->post('return_action/(:num)', 'BorrowingController::returnAction/$1');

});

$routes->group('returns', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ReturnController::index');
});


