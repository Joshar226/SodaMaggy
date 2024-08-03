<?php 
namespace Controllers;

use Model\Orden;
use Model\OrdenesProductos;
use Model\TipoProducto;
use Model\Producto;
use MVC\Router;

class APIController {
    
    public static function consultarTipos(Router $router) {
        session_start();

        $tipo = TipoProducto::all();
        
        echo json_encode($tipo);
    }

    public static function consultarProductos(Router $router) {
        session_start();

        $producto = Producto::all();
        
        echo json_encode($producto);
    }

    public static function guardar() {
        $_POST['fecha'] = date('Y-m-d');
        $orden = new Orden($_POST);

        unset($orden->nombre);

        $resultado = $orden->guardar();
        $id = $resultado['id'];

        $idProductos = explode(',', $_POST['productos']);
        // debuguear($idProductos);

        foreach( $idProductos as $idProducto) {
            $args = [
                'ordenId' => $id,
                'productoId' => $idProducto
            ];
            $ordenProducto = new OrdenesProductos($args);
            $ordenProducto->guardar();
        }
        json_encode($resultado);
    }   
}
?>