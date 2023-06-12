<?php 

namespace App\Controllers;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class Ctl_files{

    function index($action = null){
        session_start();

        if(!checkLog()){
            die("necessita una session para acceder a esta pagina");
        }

        $root = realpath("App/views/Explorador_de_archivos/".$_SESSION['user']['mail']."/");

        if(!file_exists("App/views/Explorador_de_archivos/".$_SESSION['user']['mail']."/")){
            mkdir("App/views/Explorador_de_archivos/".$_SESSION['user']['mail']."/");
        }
        // $zona_restringida = realpath("../../../htdocs");
        $dir_actual = $root;


        if(isset($_GET["nav"])){
            // echo "algo pasa 1";
            $dir_actual = realpath($dir_actual. "/". $_GET["nav"]."/");
        
            if( stripos($dir_actual, $root ) === FALSE)
                $dir_actual = $root;
        }
        
        // include 'app/views/Explorador_de_archivos/browser.php';

        include "App/views/private.php";
    }

    public function crear_fichero($action = null){
        session_start();

        if(!checkLog()){
            die("necessita una session para acceder a esta pagina");
        }

        $root = $_SESSION["ruta"];

        $existe=false;

        $nombre_carpeta="";
        if(isset($_POST["nuevoFichero"])){
            $nombre_carpeta = $_POST["nuevoFichero"];
        }  

        $nuevofile=  "App/views/Explorador_de_archivos/".$root."\\".$nombre_carpeta;

        if(!file_exists($nuevofile)){
            
            fopen($nuevofile, "w");
            // fclose($nuevofile);
        }else{
            if(isset($_POST["enviar2"]))
                $existe=true;
        }

        include "App/views/private.php";
    }

    public function crear_carpeta($action = null){

        session_start();

        if(!checkLog()){
            die("necessita una session para acceder a esta pagina");
        }
        $root = $_SESSION["ruta"];
        $existe=false;

        $option="";

        // echo "<div>".$_POST["nuevoDir"];

        $nombre_carpeta="";
        if(isset($_POST["nuevoDir"])){
            $nombre_carpeta = $_POST["nuevoDir"];
        }  
        
        $nuevoDir= "App/views/Explorador_de_archivos/".$root."\\".$nombre_carpeta;

        // echo $nuevoDir;

        if(!file_exists($nuevoDir))
            mkdir($nuevoDir, 0777);
        else{
            if(isset($_POST["enviar"]))
                $existe=true;
        }
        include "App/views/private.php";
    }


    public function delete_item(){
        session_Start();

        if(!checkLog()){
            die("necessita una session para acceder a esta pagina");
        }
        
        if(isset($_GET["nav"])){
            $root = "App/views/Explorador_de_archivos/".$_SESSION['user']['mail'].$_GET["nav"];
            echo $root;
        }
        
        if(isset($_GET["root"])){
            $root2 = $_GET["root"];
        }
        
        if(isset($_GET["arch"])){
            $tipo = $_GET["arch"];
        }
        
        // echo $root;
        // echo $root2;
        
        if($tipo=="fichero"){
            unlink($root);
            echo "borrado fichero";
        
        }elseif($tipo ==="carpeta"){
            $this->rmDir_rf($root);
            
            // rmdir($root);
            // echo "borrado carpeta";
        }else{
            echo "algo pasa";
        }
        header("location:index.php?action=browser&nav=".$root2);
    }

    function rmDir_rf($root)
    {
    // $a = scandir($root);
        foreach(glob($root . "/*") as $archivos_carpeta){             
            if (is_dir($archivos_carpeta)){
                $this->rmDir_rf($archivos_carpeta);
            } else {
                unlink($archivos_carpeta);
            }
        }
        rmdir($root);
    }

    public function zip(){
        session_start();

        if(!checkLog()){
            die("necessita una session para acceder a esta pagina");
        }
        
        if(!isset($_GET['nav']) || empty($_GET['nav'])) die("No hay archivos seleccionados para enviar a zip.");
        
        // echo $_GET['nav'];
        // echo '<br>';
        
        $file_name= "App\\views\\Explorador_de_archivos\\".$_SESSION['user']['mail'];
        
        
        
        if(!file_exists($file_name."/uploads")){
            mkdir($file_name."/uploads", 0777);
        }
        
        $zip = new ZipArchive();
        
        //abrimos el archivo y lo preparamos para agregarle archivos
        $ok = $zip->open($file_name."\uploads\\".$_GET['fichero'].".zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);
        
        
        
        //indicamos cual es la carpeta que se quiere comprimir
        $origen = realpath($file_name.$_GET['nav']);
        
        //Ahora usando funciones de recursividad vamos a explorar todo el directorio y a enlistar todos los archivos contenidos en la carpeta
        if(is_dir($origen)){
        
        $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($origen),
                    RecursiveIteratorIterator::LEAVES_ONLY
        );
        
        //Ahora recorremos el arreglo con los nombres los archivos y carpetas y se adjuntan en el zip
        foreach ($files as $name => $file)
        {
            
            if (!$file->isDir())
            {
                
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($origen) + 1);
                $zip->addFile($filePath, $relativePath);
            }
            elseif ($file->isDir()){
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($origen) + 1);
                // Añade la carpeta al archivo zip
                $zip->addEmptyDir($relativePath);
            }
        }
        }elseif(is_file($origen)){
            $zip->addFile($origen, basename($origen));
        }
        //Se cierra el Zip
        $zip -> close();
        
        header("location: index.php?action=browser&nav=\\uploads");  // despres de decarregar el zip, arribar al lloc de forma automatica per descarregar el zip.
        
    }

    public function copy_item(){
        session_start();
        if(!checkLog()){
            die("necessita una session para acceder a esta pagina");
        }
        // El archivo que se quiera guardar
        if(isset($_GET["nav"]))
            $source ="App/views/Explorador_de_archivos/".$_SESSION['user']['mail'].$_GET['nav'];
    
        if(isset($_GET["arch"]))
            $tipo = $_GET["arch"];
    
        if(isset($_GET["root"]))
            $ruta_anterior = $_GET["root"];
    
        if(isset($_GET["fichero"]))
            $file = $_GET["fichero"];

        $destination = "App/views/Explorador_de_archivos/".$_SESSION['user']['mail']."/directory_copias";  // se trata de un destino fijo
        
        //El destino donde se guardara la copia
        if(!file_exists($destination)){
            mkdir($destination, 0777);
        }
        // echo $source;
        
        if(is_dir($destination)){
            $this->copiarDeDirectoris($source, $destination);
        }
        
        // header("locarion: index.php?action=browser&nav=". $ruta_anterior );
        
            //  Funció que crea directoris amb els seus archius, en cas que en tingui, de forma recursiva.
    }

    function copiarDeDirectoris( $source, $destination ) {
        global $tipo;
        global $file;
        // echo "funciona";
        if($tipo ==="Carpeta"){
            foreach(glob($source . "/*") as $archivos_carpeta){             
                if (is_dir($archivos_carpeta)){
                    $destino_dir=str_replace($source, $destination, $archivos_carpeta);

                    $this->copiarDeDirectoris($archivos_carpeta, $destino_dir);
                } else {
                    $archivo_copiar=str_replace($source, $destination, $archivos_carpeta);
                    copy($archivos_carpeta, $archivo_copiar );
                }
            }
        }elseif($tipo ==="fichero"){
            copy($source, $destination."\\".$file);
        }
        header("location: index.php?action=browser&nav=\directory_copias");
    }
}
