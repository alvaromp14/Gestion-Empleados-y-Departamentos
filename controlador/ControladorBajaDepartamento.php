<?php
include_once '../dao/conexionBD.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new conexionBD();
        $codigo = $_POST["codigo"];

        // Llama al método BajaDepartamento
        $exito = $conexion->BajaDepartamento($codigo);

        if ($exito) {
            header("Location: ../vista/MensajeBajaDepartamento.php?exito=true");
            exit();
        } else {
            throw new Exception("Error al dar de baja el departamento. Por favor, inténtelo de nuevo.");
        }
    } else {
        throw new Exception("No se recibieron datos válidos.");
    }
} catch (Exception $e) {
    header("Location: ../vista/MensajeBajaDepartamento.php?error=true&mensaje=" . urlencode($e->getMessage()));
    exit();
} catch (Exception $e) {
    header("Location: ../vista/MensajeBajaDepartamento.php?error=true&mensaje=Error inesperado. Por favor, inténtelo de nuevo.");
    exit();
}