<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController 
{
    public static function login(Router $router) 
    {
        $router->render('auth/login');
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
                   dd($usuario);
               }
            }
        }

        $router->render('auth/create-account', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}