<?php
include '../dao/conexionBD.php';

define('MINIMO_ASEGURADOS', 2);

class PocosAseguradosException extends Exception {}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idSeguro = $_POST['idSeguro'];

        $db = new conexionBD();
        $empleados = $db->ListadoEmpleadosSeguro($idSeguro);
        $seguro = $db->obtenerSeguroPorId($idSeguro);

        // Verificar si el número de empleados es menor que el mínimo
        if (count($empleados) < MINIMO_ASEGURADOS) {
            $error = "La aseguradora '" . $seguro['siglas'] . "' puede ser que desaparezca de nuestra empresa";
        }

        // Incluye la vista
        include_once '../vista/VistaListadoEmpleadosSeguro.php';
        exit();
    } else {
        throw new Exception("Método de solicitud no válido");
    }
} catch (Exception $e) {
    // Redirige con el mensaje de error
    header('Location: ../vista/VistaListadoEmpleadosSeguro.php?error=' . urlencode($e->getMessage()));
    exit();
}