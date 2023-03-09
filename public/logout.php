<?php

    //acceso a BD, sesión, etc. (tiene que ir en TODAS)
    require("../src/init.php");

    //Destruimos la sesión
    session_destroy();

    //Destruimos las cookies (necesario para el recuerdame)
    $db->ejecuta(
        "DELETE FROM tokens WHERE valor=?;",
        $_COOKIE['recuerdame']
    );
    setcookie("PHPSESSID", null, time()-1);
    setcookie("recuerdame", null, time()-1);

    //redirect a página anterior
    header('Location: index.php');
    die();


?>