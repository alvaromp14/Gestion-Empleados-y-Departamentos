<?php
// Inicia la sesión
session_start();

// Incrementa el contador de visitas
$numVisitas = isset($_COOKIE['numVisitas']) ? $_COOKIE['numVisitas'] + 1 : 1;
setcookie('numVisitas', $numVisitas, time() + 3600 * 24 * 30); // Cookie válida por 30 días

// Verifica si hay un error para mostrar
$error = isset($_GET['error']) ? $_GET['error'] : (isset($error) ? $error : null);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado Empleados por Curso</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Listado de Empleados por Curso</h1>

    <?php if ($error): ?>
        <b><p>Error: <?php echo ($error); ?></p></b>
    <?php endif; ?>

    <?php if (!empty($empleados)): ?>
        <center>
            <table>
                <tr>
                    <th>Código</th>
                    <th>NIF</th>
                    <th>Apellidos</th>
                    <th>Nombre</th>
                </tr>
                <?php foreach ($empleados as $empleado): ?>
                    <tr>
                        <td><?php echo ($empleado['codigo']); ?></td>
                        <td><?php echo ($empleado['nif']); ?></td>
                        <td><?php echo ($empleado['apellidos']); ?></td>
                        <td><?php echo ($empleado['nombre']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </center>
    <?php else: ?>
        <p>No hay empleados en este curso.</p>
    <?php endif; ?>

    <br>
    <a class="volver" href="../vista/MenuGeneral.php">Volver al Inicio</a>
</body>
</html>