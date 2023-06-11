
<?php  

// Para funciones de uso general en todo el proyecto en caso que sea necessario.
    function checkGetController($key, $value){
        if(isset($_GET[$key]) && $_GET[$key] == $value)
        return true;
        else return false;
    }
    function checkPostController($key, $value){
        if(isset($_POST[$key]) && $_POST[$key] == $value)
        return true;
        else return false;
    }

    function checkS($key, $value){
        // session_start();

        if(isset($_SESSION[$key]) && $_SESSION[$key] == $value)
        return true;
        else return false;
    }

    function checkIfValidMail($mail){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
        return true;
        else return false;
    }
