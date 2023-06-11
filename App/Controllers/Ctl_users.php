<?php
namespace App\Controllers;

use App\Models\Mdl_users;

class Ctl_users
{

    public function users_list()
    {
        $usr_model=new Mdl_users();

        $info_guests = $usr_model->getAllGuests();

        include 'app/views/users/page.php';
    }


    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }

    public function login()
    {
        // include 'app/views/users/log_user_form.php';
        header("Location: index.php?action=login");
    }

    public function attempt_login(){
        session_start();
        $usr_model = new Mdl_users();

        if (isset($_POST['login'])) {
            $username = $_POST['email'];
            $password = $_POST['pass'];

            if(!checkIfValidMail($username) || empty($username)){
               die("No es un email valido o no puede estar vacio.");
            } 
            $user = $usr_model->getUser($username);

            if ($user) {
                if (password_verify($password, $user['contraseña'])) {
                    $_SESSION['user'] = $user;

                    header('Location: index.php?action=mail-list');
                    return;
                } else {
                    die('Contraseña incorrecta');
                }
            } else {
                die('Usuario no existe');
            }
        }
        header('Location: index.php?action=login');
        return;
    }

    public function register(){
        include "App/views/users/reg_user_form.php";
    }

    public function attempt_register(){
        $for_get_user = new Mdl_users();

        if (isset($_POST['register'])) {
            $username = $_POST['email'];
            $password = $_POST['pass'];
            $password2 = $_POST['pass'];
            $nombre = $_POST['name'];
            $apellidos = $_POST['surname'];

            if(empty($nombre)){
                die("El nombre no puede estar vacio");
            } 
            elseif(empty($apellidos)){
                die("El surname no puede estar vacio");
            } 
            elseif(empty($username)){
                die("El username no puede estar vacio");
            } 
            elseif(empty($password) ){
                die("El password no puede estar vacio");
            } 
            elseif(empty($password2)){
                die("El campo de segunda contraseña no puede estar vacio");
            } 

            $mail = $username;

            if(checkIfValidMail($username)){
                $name = explode("@", $username)[0];
                $mail = $name."@dmail.com";
            }

            $user = [
                "mail" => $mail."@dmail.com",
                "nombre" => $nombre,
                "apellidos" => $apellidos
            ];
            
            if ($password == $password2) {
                $password = password_hash($password, PASSWORD_BCRYPT);
                $user["password"] = $password;
                $usr_model = new Mdl_users();
                $usr_model->saveUser($user);
                
                header('Location: index.php?action=login');
                return;
            }else{
                die("Las contraseñas no coinciden");
            }
        }

        header("Location: index.php?action=register");
        return;
    }
}
