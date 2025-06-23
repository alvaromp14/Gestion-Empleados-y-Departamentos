<?php
include '../dao/conexionBD.php';

try {
    $db = new conexionBD();

    // Recupera los datos del formulario
    $codigo = $_POST['codigo'];
    $nif = $_POST['nif'];
    $apellidos = $_POST['apellidos'];
    $nombre = $_POST['nombre'];
    $profesion = $_POST['profesion'];
    $salario = $_POST['salario'];
    $fechaNac = $_POST['fechaNac'];
    $fechaIng = $_POST['fechaIng'];
    $idDepartamento = $_POST['idDepartamento'];

    // Realiza la alta del empleado
    $resultado = $db->altaEmpleado($codigo, $nif, $apellidos, $nombre, $profesion, $salario, $fechaNac, $fechaIng, $idDepartamento);

    // Redirige a la página de mensajes
    if ($resultado) {
        header('Location: ../vista/MensajeAltaEmpleado.php?mensaje=Empleado dado de alta correctamente');
        exit();
    } else {
        throw new Exception("Error al dar de alta al empleado. Por favor, inténtelo de nuevo.");
    }
} catch (Exception $e) {
    header('Location: ../vista/MensajeAltaEmpleado.php?error=true&mensaje=' . urlencode($e->getMessage()));
    exit();
} catch (Exception $e) {
    header('Location: ../vista/MensajeAltaEmpleado.php?error=true&mensaje=Error inesperado. Por favor, inténtelo de nuevo.');
    exit();
}