<?php
include_once '../dao/conexionBD.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new conexionBD();

        $codigo = $_POST["codigo"];
        $descripcion = $_POST["descripcion"];
        $localizacion = $_POST["localizacion"];

        // Llama al método AltaDepartamento y obtiene el ID del nuevo departamento
        $idDepartamento = $conexion->AltaDepartamento($codigo, $descripcion, $localizacion);

        if ($idDepartamento !== false) {
            header("Location: ../vista/MensajeAltaDepartamento.php?id=$idDepartamento");
            exit();
        } else {
            throw new Exception("Error al dar de alta el departamento. Por favor, inténtelo de nuevo.");
        }
    } else {
        throw new Exception("No se recibieron datos válidos.");
    }
} catch (Exception $e) {
    header("Location: ../vista/MensajeAltaDepartamento.php?error=true&mensaje=" . urlencode($e->getMessage()));
    exit();
}