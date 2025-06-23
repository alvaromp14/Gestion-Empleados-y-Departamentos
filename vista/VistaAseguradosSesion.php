<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Empleados asegurados de la Sesión Actual</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Empleados asegurados de la Sesión Actual</h1>
    <?php
    if (!empty($_SESSION['asegurados'])) {
        foreach ($_SESSION['asegurados'] as $asegurado) {
            echo "<p>Empleado: " . $asegurado['empleado'] . " - Seguro: " . $asegurado['seguro'] . "</p>";
        }
    } else {
        echo "<p>No hay empleados asegurados en esta sesión.</p>";
    }
    ?>
    <br>
    <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
</body>
</html>