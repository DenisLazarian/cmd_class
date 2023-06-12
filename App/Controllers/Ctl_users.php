<?php
namespace App\Controllers;

use App\Models\Mdl_users;
use PragmaRX\Google2FA\Google2FA;
// use PragmaRX\Google2FA\Google2FA;

class Ctl_users
{

    /**
     * 
     * Muestra la vista con el listado de usuarios
     * 
     * Solo para usuarios con rol de administrador.
     * 
     * @return void
     * 
    */
    public function users_list()
    {
        session_start();
        if(!checkRole('admin')){
            die("No estas logueado, o no dispones de permisos.");
        }

        $usr_model=new Mdl_users();

        $info_guests = $usr_model->getAllGuests();

        $users = $info_guests;

        include 'app/views/private.php';
    }

    /**
     * 
     * Muestra el formulario de edicion de usuario.
     * 
     * Solo para usuarios con rol de administrador.
     * 
     * 
     * @param int $id
     * @return void
     * 
    */
    public function edit($id){
        session_start();
        if(!checkRole('admin')){
            die("No estas logueado, o no dispones de permisos.");
        }

        $usr_model=new Mdl_users();

        $user = $usr_model->getUserById($id);

        include 'app/views/private.php';
    }

    /**
     * Funcion que actualiza los datos de un usuario
     * 
     * Solo para usuarios con rol de administrador
     * 
     * @param int $id
     * @return void
    */
    public function update_user($id){
        session_start();
        if(!checkRole('admin')){
            die("No estas logueado, o no dispones de permisos.");
        }

        $level = $_POST['level'];
        $usr_model=new Mdl_users();

        if(!checkP("action", "update_user")){
            die("Accion no valida");
        }
        elseif(!$_POST['mail']){
            die("No se ha especificado un mail");
        }
        elseif(!$_POST['name']){
            die("No se ha especificado un nombre");
        }
        elseif(!$_POST['surname']){
            die("No se ha especificado un apellido");
        }
        elseif(!$_POST['age']){
            die("No se ha especificado una edad");
        }
        elseif(!$_POST['level']){
            $level=0;
        }
        elseif($level > 10){
            $level=10;
        }

        $mail = $_POST['mail'];

        if(checkIfValidMail($_POST['mail'])){
            $name = explode("@", $_POST['mail'])[0];
            $mail = $name."@dmail.com";
        }

        $user = [
            // "id" => $id,
            "mail" => $mail. "@dmail.com",
            "nombre" => $_POST['name'],
            "apellidos" => $_POST['surname'],
            "nivel" => $level,
            "edad" => $_POST['age'], 
        ];

        $password = $_POST['pass'];
        $password2 = $_POST['pass2'];


        if ( checkElement($password) && checkElement($password2)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $user["password"] = $password;

            if($password != $password2){
                unset($user["password"]);
            }

            $usr_model = new Mdl_users();

            $usr_model->update($id, $user);
            
            header('Location: index.php?action=users-list');
            return;
        } else {
            $usr_model = new Mdl_users();

            $usr_model->update($id, $user);
            header('Location: index.php?action=users-list');
            return;
        }
    }

    /**
     * Funcion que crea un usuario desde el panel de administración.
     * 
     * Solo para usuarios con rol de administrador.
     * 
     * @return void
    */
    public function create_user(){
        session_start();
        if(!checkRole('admin')){
            die("No estas logueado, o no dispones de permisos.");
        }

        $usr_model = new Mdl_users();

        if (checkP("action", "create_user")) {
            $username = $_POST['mail'];
            $password = $_POST['pass'];
            $password2 = $_POST['pass2'];
            $nombre = $_POST['name'];
            $apellidos = $_POST['surname'];
            $age = $_POST['age'];
            $level = $_POST['level'];

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
            elseif(empty($age)){
                $age=0;
            }elseif(empty($level) || $level <= 0 ){
                $level=0;
            }elseif( $level > 10){
                $level=10;
            }

            $mail = $username;

            if(checkIfValidMail($username)){
                $name = explode("@", $username)[0];
                $mail = $name."@dmail.com";
            }

            $user = [
                "mail" => $mail."@dmail.com",
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "nivel" => $level,
                "edad" => $age, 
            ];
            
            if ($password == $password2) {
                $password = password_hash($password, PASSWORD_BCRYPT);
                $user["password"] = $password;
                $usr_model = new Mdl_users();

                $usr_model->saveUser($user);
                
                header('Location: index.php?action=users-list');
                return;
            } else {
                die('Contraseñas no coinciden');
            }
        }
        header("Location: index.php?action=users-list");
        return;
    }

    /**
     * Funcion que elimina la sessión y redirige al index.
     * 
     * @return void
    */
    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }

    public function showURLCode(){
        session_start();

        $google2fa = new Google2FA();
        $google2fa_2 = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $code = $google2fa->generateSecretKey();

        $inlineUrl = $google2fa_2->getQRCodeInline(
            'DenisSL',
            'admin@dmail.com',
            'WKDINSMJ4OLY442C'
        );
        
        // echo $code;
        include 'App/views/main.php';
        
    }

    public function activate_2FA($action = null){
        session_start();

        if(!checkLog()){
            die("No estas logueado, o no dispones de permisos.");
        }

        $google2fa = new Google2FA();
        $google2fa_2 = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $mdl_users = new Mdl_users();

        $mdl_users->activateFA($_SESSION['user']['id']);
        $user = $mdl_users->getUser($_SESSION['user']['mail']);

        $inlineUrl = $google2fa_2->getQRCodeInline(
            'DenisSL',
            'admin@dmail.com',
            $user['codigoFA']
        );

        include 'App/views/main.php';
    }

    /**
     * Funcion que redirige al formulario de login.
     * 
     * @return void
    */
    public function login($action = null)
    {
        session_start();
        $google2fa = new Google2FA();
        $google2fa_2 = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $code = $google2fa->generateSecretKey();
        
        echo $code;
        // $google2fa_url = cus

        // $qrCodeUrl = $google2fa->getQRCodeUrl(
        //     'DenisSL',
        //     'admin@dmail.com',
        //     $code
        // );

        // $_SESSION['secret'] = $code;

        $inlineUrl = $google2fa_2->getQRCodeInline(
            'DenisSL',
            'admin@dmail.com',
            'WKDINSMJ4OLY442C'
        );

        // $google2fa_url = custom_generate_qrcode_url($qrCodeUrl);

        // die($code);

        // include 'app/views/users/log_user_form.php';
        include 'App/views/main.php';
        // header("Location: index.php?action=login");
    }

    /**
     * Función que processa la autenticación del usuario y establece la sessión de usuario.
     * 
     * @return void
    */
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
                    $google2fa = new Google2FA();

                    $user = $usr_model->getUser($username);

                    $code2fa_input = $_POST['2FACode'];
                    $codeTruth = $google2fa->verifyKey($user['codigoFA'], $code2fa_input);

                    // die( $codeTruth ? "true" : "false");

                    if($user['activeFA'] =="1" && !$codeTruth){
                        die("Codigo 2FA incorrecto");
                    }

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

    /**
     * Función que redirige al formulario de registro.
     * 
     * @return void
    */
    public function register(){
        include "App/views/users/reg_user_form.php";
    }

    /**
     * Función que processa el registro del usuario y redirige a la pantalla de login.
     * 
     * @return void
     * 
    */
    public function attempt_register(){
        $for_get_user = new Mdl_users();

        if (isset($_POST['register'])) {
            $username = $_POST['email'];
            $password = $_POST['pass'];
            $password2 = $_POST['pass2'];
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

            $google2fa = new Google2FA();
    

            $user = [
                "mail" => $mail."@dmail.com",
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "codigoFA" => $google2fa->generateSecretKey(),
                "nivel" => 0,
                "edad" => 0,
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

    /**
     * Función para eliminar usuario des del panel de administración.
     * 
     * Solo para usuarios con rol de administrador.
     * 
     * @param int $id
     * @return void
    */
    public function delete_user($id){
        session_start();
        if(!checkRole('admin')){
            die("No estas logueado, o no dispones de permisos.");
        }
        $usr_model = new Mdl_users();

        $user = $usr_model->getUserById($id);
        if($_SESSION['user']['id'] == $user['id']){
            die("No puedes borrar tu propio usuario, si estas autenticado con el mismo.");
        }

        $usr_model->delete_user($id);

        header("Location: index.php?action=users-list");
    }
}
