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
$cursosArray = $db->obtenerCursos();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Empleados por Curso</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Selecciona un curso para ver sus empleados:</h1>
        <form action="../controlador/ControladorListadoEmpleadosCurso.php" method="POST">
            <select name="idCurso" required>
                <option value="" disabled selected>Selecciona un curso</option>
                <?php
                foreach ($cursosArray as $curso) {
                    echo "<option value='" . $curso['id'] . "'>" . $curso['descripcion'] . "</option>";
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