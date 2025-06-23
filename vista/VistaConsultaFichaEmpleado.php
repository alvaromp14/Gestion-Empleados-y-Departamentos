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
        <title>Ficha Empleado</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Ficha Empleado</h1>
        <?php
        if(isset($empleado)){
            echo "<p>Código: " . $empleado['codigo'] . "</p>";
            echo "<p>NIF: " . $empleado['nif'] . "</p>";
            echo "<p>Apellidos: " . $empleado['apellidos'] . "</p>";
            echo "<p>Nombre: " . $empleado['nombre'] . "</p>";
            echo "<p>Profesión: " . $empleado['profesion'] . "</p>";
            echo "<p>Salario: " . $empleado['salario'] . "</p>";
            echo "<p>Fecha de Nacimiento: " . $empleado['fechaNac'] . "</p>";
            echo "<p>Fecha de Ingreso: " . $empleado['fechaIng'] . "</p>";
        } else {
            echo "<p>No se encontró al empleado con el NIF proporcionado.</p>";
        }
        ?>
        <br>
        <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
    </body>
</html>