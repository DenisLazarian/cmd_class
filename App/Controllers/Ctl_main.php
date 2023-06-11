<?php
namespace App\Controllers;

class Ctl_main{

    function default_page($action = null){
        include_once "App/helpers/personal_helper.php";
        
        include 'app/views/main.php';
    }
    
}