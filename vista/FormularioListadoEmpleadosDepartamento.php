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
$dptoArray = $db->obtenerDepartamentos();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Empleados por Departamento</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Selecciona un departamento para ver sus empleados:</h1>
        <form action="../controlador/ControladorListadoEmpleadosDepartamento.php" method="POST">
            <select name="idDepartamento" required>
                <option value="" disabled selected>Selecciona un departamento</option>
                <?php
                foreach ($dptoArray as $departamento) {
                    echo "<option value='" . $departamento['id'] . "'>" . $departamento['descripcion'] . "</option>";
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