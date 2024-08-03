<?php 
namespace Controllers;

use Model\TipoProducto;
use Model\Producto;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;


class AdminController {
    public static function index(Router $router) {
        session_start();
        
        $router->render('admin/index', [
            'titulo' => "Pedido Local"
        ]);
    }

    public static function crearTipo(Router $router) {
        session_start();

        $tipo = new TipoProducto();

        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = new TipoProducto($_POST);

            $nombreImagen = md5(uniqid()) . '.jpg';

            if($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
                $tipo->setImagen($nombreImagen);
            }

            $alertas = $tipo->validarTipo();

            if(empty($alertas)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $tipo->guardar();

                $alertas = $tipo->setAlerta('exito', 'Nuevo Tipo creado correctamente');
            }
        }
        $router->render('admin/crear-tipo', [
            'titulo' => "Nuevo tipo de producto",
            'tipo' => $tipo,
            'alertas' => $alertas
        ]);
    }

    public static function crearProducto(Router $router) {
        session_start();

        $producto = new Producto();
        $alertas = [];

        $tipos = TipoProducto::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new Producto($_POST);

            $nombreImagen = md5(uniqid()) . '.jpg';

            if($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
                $producto->setImagen($nombreImagen);
            }

            $alertas = $producto->validarProducto();

            if(empty($alertas)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $producto->guardar();

                $alertas = $producto->setAlerta('exito', 'Nuevo Producto creado correctamente');
            }
        }
        $router->render('admin/crear-producto', [
            'titulo' => "Nuevo producto",
            'producto' => $producto,
            'alertas' => $alertas,
            'tipos' => $tipos
        ]);
    }

    public static function administrarTipos(Router $router) {
        session_start();

        $tipos = TipoProducto::all();

        
        $router->render('admin/administrar-tipos', [
            'titulo' => "Administracion",
            'tipos' => $tipos
        ]);
    }

    public static function administrarProductos(Router $router) {
        session_start();

        $id = $_GET['id'];

        $productos = Producto::whereNoLimit('idTipo', $id);
        
        $router->render('admin/administrar-productos', [
            'titulo' => "Administracion",
            'productos' => $productos
        ]);
    }

    public static function ordenes(Router $router) {
        session_start();
        $router->render('admin/ordenes', [
            'titulo' => 'Ordenes'
        ]);
    }
}
?>