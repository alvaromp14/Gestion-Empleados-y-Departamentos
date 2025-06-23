<?php
include '../dao/conexionBD.php';

define('MINIMO_MATRICULADOS', 2);

class CursoPocaMatriculaExcepcion extends Exception {}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idCurso = $_POST['idCurso'];

        $db = new conexionBD();
        $empleados = $db->ListadoEmpleadosCurso($idCurso);

        // Verificar si el número de empleados es menor que el mínimo
        if (count($empleados) < MINIMO_MATRICULADOS) {
            $error = "El curso puede ser que no se imparta por falta de matrícula";
        }

        // Incluye la vista
        include_once '../vista/VistaListadoEmpleadosCurso.php';
        exit();
    } else {
        throw new Exception("Método de solicitud no válido");
    }
} catch (Exception $e) {
    // Redirige con el mensaje de error
    header('Location: ../vista/VistaListadoEmpleadosCurso.php?error=' . urlencode($e->getMessage()));
    exit();
}