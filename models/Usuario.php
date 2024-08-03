<?php 
namespace Model;

use Model\ActiveRecord;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'correo', 'telefono', 'password', 'confirmado', 'token', 'admin'];

    public $id;
    public $nombre;
    public $apellido;
    public $correo;
    public $telefono;
    public $password;
    public $password2;
    public $confirmado;
    public $token;
    public $admin;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;
    }

    public function validarLogin() {
        if(!$this->correo) {
            self::$alertas['error'][] = 'Ingrese su correo';
        } 
        if(!$this->password) {
            self::$alertas['error'][] = 'Ingrese su contraseña';
        }
        return self::$alertas;
    }

    public function validarUsuario() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'Ingresa tu nombre';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'Ingresa tu apellido';
        }
        if(!$this->correo) {
            self::$alertas['error'][] = 'Ingresa tu correo';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'Ingresa tu telefono';
        } else {
            if(strlen($this->telefono) < 8) {
                self::$alertas['error'][] = 'El telefono debe contener al menos 8 dígitos';
            }
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'Ingresa tu contraseña';
        } else {
            if(strlen($this->password) < 8) {
                self::$alertas['error'][] = 'La contraseña debe contener al menos 8 carácteres';
            } else {
                if(!$this->password2) {
                    self::$alertas['error'][] = 'Repite tu contraseña';
                } else {
                    if($this->password !== $this->password2) {
                        self::$alertas['error'][] = 'Las contraseñas no coinciden';
                    }
                }
            }

        }

        return self::$alertas;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'Ingresa tu contraseña';
        } else {
            if(strlen($this->password) < 8) {
                self::$alertas['error'][] = 'La contraseña debe contener al menos 8 carácteres';
            } else {
                if(!$this->password2) {
                    self::$alertas['error'][] = 'Repite tu contraseña';
                } else {
                    if($this->password !== $this->password2) {
                        self::$alertas['error'][] = 'Las contraseñas no coinciden';
                    }
                }
            }

        }
        return self::$alertas;
    }

    public function comprobarPass($hash, $pass) {

        if($this->token) {
            self::$alertas['error'][] = 'Usuario no confirmado, revisa tu correo';
            return self::$alertas;
        }

        $resultado = password_verify($pass, $hash);

        if(!$resultado) {
            self::$alertas['error'][] = 'Contraseña Incorrecta';
            return self::$alertas;
        } else {
            session_start();
            $_SESSION['id'] = $this->id;
            $_SESSION['nombre'] = $this->nombre . " " . $this->apellido;
            $_SESSION['telefono'] = $this->telefono;
            $_SESSION['login'] = true;
            if($this->admin === "1") {
                $_SESSION['admin'] = true;
                header('location: /admin');
            } else {
                header('location: /');
            }
            
        }
    }
}
?>