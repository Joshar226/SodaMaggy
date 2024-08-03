<?php 
namespace Model;

class OrdenesProductos extends ActiveRecord {
    protected static $tabla = 'ordenesproductos';
    protected static $columnasDB = ['id', 'ordenId', 'productoId'];

    public $id;
    public $ordenId;
    public $productoId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->ordenId = $args['ordenId'] ?? null;
        $this->productoId = $args['productoId'] ?? null;}
}
?>