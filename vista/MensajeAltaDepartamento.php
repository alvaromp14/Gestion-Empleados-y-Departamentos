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
    <title>Alta Departamento</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Alta Departamento</h1>
    <?php
    if (isset($_GET['id'])) {
        $idDepartamento = $_GET['id'];
        echo "<p>El departamento ha sido dado de alta.</p>";
    } else if (isset($_GET['error']) && $_GET['error'] === "true") {
        $mensaje = isset($_GET['mensaje']) ? urldecode($_GET['mensaje']) : "Ocurrió un error al dar de alta el departamento.";
        echo "<p>$mensaje</p>";
    } else {
        echo "<p>No se recibieron datos válidos.</p>";
    }
    ?>
    <br>
    <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
</body>
</html>