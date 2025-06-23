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
        <title>Baja Empleado</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Introduzca el NIF del empleado que desea dar de baja</h1>
        <form action="../controlador/ControladorBajaEmpleado.php" method="POST">
            <label>NIF:</label>
            <input type="text" name="nif" required></input>
            <br><br>
            <label>Motivo de la baja:</label>
            <select name="tipoBaja" required>
                <option value="" disabled selected>Motivo de la baja</option>
                <option value="despido">Despido</option>
                <option value="medica">Medica</option>
            </select>
            <br><br>
            <input type="submit" value="Enviar"></input>
        </form>
        <br>
        <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
        </body>
</html>