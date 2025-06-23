<?php
session_start();
include_once '../dao/conexionBD.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new conexionBD();
        $nif = $_POST["nif"];
        $idCurso = $_POST["idCurso"];

        // Llamar al método matricularEmpleado
        if ($conexion->matricularEmpleado($nif, $idCurso)) {
            // Obtener los detalles del curso y del empleado
            $curso = $conexion->obtenerCursoPorId($idCurso);
            $empleado = $conexion->obtenerEmpleadoPorNif($nif);

            // Guardar en la sesión
            $_SESSION['matriculaciones'][] = [
                'empleado' => $empleado['nombre'],
                'curso' => $curso['descripcion']
            ];

            header("Location: ../vista/MensajeMatricularEmpleado.php?exito=true");
            exit();
        } else {
            throw new Exception("Error al matricular el empleado");
        }
    } else {
        throw new Exception("Método de solicitud no válido");
    }
} catch (Exception $e) {
    header('Location: ../vista/Error.php?error=' . urlencode($e->getMessage()));
    exit();
}