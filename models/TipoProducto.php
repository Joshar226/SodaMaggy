<?php 
namespace Model;

use Model\ActiveRecord;

class TipoProducto extends ActiveRecord {
    protected static $tabla = 'tipoproducto';
    protected static $columnasDB = ['id', 'titulo', 'imagen'];

    public $id;
    public $titulo;
    public $imagen;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validarTipo() {
        if(!$this->titulo) {
            self::$alertas['error'][] = 'Ingrese el titulo del Tipo';
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'Ingrese una Imagen';
        }

        return self::$alertas;
    }
}
?>