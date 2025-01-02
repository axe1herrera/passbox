<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login/create', 'LoginController::create');
$routes->post('/login/submit', 'LoginController::submit');

$routes->get('/auth/register', 'AuthController::register');
$routes->post('/auth/registerUser', 'AuthController::registerUser');
$routes->get('/auth/login', 'AuthController::login');
$routes->post('/auth/loginUser', 'AuthController::loginUser');
$routes->get('/auth/logout', 'AuthController::logout');

$routes->get('/home', 'Home::dashboard');

// En routes.php
$routes->post('/crear_caja_fuerte', 'Home::crearCajaFuerte');

$routes->get('/tarjeta/create', 'TarjetaController::create');
$routes->post('/tarjeta/submit', 'TarjetaController::submit');

$routes->get('/identidad/create', 'IdentidadController::create');
$routes->post('/identidad/submit', 'IdentidadController::submit');

$routes->get('/nota/create', 'NotaController::create');
$routes->post('/nota/submit', 'NotaController::submit');

$routes->get('/nota/index', 'NotaController::index');
$routes->get('/nota/cargar/(:num)', 'NotaController::cargar/$1');
$routes->post('/nota/guardar/(:num)', 'NotaController::guardar/$1');
$routes->post('/nota/eliminar/(:num)', 'NotaController::eliminar/$1');

$routes->get('/identidad/cargar/(:num)', 'IdentidadController::cargar/$1');
$routes->post('/identidad/guardar/(:num)', 'IdentidadController::guardar/$1');
$routes->post('/identidad/eliminar/(:num)', 'IdentidadController::eliminar/$1');

$routes->get('/login/cargar/(:num)', 'LoginController::cargar/$1');
$routes->post('/login/guardar/(:num)', 'LoginController::guardar/$1');
$routes->post('/login/eliminar/(:num)', 'LoginController::eliminar/$1');

$routes->get('/tarjeta/cargar/(:num)', 'TarjetaController::cargar/$1');
$routes->post('/tarjeta/guardar/(:num)', 'TarjetaController::guardar/$1');
$routes->post('/tarjeta/eliminar/(:num)', 'TarjetaController::eliminar/$1');

$routes->get('buscar', 'BuscarController::buscar');
$routes->get('cajas_fuertes', 'Home::buscarCajaFuerte');

$routes->get('select-vault/(:num)', 'VaultController::selectVault/$1');
$routes->post('crear-caja-fuerte', 'Home::crearCajaFuerte');


//$routes->get('cargar-generador', 'GeneradorController::index');
//$routes->post('generate-password', 'GeneradorController::createPassword');
$routes->get('/generate-password', 'GeneradorController::index');
$routes->post('/generate-password', 'GeneradorController::createPassword');


$routes->post('tarjeta/verificar-contrasenia', 'TarjetaController::verificarContrasenia');
$routes->post('nota/verificar-contrasenia', 'NotaController::verificarContrasenia');
$routes->post('identidad/verificar-contrasenia', 'IdentidadController::verificarContrasenia');
$routes->post('login/verificar-contrasenia', 'LoginController::verificarContrasenia');

$routes->get('api/all-data', 'DataController::getAllData');
