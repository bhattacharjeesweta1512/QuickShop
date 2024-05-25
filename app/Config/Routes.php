<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Product::create');
// send data to database
$routes->post('/store', 'Product::store');
// fetch data in table
$routes->get('/getProducts', 'Product::getProducts');

