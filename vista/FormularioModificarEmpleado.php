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
        <title>Modificar Empleado</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Introduzca el NIF del empleado que desea modificar:</h1>
        <form action="../controlador/ControladorModificarEmpleado.php" method="POST">
            <label>NIF:</label>
            <input type="text" name="nif" required></input>
            <br><br>
        <h1>Introduzca los datos que desea modificar del empleado:</h1>
            <label>C&oacute;digo:</label>
            <input type="text" name="codigo"></input>
            <br><br>
            <label>Apellidos:</label>
            <input type="text" name="apellidos"></input>
            <br><br>
            <label>Nombre:</label>
            <input type="text" name="nombre"></input>
            <br><br>
            <label>Profesi&oacute;n:</label>
            <input type="text" name="profesion"></input>
            <br><br>
            <label>Salario:</label>
            <input type="text" name="salario"></input>
            <br><br>
            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fechaNac"></input>
            <br><br>
            <label>Fecha de Ingreso:</label>
            <input type="date" name="fechaIng"></input>
            <br><br>
            <label>Departamento:</label>
            <select name="idDepartamento">
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