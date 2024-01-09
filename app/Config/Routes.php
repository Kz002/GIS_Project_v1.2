<?php

use App\Controllers\Web;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Web::index');
$routes->setDefaultController('Web');
$routes->post('/simpan-posisi', 'LokasiController::simpanPosisi');
