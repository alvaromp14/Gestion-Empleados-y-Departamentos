<?php
include_once '../dao/conexionBD.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new conexionBD();

        $nif = $_POST["nif"];
        $codigo = $_POST["codigo"];
        $apellidos = $_POST["apellidos"];
        $nombre = $_POST["nombre"];
        $profesion = $_POST["profesion"];
        $salario = $_POST["salario"];
        $fechaNac = $_POST["fechaNac"];
        $fechaIng = $_POST["fechaIng"];
        $idDepartamento = $_POST["idDepartamento"];

        // Formatear fechas si es necesario
        $fechaNac = date("Y-m-d", strtotime($fechaNac));
        $fechaIng = date("Y-m-d", strtotime($fechaIng));

        // Llamar al método ModificarEmpleado
        if ($conexion->ModificarEmpleado($nif, $codigo, $apellidos, $nombre, $profesion, $salario, $fechaNac, $fechaIng, $idDepartamento)) {
            header("Location: ../vista/MensajeModificarEmpleado.php?exito=true");
            exit();
        } else {
            throw new Exception("Error al modificar el empleado");
        }
    } else {
        throw new Exception("Método de solicitud no válido");
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Error inesperado. Por favor, inténtelo de nuevo.';
}