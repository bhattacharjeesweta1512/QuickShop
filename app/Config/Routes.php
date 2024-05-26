<?php




namespace Config;
use CodeIgniter\Router\RouteCollection;
use CodeIgniter\HTTP\Response;
//use controller
// use App\Controllers\ControllerName;

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

// $routes->setDefaultController('Home');
// $routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::show');
$routes->post('/login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('/create', 'Product::create');
// send data to database
$routes->post('/store', 'Product::store');
// fetch data in table
$routes->get('/getProducts', 'Product::getProducts');
$routes->get('getProductDetails/(:num)', 'Product::fetchProductDetails/$1');
$routes->post('/updateProducts', 'Product::updateProducts');
$routes->get('delete/(:num)', 'Product::delete/$1');
$routes->post('uploadCSV', 'Product::uploadCSV');

/** @var RouteCollectionInterface $routes */
// used for api
$routes->group("api", function ($routes) {
    $routes->get('/', 'AuthController::show');
    $routes->post('/login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
    
    $routes->get('/create', 'Product::create');
    // send data to database
    $routes->post('/store', 'Product::store');
    // fetch data in table
    $routes->get('/getProducts', 'Product::getProducts');
    $routes->get('getProductDetails/(:num)', 'Product::fetchProductDetails/$1');
    $routes->post('/updateProducts', 'Product::updateProducts');
    $routes->get('delete/(:num)', 'Product::delete/$1');
    $routes->post('uploadCSV', 'Product::uploadCSV');
    
});


