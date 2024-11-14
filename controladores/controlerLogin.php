<?php
// Incluyendo la conexión a la base de datos
include('../conexion/conexionBD.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibiendo los datos del formulario
    $username = mysqli_real_escape_string($conexion, $_POST['username']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    // Consulta para validar el usuario y contraseña y obtener el rol
    $query = "SELECT rolUsuario, idUsuario FROM login WHERE nombreUsuarioInicio = '$username' AND contraseña = '$password'";
    $result = mysqli_query($conexion, $query);

    // Verificación de los resultados
    if (mysqli_num_rows($result) > 0) {

        // Obtener el rol del usuario y el idUsuario
        $row = mysqli_fetch_assoc($result);
        $rolUsuario = $row['rolUsuario'];
        $idUsuario = $row['idUsuario'];

        // Consulta para verificar el estado de la cuenta
        $estadoQuery = "SELECT estadoCuenta FROM usuarios WHERE idUsuario = '$idUsuario'";
        $estadoResult = mysqli_query($conexion, $estadoQuery);
        
        if (mysqli_num_rows($estadoResult) > 0) {
            $estadoRow = mysqli_fetch_assoc($estadoResult);
            $estadoCuenta = $estadoRow['estadoCuenta'];

            // Verificar el estado de la cuenta
            if ($estadoCuenta == 1) { // Usuario bloqueado
                header("Location: ../paginas/login.php?error=1");
                exit();
            }

            // Redireccionar según el rol del usuario
            switch ($rolUsuario) {
                case 'admin':
                    header("Location: ../paginas/administrador.php"); 
                    break;
                case 'userInventory':
                    header("Location: ../paginas/inventario.php");
                    break;
                case 'userSales':
                    header("Location: ../paginas/ventas.php");
                    break;
                case 'userInvite':
                    header("Location: ../paginas/invitado.php");
                    break;
                default:
                    // En caso de un rol no válido, redirigir a la página de error o login
                    header("Location: ../paginas/login.php?error=1");
                    break;
            }
            exit();
        } else {
            // Si no se encuentra el estado del usuario, redirigir a error
            header("Location: ../paginas/login.php?error=usuario_no_encontrado");
            exit();
        }
    } else {
        // Credenciales incorrectas, redirige al login con un mensaje de error
        header("Location: ../paginas/login.php?error=2");
        exit();
    }
}
