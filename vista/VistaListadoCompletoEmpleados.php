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
        <title>Listado Completo de Empleados</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Listado Completo de Empleados</h1>
        <?php
        if (!empty($empleados)) {
            echo "<center><table>
                <tr>
                    <th>Código</th>
                    <th>NIF</th>
                    <th>Apellidos</th>
                    <th>Nombre</th>
                    <th>Profesión</th>
                    <th>Salario</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Fecha de Ingreso</th>
                    <th>Departamento</th>
                    <th>Localización</th>
                </tr>";
            foreach ($empleados as $empleado) {
                echo "<tr>";
                echo "<td>" . $empleado['codigo'] . "</td>";
                echo "<td>" . $empleado['nif'] . "</td>";
                echo "<td>" . $empleado['apellidos'] . "</td>";
                echo "<td>" . $empleado['nombre'] . "</td>";
                echo "<td>" . $empleado['profesion'] . "</td>";
                echo "<td>" . $empleado['salario'] . "</td>";
                echo "<td>" . $empleado['fechaNac'] . "</td>";
                echo "<td>" . $empleado['fechaIng'] . "</td>";
                echo "<td>" . $empleado['departamento'] . "</td>";
                echo "<td>" . $empleado['localizacion'] . "</td>";
                echo "</tr>";
            }
            echo "</table></center>";
        } else {
            echo "<p>No hay empleados registrados.</p>";
        }
        ?>
        <br>
        <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
    </body>
</html>