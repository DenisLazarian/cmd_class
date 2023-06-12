<br>
    <br>
    Posicion actual:<?=$root; ?>

        
        
    <form action="index.php?action=create_file" method="POST">
        <br>
        nombre: <input class="name" type="text" placeholder="Escribe el nombre de tu nuevo archivo" name="nuevoFichero">

        <input type="submit" name="enviar2" class="mt-4"> 

        <?php 
            if(isset($_POST['nuevoFichero'])&& !$existe){
                echo "<p class='text-success'>Directorio ".$_POST['nuevoFichero']." creado con exito</p>";
            }
            if($existe){
                echo "<p class='text-danger'>El fichero que intenta crear, ya existe o no puede tener un nombre vació</p>";
            }
            
        session_abort();

        ?>
    
    </form>
    <?php echo '<a href="index.php?action=browser&nav='.str_replace($_SESSION['user']['mail'], "", $root).'"><button>Volver al explorador</button></a>';  ?> 

