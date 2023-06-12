
<?php  

// Para funciones de uso general en todo el proyecto en caso que sea necessario.
    
    /**
     * Comprueba si el elemento esta definido y no esta vacio, pero solo para variables tipo $_GET.
     * 
     * @param string $key
     * @param string $value
     * @return boolean
     * 
    */
    function checkG($key, $value){
        if(isset($_GET[$key]) && $_GET[$key] == $value)
        return true;
        else return false;
    }

    /**
     * 
     * Comprueba si el elemento esta definido y no esta vacio, pero solo para variables tipo $_POST.
     * 
     * @param string $key
     * @param string $value
     * @return boolean
    */
    function checkP($key, $value){
        if(isset($_POST[$key]) && $_POST[$key] == $value)
        return true;
        else return false;
    }

    /**
     * Comprueba si el elemento esta definido y no esta vacio, pero solo para variables tipo $_SESSION.
     * 
     * @param string $key
     * @param string $value
     * @return boolean
    */
    function checkS($key, $value){
        // session_start();
        if(isset($_SESSION[$key]) && $_SESSION[$key] == $value)
        return true;
        else return false;
    }

    /**
     * Comprueba si el mail es valido.
     * 
     * @param string $mail
     * @return boolean
    */
    function checkIfValidMail($mail){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
        return true;
        else return false;
    }


    /**
     * Comprueba si el usuario esta logeado o no.
     * 
     * @return boolean
    */
    function checkLog(){
        if(isset($_SESSION['user']) && !empty($_SESSION['user']))
            return true;
        return false;
    }


    /**
     * Comprueba si el elemento esta definido y no esta vacio.
     * 
     * @param mixed $item
     * @return boolean
    */
    function checkElement($item){
        if(isset($item) && !empty($item))
            return true;
        return false;
    }


    /**
     * 
     * Comprueba si el usuario tiene el rol que se le pasa por parametro.
     * 
     * @param string $item
     * @return boolean
    */
    function checkRole($item){
        if(!checkLog())
            return false;

        if($item == 'admin'){
            if(intval($_SESSION['user']['nivel']) == 10){
                return true;
            }
        }elseif($item == 'reporter'){
            if(intval($_SESSION['user']['nivel']) >= 5 && intval($_SESSION['user']['nivel']) < 10){
                return true;
            }
        }elseif($item == 'user'){
            if(intval($_SESSION['user']['nivel']) >= 0 && intval($_SESSION['user']['nivel']) < 5){
                return true;
            }
        }
        return false;
    }
