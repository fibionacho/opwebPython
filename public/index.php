<?php
require("../src/init.php");

$db->ejecuta("SELECT * FROM usuarios");
$consulta = $db->obtenDatos();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cosa</title>
</head>
<body>
    <?php include ("menu.php")?>

    <?php foreach($consulta as $value){ ?>

        <p>Nombre:<a href="detalle.php?usuario=<?=$value["nombre"]?>"> <?=$value["nombre"]?></a></p>
        <p>Correo: <?=$value["correo"]?></p>


        <?php } ?>
</body>
</html>