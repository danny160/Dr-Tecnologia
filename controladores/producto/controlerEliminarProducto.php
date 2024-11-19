<?php
include('../../conexion/conexionBD.php');

// Obtener el ID del producto a eliminar
$idProducto = $_POST['idProducto'] ?? '';

if (!$idProducto) {
    echo json_encode(['success' => false, 'message' => 'No se proporcionó un ID de producto.']);
    exit;
}

// Preparamos la consulta para eliminar el producto
$sql = "DELETE FROM productos WHERE idProducto = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idProducto);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Producto eliminado exitosamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto.']);
}

$stmt->close();
$conexion->close();
