<?php
namespace App\Controllers;

use App\Models\Mdl_mail;
use App\Models\Mdl_users;

class Ctl_mail
{
    public function mail_list($action = null){
        session_start();
        
        $mail_model=new Mdl_mail();
        $user_model=new Mdl_users();
        $mails = $mail_model->getAllMails($_SESSION['user']['id']);

        if(!$mails){
            $mails = [];
        }

        for ($i=0; $i < count($mails); $i++) { 
            if($mails[$i]['propietario_id'] == $_SESSION['user']['id'])
                $mails[$i]['propietario'] = "Yo";
            else
                $mails[$i]['propietario'] = $user_model->getUserById($mails[$i]['propietario_id'])['nombre'];
        }

        include 'app/views/private.php';
    }

    public function new_mail(){
        session_start();

        $mail_model = new Mdl_mail();
        $user_model = new Mdl_users();

        if(!$_POST['send-message']){
            header('Location: index.php?action=mail-list');
            return;
        }

        if(!$_POST['destinatario']){
            die("No se ha especificado un destinatario");
        }

        if(!$_POST['asunto']){
            die("No se ha especificado un asunto");
        }

        $user = $user_model->getUser($_POST['destinatario']);

        $mail = [
            'propietario_id' => $_SESSION['user']['id'],
            'destinatario_id' => $user['id'],
            'asunto' => $_POST['asunto'],
            'mensaje' => $_POST['body']
        ];

        $mail_model->saveMail($mail);

        header("Location: index.php?action=mail-list");
    }

    public function show_mail($id){
        session_start();

        $mail_model = new Mdl_mail();
        $user_model = new Mdl_users();

        $mail = $mail_model->getMailById($id);

        if($mail['propietario_id'] == $_SESSION['user']['id']){
            $mail['propietario'] = "Yo";
            $mail['propietario_mail'] = $_SESSION['user']['mail'];
        }
        else{
            $mail['propietario'] = $user_model->getUserById($mail['propietario_id'])['nombre'];
            $mail['propietario_mail'] = $user_model->getUserById($mail['propietario_id'])['mail'];
        }

        if($mail['destinatario_id'] == $_SESSION['user']['id'])
            $mail['destinatario'] = "Yo";
        else
            $mail['destinatario'] = $user_model->getUserById($mail['destinatario_id'])['nombre'];

        include 'app/views/private.php';
    }


    public function respond_mail($id){
        session_start();
        if(!$_SESSION['user']){
            die("no dispone de permisos para esta accion");
        }
        $mail_model = new Mdl_mail();
        $user_model = new Mdl_users();

        if(!$_POST['resend-message']){
            header('Location: index.php?action=mail-list');
            return;
        }

        if(!$_POST['destinatario']){
            die("No se ha especificado un destinatario");
        }

        if(!$_POST['asunto']){
            die("No se ha especificado un asunto");
        }

        $user = $user_model->getUser($_POST['destinatario']);

        if(!$user){
            die("El usuario destinatario especificado no existe");
        }

        $mail = [
            'propietario_id' => $_SESSION['user']['id'],
            'destinatario_id' => $user['id'],
            'asunto' => $_POST['asunto'],
            'mensaje' => $_POST['body'],
            'referencia' => $_POST['referencia'],
            'type' => 'response'
        ];

        $mail_model->resend_mail($mail);
        header("Location: index.php?action=mail-list");
    }
}
