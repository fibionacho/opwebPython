<?php 
    require('../src/init.php');

    if(!isset($_SESSION['nombre'])){
        header("Location:login.php");
        die();
    }



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include ("menu.php")?>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis totam quae iste optio facilis quis molestias perferendis. Commodi, adipisci officia explicabo omnis autem iure alias pariatur a itaque perspiciatis ipsam.</p>
</body>
</html>