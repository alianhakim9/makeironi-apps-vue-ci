<?php

namespace Config;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'ProductController::index');
// product view
$routes->group('/product', function ($routes) {
	$routes->get('all', 'ProductController::getAllProduct');
	$routes->get('detail/(:any)', 'ProductController::productDetail/$1');
});


// Auth
$routes->post('/auth/register', 'UserController::register');
$routes->post('/auth/login', 'UserController::login');

// product JSON
$routes->get('/product-json', 'ProductController::productJSON');
$routes->get('/product-all-json', 'ProductController::getAllProductJSON');
$routes->get('/product-detail-json/(:any)', 'ProductController::productDetailJSON/$1');

// customer
$routes->get('/login', 'CustomerController::login');
$routes->get('/customer/feedback-json', 'CustomerController::feedbackJSON');
$routes->get('/customer/customer-json', 'CustomerController::customerJSON');

$routes->get('/check_user/(:any)', 'UserController::check_user/$1');


// cart
$routes->get('/cartView', 'ShoppingCartController::cart_view');
$routes->post('/cart', 'ShoppingCartController::cart');
$routes->get('/cart-detail-json', 'ShoppingCartController::get_cartJSON');
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
