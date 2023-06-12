<?php
/* Block time: 20221205 20:31:49*/
use App\Controllers\Ctl_mail;
use App\Controllers\Ctl_users;
use App\Controllers\Ctl_main;
use App\Controllers\Ctl_files;


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

if (checkG("action", "users")) //mostra una pagina concreta
{
  $usr=new Ctl_users();
  $usr->users_list();

}elseif(checkG("action", "login")) { // formulario de login
  // $usr=new Ctl_users();
  // $main->default_page("login");
  $main=new Ctl_main();
  $main->default_page("login");

  // $usr->user();
}elseif(checkG("action", "logout")) {
  $usr=new Ctl_users();
  $usr->logout();

}elseif(checkG("action", "register")) { // formulario de registro
  $main=new Ctl_main();
  $main->default_page("register");

}elseif(checkG("action", "attempt_register")) { // proceso de registro
  
  $usr=new Ctl_users();
  $usr->attempt_register();

}elseif(checkG("action", "attempt_login")) { // proceso de login
  
  $usr=new Ctl_users();
  $usr->attempt_login();

}elseif(checkG("action", "mail-list")) { // Portal privado de usuario
  // echo "mail-list";
  $mail=new Ctl_mail();
  $mail->mail_list('mail-list');

}elseif(checkG("action", "redactar_mail")) { // Portal privado de usuario
  // echo "mail-list";
  $mail=new Ctl_mail();
  $mail->new_mail();

}elseif(checkG("action", "show_mail")) { // Portal privado de usuario
  // echo "mail-list";
  $mail=new Ctl_mail();
  $mail->show_mail($_GET['id']);


}elseif(isset($_POST['action']) && $_POST['action'] == "respond_mail") { // Portal privado de usuario
  $mail=new Ctl_mail();
  $mail->respond_mail($_GET['emisor_id']);
  
}elseif(checkG("action", "users-list")) { // Gestor de usuarios
  $mail=new Ctl_users();
  $mail->users_list();


}elseif(checkP("action", "create_user")) { // Gestor de usuarios
  $user=new Ctl_users();
  $user->create_user();

}elseif(checkP("action", "delete_user")) { // Gestor de usuarios
  $user=new Ctl_users();
  $user->delete_user($_POST['id']);


}elseif(checkG("action", "edit_user")) { // Gestor de usuarios
  $user=new Ctl_users();
  $user->edit($_GET['id']);


}elseif(checkP("action", "update_user")) { // Gestor de usuarios
  $user=new Ctl_users();
  $user->update_user($_POST['id']);


}elseif(checkG("action", "browser")) { // Gestor de archivos
  $files=new Ctl_files();
  $files->index("browser");

}elseif(checkG("action", "create_directory")) { // Crear carpeta
  $files=new Ctl_files();
  $files->crear_carpeta("create_directory");


}elseif(checkG("action", "create_file")) { // Crear archivo
  $files=new Ctl_files();
  $files->crear_fichero("create_file");


}elseif(checkG("action", "delete_item")) { // borrar elemento, carpeta o fichero, indiferentemente. Tambien los elementos de dentro
  $files=new Ctl_files();
  $files->delete_item();

}elseif(checkG("action", "zip")) { // borrar elemento, carpeta o fichero, indiferentemente. Tambien los elementos de dentro
  $files=new Ctl_files();
  $files->zip();

}elseif(checkG("action", "copy_item")) { // borrar elemento, carpeta o fichero, indiferentemente. Tambien los elementos de dentro
  $files=new Ctl_files();
  $files->copy_item();

} else { //Si no existeix GET o POST -> mostra la pagina principal
  $main=new Ctl_main();
  $main->default_page();
}
