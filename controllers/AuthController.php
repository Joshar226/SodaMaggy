<?php 
namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;


class AuthController {

    public static function index() {
        header('location: /auth/login');
    }

    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();

            if(empty($alertas)) {
                $usuario = Usuario::where('correo', $usuario->correo);

                if(!$usuario) {
                    $alertas = Usuario::setAlerta('error', 'No se encontro el usuario');
                } else {
                    $alertas = $usuario->comprobarPass($usuario->password, $_POST['password']);
                }
            }
        }

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function registro(Router $router) {

        $usuario = new Usuario();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            //usuario ya existe
            $existeUsuario = $usuario->where('correo', $usuario->correo);
            if($existeUsuario) {
                $alertas = $usuario->setAlerta('error', 'El usuario ya existe');
            } else {
                $alertas = $usuario->validarUsuario();
            }

            if(empty($alertas)) {
                
                $usuario->hashPassword();
                
                unset($usuario->password2);

                $usuario->crearToken();

                $resultado = $usuario->guardar();

                $email = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                $email->enviarConfirmacion();

                if($resultado) {
                    header('location: /mensaje');
                }
            }
            
        }

        $router->render('auth/registro', [
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje', [
            'titulo' => 'Enviar Instrucciones'
        ]);
    }

    public static function confirmar(Router $router) {
        $token = s($_GET['token']);

        if(!$token) {
            header('location: /');
        }

        $usuario = Usuario::where('token', $token);

        if(!$usuario) {
            $body = 'No se logró confirmar la cuenta';
            $confirmado = false;
        } else {
            $body = 'Cuenta confirmada correctamente!!!';
            $confirmado = true;

            $usuario->confirmado = '1';
            $usuario->token = '';
            unset($usuario->password2);

            $usuario->guardar();

        }

        $router->render('auth/confirmar', [
            'titulo' => 'Confirmar Cuenta',
            'body' => $body,
            'confirmado' => $confirmado
        ]);
    }

    public static function olvide(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::where('correo', $_POST['correo']);

            if(!$usuario) {
                $alertas = Usuario::setAlerta('error', 'El correo no puede ir vacío');
            } else {
                $alertas = Usuario::setAlerta('exito', 'Correo Enviado Exitosamente');

                $usuario->crearToken();

                $usuario->guardar();

                $email = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                $email->enviarInstrucciones();   
            }


        }
        

        $router->render('auth/olvide', [
            'titulo' => 'Recuperar Contraseña',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router) {

        $alertas = [];
        $token = s($_GET['token']);

        if(!$token) {
            header('location: /');
        }

        $usuario = Usuario::where('token', $token);

        if(!$usuario) {
            $body = 'El token no es válido';
            $confirmado = false;
        } else {
            $confirmado = true;

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST);

                $alertas = $usuario->validarPassword();
        
                if(empty($alertas)) {
                    $usuario->hashPassword();
                    unset($usuario->password2);
                    $usuario->token = '';
                    
                    $usuario->guardar();

                    $body = 'Contraseña reestablecida correctamente';
                    $confirmado = false;   
                }
            }

            
    
        }


        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Contraseña',
            'alertas' => $alertas,
            'confirmado' => $confirmado,
            'body' => $body ?? ''
        ]);
    }
}

?>