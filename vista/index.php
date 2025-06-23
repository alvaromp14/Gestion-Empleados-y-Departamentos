<?php
// Inicia la sesión
session_start();

include_once '../dao/conexionBD.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new conexionBD();

    $usuario = $_POST["user"];
    $contraseña = $_POST["password"];

    // Autenticar al usuario
    $usuarioAutenticado = $conexion->autenticarUsuario($usuario, $contraseña);

    // Muestra mensajes de depuración
    echo "Usuario autenticado: " . $usuarioAutenticado;
    echo "<br>";

    if ($usuarioAutenticado) {
        // Almacena la información del usuario en la sesión
        $_SESSION['usuarioAutenticado'] = $usuarioAutenticado;

        // Redirige a la página correspondiente
        if ($usuarioAutenticado == 'adminEmpleados') {
            $_SESSION['tipoUsuario'] = 'adminEmpleados';
            header("Location: ../vista/MenuGeneral.php");
        } elseif ($usuarioAutenticado == 'adminDepartamentos') {
            $_SESSION['tipoUsuario'] = 'adminDepartamentos';
            header("Location: ../vista/MenuGeneral.php");
        } else {
            // Tipo de usuario no reconocido
            echo "Usuario no reconocido.";
        }
        exit();
    } else {
        // Mostrar mensaje de error si la autenticación falla
        echo "Error. Usuario o contraseña incorrectos.";
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceso Administrador</title>
        <link rel="icon" type="image/x-icon" href="../img/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <h1>Identif&iacute;quese para acceder a la aplicaci&oacute;n</h1>
        <form action="" method="POST">
            <label>Usuario:</label>
            <input type="text" name="user" required></input>
            <br><br>
            <label>Contraseña:</label>
            <input type="password" name="password" required></input>
            <br><br>
            <input type="submit" value="Acceder"></input>
        </form>
    </body>
</html>