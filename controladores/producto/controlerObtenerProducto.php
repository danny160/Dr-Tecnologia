<?php
include('../../conexion/conexionBD.php');

// Obtener el parámetro de búsqueda
$query = $_GET['query'] ?? '';

if (!$query) {
    echo json_encode(['success' => false, 'message' => 'No se proporcionó un valor de búsqueda.']);
    exit;
}

// Intentamos primero como ID numérico, luego como nombre
if (is_numeric($query)) {
    $sql = "SELECT * FROM productos WHERE idProducto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $query);
} else {
    $sql = "SELECT * FROM productos WHERE nombreProducto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $query);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
    echo json_encode(['success' => true, 'producto' => $producto]);
} else {
    echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
}

$stmt->close();
$conexion->close();
