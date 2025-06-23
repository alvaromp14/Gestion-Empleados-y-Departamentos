<?php
// Inicia la sesión
session_start();

// Incrementa el contador de visitas
$numVisitas = isset($_COOKIE['numVisitas']) ? $_COOKIE['numVisitas'] + 1 : 1;
setcookie('numVisitas', $numVisitas, time() + 3600 * 24 * 30); // Cookie válida por 30 días
?>
<?php
include '../dao/conexionBD.php';

$db = new conexionBD();
$segurosArray = $db->obtenerSeguros();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Empleados por Seguro</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Selecciona un seguro para ver sus empleados:</h1>
        <form action="../controlador/ControladorListadoEmpleadosSeguro.php" method="POST">
            <select name="idSeguro" required>
                <option value="" disabled selected>Selecciona un seguro</option>
                <?php
                foreach ($segurosArray as $seguro) {
                    echo "<option value='" . $seguro['id'] . "'>" . $seguro['siglas'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Enviar"></input>
        </form>
        <br>
        <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
    </body>
</html>