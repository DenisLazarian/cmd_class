<?php
/* Block time: 20221207 15:47:50*/
defined('MVC_APP') or die('Permission denied');

// session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page. Intranet.</title>

    <link rel="stylesheet" type="text/css" href="app/views/css/estil.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
<?php 
    include_once "App/views/templates/heading.php"; 
?>

<div class="container mt-4">


<?php if(isset($action) && $action == 'mail-list'){  // template form login  ?>
    <?php
        include "App/views/mails/index.php";
    ?>
<?php }elseif(checkG("action", "show_mail")){ // template form registre ?>
    <?php 
        include "App/views/mails/show.php";
    ?>

<?php }elseif(checkG("action", "users-list")){ // template form registre 

        include "App/views/users/index.php";
    ?>


<?php }elseif(checkG("action", "edit_user")){ // template form registre ?>
    <?php 
        include "App/views/users/edit.php";
    ?>
<?php }else{?>
    <div class="mt-4 container">
        <h1>DLazaMail</h1>
    <div>
            <!-- <a href="index.php?action=users">Llista usuaris</a> -->
    </div>
        <div class="mt-4">
            Bienvenido a mi servicio de correo electrónico "DLazaMail". En este servició se podrá registrar y enviar correos electrónicos a otros usuarios registrados en el servicio, entre otras funcionalidades.
        </div>
    </div>
<?php }?>





</div>

<?php 
    include_once "App/views/templates/footer.php"; 
?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>