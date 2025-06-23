<?php
// Inicia la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['usuarioAutenticado'])) {
    $usuarioAutenticado = $_SESSION['usuarioAutenticado'];
} else {
    // Si no hay sesión activa, redirige al formulario de inicio de sesión
    header("Location: ../vista/index.php");
    exit();
}

// Realiza el seguimiento del usuario (incrementa el contador de visitas)
$numVisitas = isset($_COOKIE['numVisitas']) ? $_COOKIE['numVisitas'] + 1 : 1;

// Recuperar el valor de la cookie
$departamentoMasBajas = isset($_COOKIE['departamentoMasBajas']) ? $_COOKIE['departamentoMasBajas'] : 'No disponible';

// Incluye el archivo de conexión a la base de datos
include '../dao/conexionBD.php';

// Obtén los totales de empleados matriculados por curso
$db = new conexionBD();
$totalesMatriculados = $db->obtenerTotalMatriculadosPorCurso();

// Obtén los totales de empleados asegurados por seguro
$totalesAsegurados = $db->obtenerTotalAseguradosPorSeguro();

// Recuperar empleados eliminados durante la sesión
$empleadosEliminados = isset($_SESSION['empleadosEliminados']) ? $_SESSION['empleadosEliminados'] : array();

// Elimina la cookie y la establece en 0
setcookie('numVisitas', 0, time() - 3600); // Establece la cookie en 0 y la hace expirar
setcookie('departamentoMasBajas', 0, time() - 3600); // Establece la cookie en 0 y la hace expirar

// Cierra la sesión
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Despedida</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Despedida</h1>
    <p>¡Adiós, <?php echo "<b>$usuarioAutenticado</b>" ?>!</p>
    <p>Número de visitas: <?php echo $numVisitas; ?></p>
    <p>Departamento con más bajas: <?php echo $departamentoMasBajas; ?></p>

    <h3>Total de Empleados Matriculados por Curso</h3>
    <center>
        <table>
            <tr>
                <th>Curso</th>
                <th>Matriculados</th>
            </tr>
            <?php foreach ($totalesMatriculados as $total) { ?>
            <tr>
                <td><?php echo $total['descripcion']; ?></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $total['total']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </center>

    <h3>Empleados Eliminados Durante la Sesión</h3>
    <center>
            <?php if (empty($empleadosEliminados)) { ?>
                <p>No se han eliminado empleados durante esta sesión.</p>
            <?php } else { ?>
            <table>
            <tr>
                <th>Código</th>
                <th>NIF</th>
                <th>Apellidos</th>
                <th>Nombre</th>
                <th>Profesión</th>
                <th>Salario</th>
                <th>Fecha Nacimiento</th>
                <th>Fecha Ingreso</th>
                <th>Departamento</th>
            </tr>
            <?php foreach ($empleadosEliminados as $empleado) { ?>
            <tr>
                <td><?php echo $empleado['codigo']; ?></td>
                <td><?php echo $empleado['nif']; ?></td>
                <td><?php echo $empleado['apellidos']; ?></td>
                <td><?php echo $empleado['nombre']; ?></td>
                <td><?php echo $empleado['profesion']; ?></td>
                <td><?php echo $empleado['salario']; ?></td>
                <td><?php echo $empleado['fechaNac']; ?></td>
                <td><?php echo $empleado['fechaIng']; ?></td>
                <td><?php echo $empleado['idDepartamento']; ?></td>
            </tr>
            <?php } ?>
            </table>
            <?php } ?>
    </center>

    <h3>Total de Empleados Asegurados por Seguro</h3>
    <center>
        <table>
            <tr>
                <th>Seguro</th>
                <th>Asegurados</th>
            </tr>
            <?php foreach ($totalesAsegurados as $total) { ?>
            <tr>
                <td><?php echo $total['siglas']; ?></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $total['total']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </center>
</body>
</html>