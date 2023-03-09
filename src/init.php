<?php  
    session_start();

    //libreria PDO
    require("DWESBaseDatos.php");
    //mailer (vendor + mailer)
    require("../vendor/autoload.php");
    require("Mailer.php");
    require("config.php");
    //pagina anterior
    require("paginaAnterior.php");
 


    $db = DWESBaseDatos::obtenerInstancia();

    $db->inicializa(
        $CONFIG["db_name"] = "practicandoPHP",
        $CONFIG["db_user"] = "user_practicandoPHP",
        $CONFIG["db_pass"] = "123456"
    );

       //recuerdame
       require("recuerdame.php");


  //  $username = (isset($_SESSION['nombre']))? $_SESSION['nombre'] : 'anonimo';

    $username ="anonimo";
    if(isset($_SESSION["nombre"])){
        $username = $_SESSION["nombre"];
    }

    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>