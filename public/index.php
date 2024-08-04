<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use MVC\Router;
use Controllers\AuthController;

$router = new Router();


// Login
$router->get('/auth/login', [AuthController::class, 'login']);
$router->post('/auth/login', [AuthController::class, 'login']);

$router->get('/auth/registro', [AuthController::class, 'registro']);
$router->post('/auth/registro', [AuthController::class, 'registro']);

$router->get('/auth/mensaje', [AuthController::class, 'mensaje']);

$router->get('/auth/confirmar', [AuthController::class, 'confirmar']);

$router->get('/auth/olvide', [AuthController::class, 'olvide']);
$router->post('/auth/olvide', [AuthController::class, 'olvide']);

$router->get('/auth/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/auth/reestablecer', [AuthController::class, 'reestablecer']);


//Area de administracion
$router->get('/admin/administrar-tipos', [AdminController::class, 'administrarTipos']);

$router->get('/admin/administrar-productos', [AdminController::class, 'administrarProductos']);

$router->get('/admin/ordenes', [AdminController::class, 'ordenes']);

$router->get('/admin/orden', [AdminController::class, 'orden']);


$router->get('/admin/crear', [AdminController::class, 'crearProducto']);
$router->post('/admin/crear', [AdminController::class, 'crearProducto']);
$router->get('/admin/actualizar-producto', [AdminController::class, 'actualizarProducto']);
$router->post('/admin/actualizar-producto', [AdminController::class, 'actualizarProducto']);
$router->post('/admin/eliminar-producto', [AdminController::class, 'eliminarProducto']);


$router->get('/admin/crear-tipo', [AdminController::class, 'crearTipo']);
$router->post('/admin/crear-tipo', [AdminController::class, 'crearTipo']);
$router->get('/admin/actualizar-tipo', [AdminController::class, 'actualizarTipo']);
$router->post('/admin/actualizar-tipo', [AdminController::class, 'actualizarTipo']);
$router->post('/admin/eliminar-tipo', [AdminController::class, 'eliminarTipo']);

$router->get('/admin', [AdminController::class, 'index']);


//API
$router->get('/api/tipos', [APIController::class, 'consultarTipos']);
$router->get('/api/productos', [APIController::class, 'consultarProductos']);

$router->post('/api/guardar', [APIController::class, 'guardar']);



$router->comprobarRutas();