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

$routes->get('/', 'HomeController::index');
$routes->get('/login', 'HomeController::login'); //
$routes->get('/logout', 'HomeController::logout');
$routes->get('/users', 'UserController::index'); //
$routes->get('/invite/(:any)', 'UserController::invite/$1'); //



$routes->get('/servers', 'ServerController::index');
$routes->get('/companys', 'CompanyController::index');
$routes->get('/services', 'ServiceController::index');
$routes->get('/profile', 'ProfileController::index');
$routes->get('/profile/invite', 'ProfileController::passwordChangeNeed');
$routes->post('/profile/bindToUser', 'ServiceController::bindToUser');
$routes->get('/roles', 'RoleController::index');
$routes->get('/invoices', 'InvoiceController::index');


$routes->post('/companysOperation', 'CompanyController::operation');
$routes->post('/serversOperation', 'ServerController::operation');
$routes->post('/usersOperation', 'UserController::operation');
$routes->post('/servicesOperation', 'ServiceController::operation');

$routes->post('/', 'HomeController::tryAuth');
$routes->post('/profile/update', 'ProfileController::changeUserInfo');
$routes->post('/profile/passwordreset', 'ProfileController::changeUserPassword');

//zoom
$routes->get('/zoom/(:any)', 'UserController::zoom/$1'); //зумирование
$routes->get('/zoomout', 'UserController::zoomOut'); //выход из зумирования

$routes->post('/delroles', 'RolesController::delRoles');
$routes->post('/serverlistOperation2', 'ServerListController::serverlistOperation2');
$routes->post('/usersOperation1', 'UsersController::usersOperation1');
$routes->post('/usersOperation2', 'UsersController::usersOperation2');
//$routes->post('/usersOperation', 'UsersController::passwordReset');
$routes->get('/user/(:any)', 'UserController::index/$1');
$routes->post('/user/(:any)', 'User::index/$1');
$routes->match(['get', 'post'], 'avatar/(:segment)', 'ImageRender::index/$1');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
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
