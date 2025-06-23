<?php
// Inicia la sesión
session_start();

// Incrementa el contador de visitas
$numVisitas = isset($_COOKIE['numVisitas']) ? $_COOKIE['numVisitas'] + 1 : 1;
setcookie('numVisitas', $numVisitas, time() + 3600 * 24 * 30); // Cookie válida por 30 días
// Verificar si hay un error para mostrar
$error = isset($_GET['error']) ? $_GET['error'] : null;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Empleados por Departamento</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
    <?php if ($error): ?>
    <p>Error: <?php echo $error; ?></p>
    <?php else: ?>
        <h1>Listado de Empleados por Departamento</h1>
        <?php
        if (!empty($empleados)) {
            echo "<center><table>
                <tr>
                    <th>Código</th>
                    <th>NIF</th>
                    <th>Apellidos</th>
                    <th>Nombre</th>
                </tr>";
            foreach ($empleados as $empleado) {
                echo "<tr>";
                echo "<td>" . $empleado['codigo'] . "</td>";
                echo "<td>" . $empleado['nif'] . "</td>";
                echo "<td>" . $empleado['apellidos'] . "</td>";
                echo "<td>" . $empleado['nombre'] . "</td>";
                echo "</tr>";
            }
            echo "</table></center>";
        } else {
            echo "<p>No hay empleados en este departamento.</p>";
        }
        ?>
        <br>
    <?php endif; ?>
        <br>
        <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
    </body>
</html>