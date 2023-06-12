<?php 

class Ctl_files{

    function index($action = null){
        include_once "App/helpers/personal_helper.php";
        
        include 'app/views/main.php';
    }
    
}
