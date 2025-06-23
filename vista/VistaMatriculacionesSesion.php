<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Matriculaciones de la Sesión Actual</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Matriculaciones de la Sesión Actual</h1>
    <?php
    if (!empty($_SESSION['matriculaciones'])) {
        foreach ($_SESSION['matriculaciones'] as $matriculacion) {
            echo "<p>Empleado: " . $matriculacion['empleado'] . " - Curso: " . $matriculacion['curso'] . "</p>";
        }
    } else {
        echo "<p>No hay matriculaciones en esta sesión.</p>";
    }
    ?>
    <br>
    <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
</body>
</html>