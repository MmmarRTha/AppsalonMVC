<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController 
{
    public static function login(Router $router) 
    {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $auth = new Usuario($_POST);
            $alertas = $auth->validateLogin();
        }
        
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout() 
    {
        echo "Desde Logout";
    }

    public static function forgot(Router $router) 
    {
        $router->render('auth/forgot-password', [

        ]);
    }

    public static function recover() 
    {
        echo "Desde Recover";
    }

    public static function create(Router $router) 
    {
        $usuario = new Usuario;

        //Alertas vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validateNewAccount();

            //Revisar alerta vacia
            if(empty($alertas))
            {
               $resultado = $usuario->userExists();
               if($resultado->num_rows)
               {
                   $alertas = Usuario::getAlertas();
               } else {
                   $usuario->hashPassword();
                   $usuario->createToken();

                   $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                   $email->sendConfirmation();

                   //Create new user
                   $resultado = $usuario->guardar();
                   //dd($usuario);
                   if($resultado)
                   {
                       header('Location: /message');
                   }
               }
            }
        }

        $router->render('auth/create-account', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function message(Router $router) 
    {
        $router->render('auth/message');
    }

    public static function confirm(Router $router) 
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if(empty($usuario))
        {
            //Mostrar mensaje error
            Usuario::setAlerta('error', 'Token no válido');
        }
        else
        {
            //Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Tu cuenta ha sido confirmada correctamente.');
        }

        //Obtener alertas
        $alertas = Usuario::getAlertas();

        //Renderizar la vista
        $router->render('auth/confirm-account', [
            'alertas' => $alertas
        ]);
    }
}