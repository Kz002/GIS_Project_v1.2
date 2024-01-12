<?php

use App\Controllers\Web;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Auth::Login');
$routes->setDefaultController('Home');
$routes->post('/simpan-posisi', 'LokasiController::simpanPosisi');
