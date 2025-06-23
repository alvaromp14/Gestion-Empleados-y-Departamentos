<?php
include_once '../dao/conexionBD.php';

try {
    $conexion = new conexionBD();
    $empleados = $conexion->ListadoEmpleados();

    if ($empleados !== null) {
        // Incluye la vista
        include_once '../vista/VistaListadoEmpleados.php';
        exit();
    } else {
        throw new Exception("Error al obtener el listado de empleados");
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Error inesperado. Por favor, inténtelo de nuevo.';
}