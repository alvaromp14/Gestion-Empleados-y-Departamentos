<?php
include_once '../dao/conexionBD.php';

try {
    if (isset($_POST['nif'], $_POST['tipoBaja'])) {
        $nif = $_POST['nif'];
        $tipoBaja = $_POST['tipoBaja'];

        $conexion = new conexionBD();

        // Realiza la baja del empleado
        $resultado = $conexion->BajaEmpleado($nif, $tipoBaja);

        // Redirige a la página de mensajes
        if ($resultado) {
            header('Location: ../vista/MensajeBajaEmpleado.php?exito=true');
        } else {
            header('Location: ../vista/MensajeBajaEmpleado.php?error=true&mensaje=' . urlencode("Error al dar de baja al empleado. Por favor, inténtelo de nuevo."));
        }
    } else {
        header('Location: ../vista/MensajeBajaEmpleado.php?error=true&mensaje=' . urlencode("No se recibieron datos válidos."));
    }
} catch (Exception $e) {
    header('Location: ../vista/MensajeBajaEmpleado.php?error=true&mensaje=' . urlencode($e->getMessage()));
} 
exit();