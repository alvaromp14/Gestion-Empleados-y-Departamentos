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
        <title>Modificar Departamento</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Introduzca el c&oacute;digo del departamento que desea modificar:</h1>
        <form action="../controlador/ControladorModificarDepartamento.php" method="POST">
            <label>C&oacute;digo:</label>
            <input type="text" name="codigo" required></input>
            <br><br>
        <h1>Introduzca los datos que desea modificar del departamento:</h1>
            <label>Descripci&oacute;n:</label>
            <input type="text" name="descripcion"></input>
            <br><br>
            <label>Localizaci&oacute;n:</label>
            <input type="text" name="localizacion"></input>
            <br><br>
            <input type="submit" value="Enviar"></input>
        </form>
        <br>
        <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
    </body>
</html>