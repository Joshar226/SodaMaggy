<?php 
namespace Model;

class Orden extends ActiveRecord {
    protected static $tabla = 'ordenes';
    protected static $columnasDB = ['id', 'modo', 'fecha', 'hora', 'usuarioId', 'nombre'];

    public $id;
    public $modo;
    public $fecha;
    public $hora;
    public $usuarioId;
    public $nombre;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->modo = $args['modo'] ?? 0;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }
}
?>