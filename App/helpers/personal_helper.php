
<?php  

// Para funciones de uso general en todo el proyecto en caso que sea necessario.
    function checkG($key, $value){
        if(isset($_GET[$key]) && $_GET[$key] == $value)
        return true;
        else return false;
    }
    function checkP($key, $value){
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


    /**
     * Comprueba si el usuario esta logeado o no
     * 
     * @return boolean
    */
    function checkLog(){
        if(isset($_SESSION['user']))
        return true;
        else return false;
    }


    function checkElement($item){
       if(isset($item) && !empty($item)){
        return true;
       }
       
       return false;

    }
