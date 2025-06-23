<?php
include_once '../dao/conexionBD.php';

try {
    $conexion = new conexionBD();
    $empleados = $conexion->ListadoEmpleadosBaja();

    if ($empleados !== null) {
        // Incluye la vista
        include_once '../vista/VistaListadoEmpleadosBaja.php';
        exit();
    } else {
        throw new Exception("Error al obtener el listado de empleados de baja");
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Error inesperado. Por favor, inténtelo de nuevo.';
}