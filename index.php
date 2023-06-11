<?php
/* Block time: 20221205 20:31:49*/
use App\Controllers\Ctl_mail;
use App\Controllers\Ctl_users;
use App\Controllers\Ctl_main;


define('MVC_APP','APP');

// Auto loader de classes, l'arxiu mateix nom que la classe

// Autoload via funció
// spl_autoload_register(function ($class_name) {
//   include $class_name . '.php';
// });


// Autoload via classe 
require __DIR__ . '/Loader.php';
Loader::init( );    // definir carpeta on cercar -> Loader::init(__DIR__.'/src' );


include_once "app/config/db.php";
include_once "app/helpers/personal_helper.php";



/********* MANAGE ROUTES AND ACTIONS **************************/



if (checkGetController("action", "users")) //mostra una pagina concreta
{
  $usr=new Ctl_users();
  $usr->users_list();

}elseif(checkGetController("action", "login")) { // formulario de login
  // $usr=new Ctl_users();
  // $main->default_page("login");
  $main=new Ctl_main();
  $main->default_page("login");

  // $usr->user();
}elseif(checkGetController("action", "logout")) {
  $usr=new Ctl_users();
  $usr->logout();

}elseif(checkGetController("action", "register")) { // formulario de registro
  $main=new Ctl_main();
  $main->default_page("register");

}elseif(checkGetController("action", "attempt_register")) { // proceso de registro
  
  $usr=new Ctl_users();
  $usr->attempt_register();

}elseif(checkGetController("action", "attempt_login")) { // proceso de login
  
  $usr=new Ctl_users();
  $usr->attempt_login();

}elseif(checkGetController("action", "mail-list")) { // Portal privado de usuario
  // echo "mail-list";
  $mail=new Ctl_mail();
  $mail->mail_list('mail-list');

}elseif(checkGetController("action", "redactar_mail")) { // Portal privado de usuario
  // echo "mail-list";
  $mail=new Ctl_mail();
  $mail->new_mail();

}elseif(checkGetController("action", "show_mail")) { // Portal privado de usuario
  // echo "mail-list";
  $mail=new Ctl_mail();
  $mail->show_mail($_GET['id']);


}elseif(isset($_POST['action'] ) && $_POST['action'] == "respond_mail") { // Portal privado de usuario
  $mail=new Ctl_mail();
  $mail->respond_mail($_GET['emisor_id']);

} else { //Si no existeix GET o POST -> mostra la pagina principal
  $main=new Ctl_main();
  $main->default_page();
}
