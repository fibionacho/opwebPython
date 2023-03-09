<?php
    require("../src/init.php");

    $datos = [];
    $errores = [];


    if(!isset($_SESSION['nombre'])){
        if(isset($_POST["enviar"])){
            //COMPROBAR NOMBRE
            if (isset($_POST['nombre']) && $_POST['nombre'] != "" && $_POST['nombre'] != null) $datos['nombre'] = clean_input($_POST['nombre']);
            else $errores['nombre'] = "El campo nombre no puede estar vacío";

            //comprobar passwd

            if (isset($_POST['passwd']) && $_POST['passwd'] != "" && $_POST['passwd'] != null) $datos['passwd'] = clean_input($_POST['passwd']);
            else $errores['passwd'] = "*El campo passwd no puede estar vacío";
            
            //si no hay errores...
            if(count($errores)==0){
                $db->ejecuta("SELECT *  FROM usuarios WHERE nombre=?;",
            $datos['nombre']);
            $consulta = $db->obtenElDato();

            //si no esta vacia es que hay un registro
            if($consulta!=""){
                //comprobar contraseñan
                if(password_verify($datos["passwd"],$consulta["passwd"])){
                    //establecemos la sesion
                    $_SESSION["id"]= $consulta["id"];
                    $_SESSION["nombre"]= $consulta["nombre"];
                    $_SESSION["correo"]= $consulta["correo"];

                    //si ha pedido recuerdame...

                    if(isset($_POST["recuerdame"]) && $_POST["recuerdame"]=="on"){
                        $token = bin2hex(openssl_random_pseudo_bytes(DWESBaseDatos::LONG_TOKEN));

                        //insertar en bbdd
                        $db->ejecuta("INSERT INTO tokens (id_usuario, valor) VALUES(?, ?);",
                        $_SESSION["id"], $token);


                        //creamos la cookie

                        setcookie("recuerdame", $token,[
                            "expires" => time() + 7 *24 *60 *60,
                            "httponly" => true
                        ]);

                        
                    }
                    //redirect
                    header("Location: ".$paginaAnterior);
                    die();

                    //contraseña no coincide
                }else{
                    $errores['incorrecto']="Datos incorrectos";
                }
                //el nombre no existe
            }else{
                $errores['incorrecto']="Datos incorrectos";
            }

            }
        }

    }else{
        header("Location:index.php");
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
    <?php include("menu.php")?>

    <form action="" method="post">
        Nombre: <input type="text" name="nombre" id="nombre" value=<?=$datos['nombre']?>><br>

        <?php if(isset($errores["nombre"])) echo "<span class='error'>".$errores['nombre']."</span><br>" ?>


        Contraseña: <input type="password" name="passwd" id="password">


        Recuerdame: <input type="checkbox" name="recuerdame">
        <?php if(isset($errores["passwd"])) echo "<span class='error'>".$errores['passwd']."</span><br>" ?>


        <?php if(isset($errores["incorrecto"])){ ?>
            <div class="error"><?= $errores["incorrecto"]?></div>
            <?php } ?>
        <input type="submit" value="enviar" name="enviar">
    </form>
    <a href="recovery.php">Olvidé mi contraseña</a>
</body>
</html>