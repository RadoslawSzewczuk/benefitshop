<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
 $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/*
 * --------------------------------------------------------------------
 * Auth
 * --------------------------------------------------------------------
 */
$routes->get('logout', 'Auth::logout');
$routes->get('login', 'Auth::get_login');
$routes->post('login', 'Auth::login');
$routes->get('remind_password', 'Auth::get_remind_password');
$routes->post('remind_password', 'Auth::remind_password');
$routes->get('set_new_password', 'Auth::get_set_new_password');
$routes->post('set_new_password', 'Auth::set_new_password');
$routes->post('change_password', 'Auth::change_password');
/*
 * --------------------------------------------------------------------
 */

$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Admin Group
 * --------------------------------------------------------------------
 */
$routes->group( 'admin', ['filter' => 'isAdmin'], function( $routes ){
    $routes->get('', 'Admin\Orders::index');
    $routes->get('orders', 'Admin\Orders::orders');

    $routes->get('users', 'Admin\Users::index');
    $routes->post('get_distributors_for_select', 'Admin\Users::get_distributors_for_select');
    $routes->post('add_user', 'Admin\Users::add_user');
});
/*
 * --------------------------------------------------------------------
 */

/*
 * --------------------------------------------------------------------
 * User
 * --------------------------------------------------------------------
 */
$routes->group( '', ['filter' => 'isLogged'], function( $routes ){
    $routes->get('', 'User\Desktop::index');
});
/*
 * --------------------------------------------------------------------
 */

/*
 * --------------------------------------------------------------------
 * Tests
 * --------------------------------------------------------------------
 */
$routes->get('/test/(:any)', 'Test::test_views/$1');
/*
 * --------------------------------------------------------------------
 */

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
