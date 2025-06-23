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
        <title>Alta Empleado</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Introduzca los datos para dar de alta a un empleado</h1>
        <form action="../controlador/ControladorAltaEmpleado.php" method="POST">
            <label>C&oacute;digo:</label>
            <input type="text" name="codigo" required></input>
            <br><br>
            <label>NIF:</label>
            <input type="text" name="nif" required></input>
            <br><br>
            <label>Apellidos:</label>
            <input type="text" name="apellidos" required></input>
            <br><br>
            <label>Nombre:</label>
            <input type="text" name="nombre" required></input>
            <br><br>
            <label>Profesi&oacute;n:</label>
            <input type="text" name="profesion" required></input>
            <br><br>
            <label>Salario:</label>
            <input type="text" name="salario" required></input>
            <br><br>
            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fechaNac" required></input>
            <br><br>
            <label>Fecha de Ingreso:</label>
            <input type="date" name="fechaIng" required></input>
            <br><br>
            <label>ID Departamento:</label>
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
            <br><br>
        </form>
        <br>
        <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
    </body>
</html>