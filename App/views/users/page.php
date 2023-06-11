<?php
/* Block time: 20221207 15:47:50*/
defined('MVC_APP') or die('Permission denied');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llista usuaris</title>

    <link rel="stylesheet" type="text/css" href="app/views/css/estil.css">

</head>

<body>
    <h1>Llista usuaris</h1>

    <div class="el_meu_estil">

    <ul>
        <?php
        /* Block time: 20221207 15:51:34*/
         foreach ($info_guests as $row) {
            // print_r($row);
            // echo "<hr>";
            echo "<li>". $row['nick'] . " - " . $row['nomcognom'] . " " . $row['mail'] . "</li>";
         }
        ?>
    </ul>

    </div>
</body>

</html>