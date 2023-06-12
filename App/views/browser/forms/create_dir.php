<br>
        <br>
        Posicion actual:<?=$root; ?>

            <?php 
        // if($option==="carpeta"){
            
            
            ?>
            
        <form action="index.php?action=create_directory" method="POST">
            <br>
            nombre: <input class="name" type="text" placeholder="Escribe el nombre de tu nuevo directorio" name="nuevoDir">

            

            <input type="submit" name="enviar"> 
            <br>
            <br>
            <!-- <input type="button" name="volver" value="Volver">  -->

            <?php 
                if(isset($_POST['enviar'])&& !$existe){
                    echo "<p class='text-success'>Directorio ".$_POST['nuevoDir']." creado con exito</p>";
                }
                if($existe){
                    echo "<p class='text-danger'>El directorio que intenta crear, ya existe o no puede tener un nombre vació.</p>";
                } 
                $i=0;
                while($i!==0){
                    header("location: index.php?action=create_directory");
                    $i++;
                }
            ?>
        </form>
        <?php echo '<a href="index.php?action=browser&nav='.str_replace($_SESSION['user']['mail'], "", $root).'"><button>Volver al explorador</button></a>';  ?> 
        

       
