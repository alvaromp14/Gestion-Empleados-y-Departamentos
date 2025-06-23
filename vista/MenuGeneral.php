<?php
// Inicia la sesión
session_start();

include_once '../dao/conexionBD.php';

// Verifica si el usuario ha iniciado sesión y tiene un tipo asignado
if (isset($_SESSION['tipoUsuario'])) {
    $tipoUsuario = $_SESSION['tipoUsuario'];
} else {
    // Si no hay tipo de usuario, redirige al formulario de inicio de sesión
    header("Location: ../vista/index.php");
    exit();
}

//EXAMEN
//Apartado 4 - Cookie bajasDepartamento: Mostrar al cerrar sesión el departamento que más bajas ha tenido durante la sesión(usando cookies)
// Instanciar la conexión a la base de datos
$conexion = new conexionBD();

// Obtener el departamento con más bajas
$departamentoMasBajas = $conexion->obtenerDepartamentoMasBajas();

// Verificar si se encontró un departamento con más bajas
if ($departamentoMasBajas) {
    // Establecer la cookie con el departamento con más bajas
    setcookie('departamentoMasBajas', $departamentoMasBajas, time() + 3600 * 24); // Cookie válida por 24 horas
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Men&uacute; General</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Funciones</h1>
        <?php
        echo"Has iniciado sesión como <b>$tipoUsuario</b>";
        ?>
        <br><br><br>

        <?php if ($tipoUsuario === 'adminEmpleados'){ ?>
            <div class="dropdown">
                <label>Empleados</label>
                <div class="dropdown-content">
                    <a href="../vista/FormularioAltaEmpleado.php">Alta Empleado</a>
                    <a href="../vista/FormularioBajaEmpleado.php">Baja Empleado</a>
                    <a href="../vista/FormularioModificarEmpleado.php">Modificar Empleado</a>
                    <a href="../vista/FormularioConsultaFichaEmpleado.php">Consultar Ficha Empleado</a>
                    <a href="../vista/FormularioMatriculaCurso.php">Matricular Empleado en un Curso</a>
                    <br>
                    <span>----- EXAMEN -----</span>
                    <br><br>
                    <!-- Añadido formulario para dar de alta a un empleado en un seguro médico -->
                    <a href="../vista/FormularioAltaSeguro.php">Dar de alta Empleado en un Seguro Médico</a>
                </div>
            </div>

            <div class="dropdown">
                <label>Listados</label>
                <div class="dropdown-content">
                    <a href="../controlador/ControladorListadoEmpleados.php">Listado Empleados</a>
                    <a href="../controlador/ControladorListadoCompletoEmpleados.php">Listado Completo Empleados</a>
                    <a href="../vista/FormularioListadoEmpleadosDepartamento.php">Listado Empleados por Departamento</a>
                    <a href="../controlador/ControladorListadoEmpleadosBaja.php">Listado Empleados de Baja</a>
                    <a href="../vista/FormularioListadoEmpleadosCurso.php">Listado Empleados por Curso</a>
                    <a href="../vista/VistaMatriculacionesSesion.php">Listado Empleados matriculados esta Sesión</a>
                    <br>
                    <span>----- EXAMEN -----</span>
                    <br><br>
                    <!-- Añadido listado Empleados por Seguro -->
                    <a href="../vista/FormularioListadoEmpleadosSeguro.php">Listado Empleados por Seguro</a>
                    <!-- Añadido listado Empleados asegurados esta Sesión -->
                    <a href="../vista/VistaAseguradosSesion.php">Listado Empleados asegurados esta Sesión</a>
                </div>
            </div>
        <?php } ?>

        <?php if ($tipoUsuario === 'adminDepartamentos'){ ?>
            <div class="dropdown">
                <label>Departamentos</label>
                <div class="dropdown-content">
                    <a href="../vista/FormularioAltaDepartamento.php">Alta Departamento</a>
                    <a href="../vista/FormularioBajaDepartamento.php">Baja Departamento</a>
                    <a href="../vista/FormularioModificarDepartamento.php">Modificar Departamento</a>
                    <a href="../vista/FormularioConsultaFichaDepartamento.php">Consultar Ficha Departamento</a>
                </div>
            </div>

            <div class="dropdown">
                <label>Listados</label>
                <div class="dropdown-content">
                    <a href="../controlador/ControladorListadoEmpleados.php">Listado Empleados</a>
                    <a href="../controlador/ControladorListadoCompletoEmpleados.php">Listado Completo Empleados</a>
                    <a href="../vista/FormularioListadoEmpleadosDepartamento.php">Listado Empleados por Departamento</a>
                    <!-- Añadido listado Empleados de Baja -->
                    <a href="../controlador/ControladorListadoEmpleadosBaja.php">Listado Empleados de Baja</a>
                    <!-- Añadido listado Empleados por Curso -->
                    <a href="../vista/FormularioListadoEmpleadosCurso.php">Listado Empleados por Curso</a>
                </div>
            </div>
        <?php } ?>
        <br><br><br><br>
        <a class="volver" href="../vista/Despedida.php">Cerrar sesi&oacute;n</a>
    </body>
</html>