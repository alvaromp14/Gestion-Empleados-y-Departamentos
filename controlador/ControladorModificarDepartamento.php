<?php
include_once '../dao/conexionBD.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new conexionBD();

        $codigo = $_POST["codigo"];
        $descripcion = $_POST["descripcion"];
        $localizacion = $_POST["localizacion"];

        // Llamar al método ModificarDepartamento
        if ($conexion->ModificarDepartamento($codigo, $descripcion, $localizacion)) {
            header("Location: ../vista/MensajeModificarDepartamento.php?exito=true");
            exit();
        } else {
            throw new Exception("Error al modificar el departamento");
        }
    } else {
        throw new Exception("Método de solicitud no válido");
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Error inesperado. Por favor, inténtelo de nuevo.';
}