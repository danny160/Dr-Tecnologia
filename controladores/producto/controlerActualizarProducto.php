<?php
include('../../conexion/conexionBD.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProducto = $_POST['idProductoEditar'];
    $nombreProducto = $_POST['nombreProductoEditar'];
    $descripcionProducto = $_POST['descripcionProductoEditar'];
    $precioProducto = $_POST['precioProductoEditar'];
    $cantidadRegistrar = $_POST['cantidadRegistrarEditar'];
    $fechaIngreso = $_POST['fechaIngresoEditar'];
    $idCategoria = $_POST['categoriaEditar'];

    $sqlSelect = "SELECT imagenProducto FROM productos WHERE idProducto = ?";
    $stmtSelect = $conexion->prepare($sqlSelect);
    $stmtSelect->bind_param("i", $idProducto);
    $stmtSelect->execute();
    $resultSelect = $stmtSelect->get_result();

    if ($resultSelect->num_rows > 0) {
        $producto = $resultSelect->fetch_assoc();
        $imagenProductoActual = $producto['imagenProducto'];
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
        exit;
    }
    $stmtSelect->close();

    if (isset($_FILES['imagenProductoEditar']) && $_FILES['imagenProductoEditar']['error'] == 0) {
        $imagenProductoNueva = $_FILES['imagenProductoEditar'];
        $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];

        if (!in_array($imagenProductoNueva['type'], $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => 'Error: Solo se permiten archivos en formato PNG, JPG o JPEG.']);
            exit;
        }

        if (file_exists($imagenProductoActual)) {
            unlink($imagenProductoActual);
        }

        $filePath = '../imgProducto/' . basename($imagenProductoActual);

        if (!move_uploaded_file($imagenProductoNueva['tmp_name'], $filePath)) {
            echo json_encode(['success' => false, 'message' => 'Error al mover la imagen al directorio.']);
            exit;
        }
    } else {
        $filePath = $imagenProductoActual;
    }

    $sqlUpdate = "UPDATE productos SET nombreProducto = ?, descripcionProducto = ?, precioProducto = ?, cantidadRegistrar = ?, fechaIngreso = ?, idCategoria = ?, imagenProducto = ? WHERE idProducto = ?";
    $stmtUpdate = $conexion->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssdisisi", $nombreProducto, $descripcionProducto, $precioProducto, $cantidadRegistrar, $fechaIngreso, $idCategoria, $filePath, $idProducto);

    if ($stmtUpdate->execute()) {
        echo json_encode(['success' => true, 'message' => 'Producto editado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en la actualización del producto.']);
    }

    $stmtUpdate->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud no válida.']);
}

$conexion->close();
