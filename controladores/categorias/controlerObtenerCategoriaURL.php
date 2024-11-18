<?php
// Archivo: controlerObtenerCategoriaURL.php
include('../../conexion/conexionBD.php');

// Verifica si la conexión fue exitosa
if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conexion->connect_error]);
    exit;
}

$idCategoria = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($idCategoria) {
    // Consulta para obtener la información de la categoría
    $stmt = $conexion->prepare("SELECT * FROM categoria WHERE idCategoria = ?");
    if ($stmt) {
        $stmt->bind_param("i", $idCategoria);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $categoria = $result->fetch_assoc();
            
            // Consulta para obtener los productos de la categoría seleccionada
            $stmtProductos = $conexion->prepare("SELECT * FROM productos WHERE idCategoria = ?");
            if ($stmtProductos) {
                $stmtProductos->bind_param("i", $idCategoria);
                $stmtProductos->execute();
                $resultProductos = $stmtProductos->get_result();

                $productos = [];
                while ($producto = $resultProductos->fetch_assoc()) {
                    $productos[] = $producto;
                }
                $stmtProductos->close();

                // Consulta para contar el número de productos en la categoría
                $stmtCount = $conexion->prepare("SELECT COUNT(*) AS totalProductos FROM productos WHERE idCategoria = ?");
                $stmtCount->bind_param("i", $idCategoria);
                $stmtCount->execute();
                $countResult = $stmtCount->get_result();
                $totalProductos = $countResult->fetch_assoc()['totalProductos'];
                $stmtCount->close();

                // Respuesta en formato JSON
                echo json_encode([
                    'success' => true,
                    'categoria' => $categoria,
                    'productos' => $productos,
                    'totalProductos' => $totalProductos
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al obtener productos']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Categoría no encontrada']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al obtener categoría']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de categoría no proporcionado']);
}

$conexion->close();
