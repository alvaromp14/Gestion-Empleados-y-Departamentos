<?php
include_once '../modelo/Departamento.php';
include_once '../modelo/Empleado.php';
include_once '../modelo/Credenciales.php';
include_once '../modelo/Antiguos_empleados.php';
include_once '../modelo/Cursos.php';

class conexionBD {
    private $conexion;
    private $error;
    private $mensaje_error;
    
public function __construct(){
    // Establecer la conexión con el servidor
    $this->conexion = new mysqli('localhost', 'root', '', 'bd_empleados_2023_php');
    // Evitar que se interpreten mal las tildes y ñ.    
    $this->conexion->set_charset("utf8");
    
    // Comprobamos la conexión
    $this->error = $this->conexion->connect_errno;
    $this->mensaje_error = $this->conexion->connect_errno;
    if($this->error != null){
        echo "<p>Error $this->error al conectar con la base de datos<br>";
        echo "$this->mensaje_error</p>";
    }
}

public function cerrarConexion(){
    $this->conexion->close();
}

// Empleados
public function altaEmpleado($codigo, $nif, $apellidos, $nombre, $profesion, $salario, $fechaNac, $fechaIng, $idDepartamento) {
    $query = "INSERT INTO empleado (codigo, nif, apellidos, nombre, profesion, salario, fechaNac, fechaIng, idDepartamento)
              VALUES ('$codigo', '$nif', '$apellidos', '$nombre', '$profesion', $salario, '$fechaNac', '$fechaIng', $idDepartamento)";

    return $this->conexion->query($query);
}

// Modificar método BajaEmpleado para que borre al empleado de la tabla empleado y lo inserte en la tabla antiguos_empleados con el tipo de baja
public function BajaEmpleado($nif, $tipoBaja) {
    // Iniciar sesión si no está iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Obtener los datos del empleado a dar de baja
    $query = "SELECT * FROM empleado WHERE nif = '$nif'";
    $result = $this->conexion->query($query);

    if ($result->num_rows == 1) {
        // Obtener los datos del empleado
        $empleado = $result->fetch_assoc();

        // Insertar al empleado en la tabla antiguos_empleados
        $insertQuery = "INSERT INTO antiguos_empleados (codigo, nif, apellidos, nombre, profesion, salario, fechaNac, fechaIng, idDepartamento, tipoBaja) VALUES (
            '{$empleado['codigo']}', '{$empleado['nif']}', '{$empleado['apellidos']}', '{$empleado['nombre']}', '{$empleado['profesion']}', '{$empleado['salario']}', '{$empleado['fechaNac']}', '{$empleado['fechaIng']}', '{$empleado['idDepartamento']}', '$tipoBaja'
        )";

        if ($this->conexion->query($insertQuery) === TRUE) {
            // Eliminar al empleado de la tabla empleado
            $deleteQuery = "DELETE FROM empleado WHERE nif = '$nif'";
            if ($this->conexion->query($deleteQuery) === TRUE) {
                // Registrar en la sesión
                if (!isset($_SESSION['empleadosEliminados'])) {
                    $_SESSION['empleadosEliminados'] = array();
                }
                $_SESSION['empleadosEliminados'][] = $empleado;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

public function ModificarEmpleado($nif, $codigo, $apellidos, $nombre, $profesion, $salario, $fechaNac, $fechaIng, $idDepartamento) {
    $query = "UPDATE empleado SET ";

    if (!empty($codigo)) {
        $query .= "codigo='$codigo', ";
    }
    if (!empty($apellidos)) {
        $query .= "apellidos='$apellidos', ";
    }
    if (!empty($nombre)) {
        $query .= "nombre='$nombre', ";
    }
    if (!empty($profesion)) {
        $query .= "profesion='$profesion', ";
    }
    if (!empty($salario)) {
        $query .= "salario='$salario', ";
    }
    if (!empty($fechaNac)) {
        $query .= "fechaNac='$fechaNac', ";
    }
    if (!empty($fechaIng)) {
        $query .= "fechaIng='$fechaIng', ";
    }
    if (!empty($idDepartamento)) {
        $query .= "idDepartamento='$idDepartamento', ";
    }

    $query = rtrim($query, ', '); // Elimina la última coma y espacio
    $query .= " WHERE nif='$nif';";

    if ($this->conexion->query($query)) {
        return true;
    } else {
        return false;
    }
}

public function consultaFichaEmpleado($nif) {
    $query = "SELECT * FROM empleado WHERE nif = '$nif'";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    } else {
        return null; // No se encontró el empleado con el NIF proporcionado
    }
}

// Departamentos
public function AltaDepartamento($codigo, $descripcion, $localizacion) {
    $query = "INSERT INTO departamento (codigo, descripcion, localizacion)
                    VALUES ('$codigo', '$descripcion', '$localizacion');";

    if ($this->conexion->query($query) === TRUE) {
        return $this->conexion->insert_id; // Retorna el ID del nuevo departamento
    } else {
        echo "<p>Error al agregar el departamento: " . $this->conexion->error . "</p>";
        return false;
    }
}

public function BajaDepartamento($codigo){
    $query = "DELETE FROM departamento WHERE codigo='$codigo';";

    if ($this->conexion->query($query) === TRUE) {
        return true;// Retorna true si la operación fue exitosa
    } else {
        echo "<p>Error al dar de baja el departamento: " . $this->conexion->error . "</p>";
        return false;
    }
}

public function ModificarDepartamento($codigo, $descripcion, $localizacion) {
    $query = "UPDATE departamento SET ";

    if (!empty($descripcion)) {
        $query .= "descripcion='$descripcion', ";
    }
    if (!empty($localizacion)) {
        $query .= "localizacion='$localizacion', ";
    }
    
    $query = rtrim($query, ', '); // Elimina la última coma y espacio
    $query .= " WHERE codigo='$codigo';";

    if ($this->conexion->query($query)) {
        return true;
    } else {
        return false;
    }
}

public function consultaFichaDepartamento($codigo) {
    $query = "SELECT * FROM departamento WHERE codigo = '$codigo'";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    } else {
        return null; // No se encontró el departamento con el código proporcionado
    }
}

public function obtenerDepartamentos() {
    $departamentos = array();

    $query = "SELECT id, descripcion FROM departamento";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $departamentos[] = $fila;
        }
    }

    return $departamentos;
}

// Listados
public function ListadoEmpleados() {
    $query = "SELECT * FROM empleado;";
    $result = $this->conexion->query($query);

    if ($result->num_rows > 0) {
        $empleados = array();
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }
        return $empleados;
    } else {
        return null;
    }
}

public function ListadoCompletoEmpleados(){
    $query = "SELECT empleado.*, departamento.descripcion AS departamento, departamento.localizacion
              FROM empleado
              INNER JOIN departamento ON empleado.idDepartamento = departamento.id";

    $result = $this->conexion->query($query);

    if (!$result) {
        die("Error en la consulta: " . $this->conexion->error);
    }

    $empleados = [];

    while ($row = $result->fetch_assoc()) {
        $empleados[] = $row;
    }

    $result->free();

    return $empleados;
}

public function ListadoEmpleadosDepartamento($idDepartamento) {
    $query = "SELECT * FROM empleado WHERE idDepartamento = $idDepartamento";
    $resultado = $this->conexion->query($query);

    $empleados = array();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $empleados[] = $fila;
        }
    }

    return $empleados;
}

// EXAMEN
// Apartado 2 - Añadir listado con empleados de baja (falta ordenar primero los de baja médica)
public function ListadoEmpleadosBaja() {
    $query = "SELECT * FROM antiguos_empleados ORDER BY (tipoBaja = 'Medica') DESC";
    $result = $this->conexion->query($query);

    if ($result->num_rows > 0) {
        $empleados = array();
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }
        return $empleados;
    } else {
        return null;
    }
}


// Autenticación
public function autenticarUsuario($usuario, $contraseña) {
    $query = "SELECT usuario, contraseña FROM credenciales WHERE usuario = '$usuario'";
    $resultado = $this->conexion->query($query);

    if ($resultado) {
        // Verificar si se encontró un usuario
        if ($resultado->num_rows == 1) {
            // Obtener la información del usuario
            $usuarioDB = $resultado->fetch_assoc();

            // Verificar la contraseña
            if ($contraseña == $usuarioDB['contraseña']) {
                // Devolver el tipo de usuario
                return $usuarioDB['usuario'];
            }
        }
    }

    // En caso de error o credenciales incorrectas, devolver false
    return false;
}

// Departamento con mas bajas
public function obtenerDepartamentoMasBajas() {
    $query = "SELECT idDepartamento, COUNT(*) as total_bajas FROM antiguos_empleados WHERE tipoBaja = 'medica' GROUP BY idDepartamento ORDER BY total_bajas DESC LIMIT 1";
    $result = $this->conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['idDepartamento'];
    } else {
        return null;
    }
}


// Cursos
public function obtenerCursos() {
    $cursos = array();

    $query = "SELECT id, descripcion FROM cursos";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $cursos[] = $fila;
        }
    }

    return $cursos;
}

public function matricularEmpleado($nif, $idCurso){
    $query = "UPDATE empleado SET idCurso = $idCurso WHERE nif = '$nif'";

    if ($this->conexion->query($query) === TRUE) {
        return true;
    } else {
        return false;
    }
}

public function ListadoEmpleadosCurso($idCurso){
    $query = "SELECT * FROM empleado WHERE idCurso = $idCurso";
    $resultado = $this->conexion->query($query);

    $empleados = array();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $empleados[] = $fila;
        }
    }

    return $empleados;
}

public function obtenerCursoPorId($idCurso) {
    $query = "SELECT id, descripcion FROM cursos WHERE id = $idCurso";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    } else {
        return null;
    }
}

public function obtenerTotalMatriculadosPorCurso() {
    $query = "SELECT c.descripcion, COUNT(e.idCurso) as total FROM cursos c LEFT JOIN empleado e ON c.id = e.idCurso GROUP BY c.descripcion";
    $resultado = $this->conexion->query($query);

    $totales = array();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $totales[] = $fila;
        }
    }

    return $totales;
}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////                                                                                                                                /////
/////                                                                                                                                /////
/////                                                           EXAMEN                                                               /////
/////                                                                                                                                /////
/////                                                                                                                                /////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function obtenerSeguros() {
    $seguros = array();

    $query = "SELECT id, siglas FROM seguros_medicos";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $seguros[] = $fila;
        }
    }

    return $seguros;
}

public function asegurarEmpleado($nif, $idSeguro){
    $query = "UPDATE empleado SET idSeguro = $idSeguro WHERE nif = '$nif'";

    if ($this->conexion->query($query) === TRUE) {
        return true;
    } else {
        return false;
    }
}

public function obtenerSeguroPorId($idSeguro) {
    $query = "SELECT id, siglas FROM seguros_medicos WHERE id = $idSeguro";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    } else {
        return null;
    }
}

public function obtenerEmpleadoPorNif($nif) {
    $query = "SELECT codigo, nif, apellidos, nombre FROM empleado WHERE nif = '$nif'";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    } else {
        return null;
    }
}

public function ListadoEmpleadosSeguro($idSeguro){
    $query = "SELECT * FROM empleado WHERE idSeguro = $idSeguro";
    $resultado = $this->conexion->query($query);

    $empleados = array();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $empleados[] = $fila;
        }
    }

    return $empleados;
}

public function obtenerTotalAseguradosPorSeguro() {
    $query = "SELECT s.siglas, COUNT(e.idSeguro) as total FROM seguros_medicos s LEFT JOIN empleado e ON s.id = e.idSeguro GROUP BY s.siglas";
    $resultado = $this->conexion->query($query);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            if(!isset($_COOKIE['aseguradosPorSeguro'])){
                $_COOKIE['aseguradosPorSeguro'] = array();
            }
            $_COOKIE['aseguradosPorSeguro'] []= $fila;
        }
    }

    return $_COOKIE['aseguradosPorSeguro'];
}

/*
public function obtenerTotalAseguradosPorSeguro() {
    $query = "SELECT s.siglas, COUNT(e.idSeguro) as total FROM seguros_medicos s LEFT JOIN empleado e ON s.id = e.idSeguro GROUP BY s.siglas";
    $resultado = $this->conexion->query($query);

    $totales = array();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $totales[] = $fila;
        }
    }

    return $totales;
}
*/

}