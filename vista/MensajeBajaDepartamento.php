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
    <title>Baja Departamento</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Baja Departamento</h1>
    <?php
    if(isset($_GET['exito']) && $_GET['exito'] === "true"){
        echo "<p>El departamento ha sido dado de baja.</p>";
    } else if(isset($_GET['error']) && $_GET['error'] === "true") {
        echo "<p>";
        if (isset($_GET['mensaje'])) {
            echo $_GET['mensaje'];
        } else {
            echo "Ocurrió un error inesperado.";
        }
        echo "</p>";
    } else {
        echo "<p>No se recibieron datos válidos.</p>";
    }
    ?>
    <br>
    <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
</body>
</html>