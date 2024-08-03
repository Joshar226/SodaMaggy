<?php 
namespace Controllers;

use Model\TipoProducto;
use Model\Producto;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Orden;
use Model\OrdenesProductos;
use Model\Usuario;

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
        $fecha = $_GET['fecha'];

        $ordenes = Orden::whereNoLimit('fecha', $fecha);
        
        foreach($ordenes as $orden) {
            $usuario = Usuario::where('id', $orden->usuarioId);
            $orden->usuarioId = $usuario->nombre . " " . $usuario->apellido;
            
            if($orden->modo === "0") {
                $orden->modo = 'Local';
            } else {
                $orden->modo = 'Express';
            }

            $fechaFormateada = explode('-', $orden->fecha);
            $orden->fecha = $fechaFormateada[2] . "/" . $fechaFormateada[1] . "/" . $fechaFormateada[0];

            $horaFormateada = explode(':', $orden->hora);
            $orden->hora =  $horaFormateada[0] . ":" . $horaFormateada[1];             
        }


        
        $router->render('admin/ordenes', [
            'titulo' => 'Ordenes',
            'fecha' => $fecha,
            'ordenes' => $ordenes
        ]);
    }

    public static function orden(Router $router) {
        session_start();

        $id = $_GET['id'];

        $orden = Orden::where('id', $id);

        $usuario = Usuario::where('id', $orden->usuarioId);
        $orden->usuarioId = $usuario->nombre . " " . $usuario->apellido;
        
        if($orden->modo === "0") {
            $orden->modo = 'Local';
        } else {
            $orden->modo = 'Express';
        }

        $fechaFormateada = explode('-', $orden->fecha);
        $orden->fecha = $fechaFormateada[2] . "/" . $fechaFormateada[1] . "/" . $fechaFormateada[0];

        $horaFormateada = explode(':', $orden->hora);
        $orden->hora =  $horaFormateada[0] . ":" . $horaFormateada[1];   
        

        $ordenesProductos = OrdenesProductos::whereNoLimit('ordenId', $id); 

        $args = [];
        $total = 0;

        foreach($ordenesProductos as $ordenProducto) {
            $producto = Producto::where('id', $ordenProducto->productoId);
            $args[$producto->id][] = $producto->titulo;
            $args[$producto->id][] = $producto->precio;
        }

        foreach($args as $arg) {
            $precio = intval($arg[1]);

            $total += $precio;
        }

        $router->render('admin/orden', [
            'titulo' => 'Orden',
            'id' => $id,
            'orden' => $orden,
            'productos' => $args,
            'total' => $total
        ]);
    }
}
?>