<?php 
namespace Model;

use Model\ActiveRecord;

class Producto extends ActiveRecord {

    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'idTipo'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $idTipo;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->idTipo = $args['idTipo'] ?? null;
    }

    public function validarProducto() {
        if(!$this->titulo) {
            self::$alertas['error'][] = 'Ingrese el titulo producto';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'Ingrese precio del Producto';
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'Ingrese una Imagen';
        }
        if(!$this->idTipo) {
            self::$alertas['error'][] = 'Seleccione el Tipo';
        }
        return self::$alertas;
    }
}
?>