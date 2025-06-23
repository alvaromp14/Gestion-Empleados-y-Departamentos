<?php
include '../dao/conexionBD.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = new conexionBD();
        $codigo = $_POST['codigo'];

        // Consulta la ficha del departamento
        $departamento = $db->consultaFichaDepartamento($codigo);

        if ($departamento !== false) {
            // Incluye la vista de la ficha del departamento
            include '../vista/VistaConsultaFichaDepartamento.php';
            exit();
        } else {
            throw new Exception("No se encontró el departamento con el código proporcionado.");
        }
    } else {
        throw new Exception("No se recibieron datos válidos.");
    }
} catch (Exception $e) {
    header("Location: ../vista/MensajeConsultaFichaDepartamento.php?error=true&mensaje=" . urlencode($e->getMessage()));
    exit();
} catch (Exception $e) {
    header("Location: ../vista/MensajeConsultaFichaDepartamento.php?error=true&mensaje=Error inesperado. Por favor, inténtelo de nuevo.");
    exit();
}