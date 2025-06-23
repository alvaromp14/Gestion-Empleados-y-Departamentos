<?php
include '../dao/conexionBD.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = new conexionBD();
        $nif = $_POST['nif'];

        // Consulta la ficha del empleado
        $empleado = $db->consultaFichaEmpleado($nif);

        if ($empleado !== false) {
            // Incluye la vista de la ficha del empleado
            include '../vista/VistaConsultaFichaEmpleado.php';
            exit();
        } else {
            throw new Exception("No se encontró al empleado con el NIF proporcionado.");
        }
    } else {
        throw new Exception("No se recibieron datos válidos.");
    }
} catch (Exception $e) {
    header("Location: ../vista/MensajeConsultaFichaEmpleado.php?error=true&mensaje=" . urlencode($e->getMessage()));
    exit();
} catch (Exception $e) {
    header("Location: ../vista/MensajeConsultaFichaEmpleado.php?error=true&mensaje=Error inesperado. Por favor, inténtelo de nuevo.");
    exit();
}