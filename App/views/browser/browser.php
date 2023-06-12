
<?php 

// include("views/plantillas/_privNavBar.php");

    $root_user = str_replace($root, "", $dir_actual);
    // echo "---". $root_user;
?>
<div class="m-5 p-3 pt-0">
        
    <h3>Explorador_de_archivos</h3>
<br>
        <h4>posicion actual: <?= $_SESSION['user']['mail'].$root_user; ?></h4>
        <br>
    <table class="table table-striped">
        <tr>
            <th>Nombre</th>
            <th>Tipo de archivo</th>
            <th> -</th>
        </tr>
        <?php 
            if (is_dir($dir_actual)){
                if ($dh = opendir($dir_actual)){
                    while (($file = readdir($dh)) !== false){
                        if($file != "."){
                            $fullpath = ($dir_actual."\\".$file);
                        ?>     
                            <tr>
                            <?php 
                            if(is_dir($fullpath)){
                                
                            ?>
                                <td>
                                    <?php
                                if($file === ".."){
                                    print  "<a href='index.php?action=browser&nav=".$root_user."\\".$file."'>";
                                    echo '<i class="bi bi-arrow-left fs-3"></i>';
                                    print '</a></td>';
                                }else{
                                    echo '<i class="bi bi-folder fs-3"></i>';
                                }
                                ?>
                                <?php if($file !==".."){ ?>
                                    <a href="index.php?action=browser&nav=<?=$root_user."\\".$file;?>"> <?=$file; ?> </a>
                                </td>
                                <td><?="Carpeta"; ?></td>
                                <?php }else { echo "<td></td>";} ?>
                                <td>
                                    <?php 
                                    if($file === ".."){
                                        // echo "algo pasa";
                                        $_SESSION['ruta']= $_SESSION['user']['mail'].$root_user; // Variable session per pasar la ruta com a parametre a formularis POST
                                        echo "<a class='btn btn-success mx-4' href='index.php?action=create_directory'> <i class='bi bi-folder-plus fs-3'></i></a>";
                                        echo "<a class='btn btn-primary' href='index.php?action=create_file'><i class='bi bi-file-plus fs-3'></i></a>";
                                    }else{
                                        $_SESSION['ruta']= $_SESSION['user']['mail'].$root_user; // Variable session per pasar la ruta com a parametre a formularis POST
                                        print "<a class='btn btn-danger mx-4' href='index.php?action=delete_item&nav=".$root_user."\\".$file."&root=".$root_user."&arch=carpeta'><i class='bi bi-folder-minus fs-3'></i></a>";
                                        print "<a class='btn btn-warning' href='index.php?action=copy_item&nav=".$root_user."\\".$file."&root=".$root_user."&arch=carpeta&fichero=".$file."'><i class='bi bi-pencil-square fs-3'></i></a>";
                                        print "<a class='btn btn-secondary mx-4' href='index.php?action=zip&nav=".$root_user."\\".$file."&root=".$root_user."&arch=carpeta&fichero=".$file."'><i class='bi bi-file-earmark-zip fs-3'></i></a>";
                                    }
                                    ?>
                                </td>
                            <?php 
                            
                            }else{
                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                // $_SESSION['ruta']= "Almacen".$root_user; // Variable session per pasar la ruta com a parametre a formularis POST

                                if($extension =="png" || $extension =="jpg" )
                                echo '<td><i class="bi bi-card-image fs-3"></i><a href="index.php?action=download_file&nav='.$root_user.'\\'.$file.' ">'.$file.'</a></td>';
                                // elseif($extension['extension'] ===null)
                                // echo '<td><img src="views/Explorador_de_archivos/imagenes/file-text.png"/><a href="download.php?nav='.$root_user.'\\'.$file.' "> '.$file.'</a></td>';
                                elseif($extension =="zip")
                                echo '<td><i class="bi bi-file-earmark-zip fs-3"></i>&#32;<a href="index.php?action=download_file&nav='.$root_user.'\\'.$file.' ">'.$file.'</a></td>';

                                else
                                echo '<td><i class="bi bi-file-text fs-3"></i><a href="index.php?action=download_file&nav='.$root_user.'\\'.$file.' "> '.$file.'</a></td>';
                                // echo '<td><a href="download.php"> '.$file.'  </a></td>';
                                print "<td>Archivo</td>\n";
                                if($extension !="zip"){
                                    print "<td><a class='btn btn-danger mx-4' href='index.php?action=delete_item&nav=".$root_user."\\".$file."&root=".$root_user."&arch=fichero'><i class='bi bi-file-minus fs-3'></i></a>".

                                    "<a class='btn btn-warning' href='index.php?action=copy_item&nav=".$root_user."\\".$file."&root=".$root_user."&arch=fichero&fichero=".$file."'><i class='bi bi-pencil-square fs-3'></i></a>".
                                    
                                    "<a class='btn btn-secondary mx-4' href='index.php?action=zip&nav=".$root_user."\\".$file."&root=".$root_user."&arch=fichero&fichero=".$file."'><i class='bi bi-file-earmark-zip fs-3'></i> </td>";
    
                                }else{
                                    print "<td><a class='btn btn-danger mx-4' href='index.php?action=delete_item&nav=".$root_user."\\".$file."&root=".$root_user."&arch=fichero'><i class='bi bi-file-minus fs-3'></i></a>".
                                    "<a class='btn btn-warning' href='index.php?action=copy_item&nav=".$root_user."\\".$file."&root=".$root_user."&arch=fichero&fichero=".$file."'><i class='bi bi-pencil-square fs-3'></i></a> </td>";
                                }
                            }   
                            ?>
                            </tr>
        <?php
                        
                        }
                    }
                closedir($dh);
                }
            }
        ?>
    </table>
    <div></div>
    <div class="alert alert-info" role="alert">
        Para descargar ficheros o archivos links situados a la carpeta uploads, debe pulsar los links. </br>
        Para acceder al contenido de una carpeta debe pulsar el link.
    </div>
</div>