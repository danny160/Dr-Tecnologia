<?php
include('../conexion/conexionBD.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreProducto = $_POST['nombre'];
    $descripcionProducto = $_POST['descripcion'];
    $precioProducto = $_POST['precio'];
    $cantidadRegistrar = $_POST['cantidad'];
    $fechaIngreso = $_POST['fechaIngreso'];
    $idCategoria = $_POST['categoria'];

    if (isset($_FILES['imgProducto']) && $_FILES['imgProducto']['error'] == 0) {
        $imgProducto = $_FILES['imgProducto'];
        $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];

        if (!in_array($imgProducto['type'], $allowedTypes)) {
            echo "<script>window.location.href='../paginas/listadoInventario.php?msg=error_tipo';</script>";
            exit;
        }

        $uploadDir = '../imgProducto/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $randomCode = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $fileExtension = pathinfo($imgProducto['name'], PATHINFO_EXTENSION);
        $fileName = $randomCode . '.' . $fileExtension;
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($imgProducto['tmp_name'], $filePath)) {
            $sql = "INSERT INTO productos (nombreProducto, descripcionProducto, precioProducto, cantidadRegistrar, fechaIngreso, idCategoria, imagenProducto) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssdisis", $nombreProducto, $descripcionProducto, $precioProducto, $cantidadRegistrar, $fechaIngreso, $idCategoria, $filePath);

            if ($stmt->execute()) {
                echo "<script>window.location.href='../paginas/listadoInventario.php?msg=success';</script>";
            } else {
                echo "<script>window.location.href='../paginas/listadoInventario.php?msg=error_bd';</script>";
            }
            $stmt->close();
        } else {
            echo "<script>window.location.href='../paginas/listadoInventario.php?msg=error_mover';</script>";
        }
    } else {
        echo "<script>window.location.href='../paginas/listadoInventario.php?msg=error_archivo';</script>";
    }
}

$conexion->close();
