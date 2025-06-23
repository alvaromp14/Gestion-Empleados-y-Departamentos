<?php
// Inicia la sesión
session_start();

// Incrementa el contador de visitas
$numVisitas = isset($_COOKIE['numVisitas']) ? $_COOKIE['numVisitas'] + 1 : 1;
setcookie('numVisitas', $numVisitas, time() + 3600 * 24 * 30); // Cookie válida por 30 días
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ficha Departamento</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Ficha Departamento</h1>
        <?php
        if(isset($departamento)){
            echo "<p>Código: " . $departamento['codigo'] . "</p>";
            echo "<p>Descripción: " . $departamento['descripcion'] . "</p>";
            echo "<p>Localización: " . $departamento['localizacion'] . "</p>";
        } else {
            echo "<p>No se encontró el departamento con el código proporcionado.</p>";
        }
        ?>
        <br>
        <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
    </body>
</html>