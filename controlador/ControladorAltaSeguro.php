<?php
session_start();
include_once '../dao/conexionBD.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new conexionBD();
        $nif = $_POST["nif"];
        $idSeguro = $_POST["idSeguro"];

        // Llamar al método asegurarEmpleado
        if ($conexion->asegurarEmpleado($nif, $idSeguro)) {
            // Obtener los detalles del seguro y del empleado
            $seguro = $conexion->obtenerSeguroPorId($idSeguro);
            $empleado = $conexion->obtenerEmpleadoPorNif($nif);
            
            // Guardar en la sesión
            $_SESSION['asegurados'][] = [
                'empleado' => $empleado['nombre'],
                'seguro' => $seguro['siglas']
                
            ];
            
            header("Location: ../vista/MensajeAltaSeguroEmpleado.php?exito=true");
            exit();
        } else {
            throw new Exception("Error al dar de alta al empleado en el seguro médico");
        }
    } else {
        throw new Exception("Método de solicitud no válido");
    }
} catch (Exception $e) {
    header('Location: ../vista/Error.php?error=' . urlencode($e->getMessage()));
    exit();
}