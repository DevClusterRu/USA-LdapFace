<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->post('/', 'HomeController::tryAuth');
$routes->add('register', 'HomeController::register');
$routes->post('register', 'HomeController::tryRegister');
$routes->get('/login', 'HomeController::login'); //
$routes->get('/users', 'UsersController::index'); //
$routes->get('/serverlist', 'ServerListController::index');
$routes->get('/profile', 'ProfileController::index');
$routes->get('/logout', 'HomeController::logout');
$routes->get('/roles', 'RolesController::index');
$routes->get('/invoice', 'InvoiceController::index');
$routes->post('/delroles', 'RolesController::delRoles');
$routes->post('/delServersList', 'ServerListController::delServersList');
$routes->post('/usersOperation', 'UsersController::usersOperation');
//$routes->post('/usersOperation', 'UsersController::passwordReset');
$routes->get('/user/(:any)', 'User::index/$1');
$routes->post('/user/(:any)', 'User::index/$1');
$routes->match(['get', 'post'], 'avatar/(:segment)', 'ImageRender::index/$1');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('/migrate', 'MigrateController::index');
//$routes->get('/migrate-rollback', 'HomeController::index2');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
