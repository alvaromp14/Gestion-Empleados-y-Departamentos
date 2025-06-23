<?php
include '../dao/conexionBD.php';

define('MINIMO_EMPLEADOS', 1);

class BajoMinimosException extends Exception {}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idDepartamento = $_POST['idDepartamento'];

        $db = new conexionBD();
        $empleados = $db->ListadoEmpleadosDepartamento($idDepartamento);

        // Verificar si el número de empleados es menor que el mínimo
        if (count($empleados) < MINIMO_EMPLEADOS) {
            throw new BajoMinimosException("Bajo mínimos, solo hay " . count($empleados) . " empleados y el mínimo de empleados es " . MINIMO_EMPLEADOS);
        }

        // Incluye la vista
        include_once '../vista/VistaListadoEmpleadosDepartamento.php';
        exit();
    } else {
        throw new Exception("Método de solicitud no válido");
    }
} catch (BajoMinimosException $e) {
    // Redirige con el mensaje de error
    header('Location: ../vista/VistaListadoEmpleadosDepartamento.php?error=' . urlencode($e->getMessage()));
    exit();
} catch (Exception $e) {
    // Redirige con el mensaje de error
    header('Location: ../vista/VistaListadoEmpleadosDepartamento.php?error=' . urlencode($e->getMessage()));
    exit();
} catch (Exception $e) {
    // Redirige con un mensaje de error genérico
    header('Location: ../vista/VistaListadoEmpleadosDepartamento.php?error=' . urlencode("Error inesperado. Por favor, inténtelo de nuevo."));
    exit();
}