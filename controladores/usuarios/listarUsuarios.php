<?php
include('../../conexion/conexionBD.php');

$query = "SELECT * FROM usuarios";
$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) > 0) {
    $tablaUsuarios = '';

    while ($row = mysqli_fetch_assoc($result)) {
        $tablaUsuarios .= '<tr>';
        $tablaUsuarios .= '<td class="centerend">' . $row['idUsuario'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['cedulaUsuario'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['nombreUsuario'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['apellidoUsuario'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['rolUsuario'] . '</td>';

        $iconoEstado = $row['estadoCuenta'] == 0 
            ? '<i class="fa-solid fa-check" style="color: green;"></i>'
            : '<i class="fa-solid fa-user-lock" style="color:red;"></i>';

        $botonesAccion = $row['estadoCuenta'] == 0
            ? '<button class="btn btn-sm btn-primary" onclick="abrirModalEditarUsuario(' . $row['idUsuario'] . ')"><i class="fa-solid fa-pen-to-square"></i></button>
               <button class="btn btn-sm btn-success" onclick="cambiarEstado(' . $row['idUsuario'] . ', 1)"><i class="fa-solid fa-ban"></i></button>'
            : '<button class="btn btn-sm btn-primary" onclick="abrirModalEditarUsuario(' . $row['idUsuario'] . ')"><i class="fa-solid fa-pen-to-square"></i></button>
               <button class="btn btn-sm btn-danger" onclick="cambiarEstado(' . $row['idUsuario'] . ', 0)"><i class="fa-solid fa-ban"></i></button>';

        $tablaUsuarios .= '<td class="centerend">' . $iconoEstado . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $botonesAccion . '</td>';
        $tablaUsuarios .= '</tr>';
    }
} else {
    $tablaUsuarios = '<tr><td colspan="6" class="text-center">No hay usuarios registrados</td></tr>';
}

mysqli_close($conexion);
echo $tablaUsuarios;
