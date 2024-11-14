<?php
include('../../conexion/conexionBD.php');

// Obtener el nombre de la categoría desde el POST
$data = json_decode(file_get_contents("php://input"));
$nombreCategoria = $data->nombreCategoria;

// Consultar la base de datos para buscar la categoría
$query = "SELECT * FROM categoria WHERE nombreCategoria LIKE ?";
$stmt = $conexion->prepare($query);
$searchTerm = "%" . $nombreCategoria . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$response = array();

if ($result->num_rows > 0) {
    $categoria = $result->fetch_assoc();
    $response['success'] = true;
    $response['categoria'] = $categoria;
} else {
    $response['success'] = false;
    $response['message'] = "Categoría no encontrada";
}

echo json_encode($response);

$stmt->close();
$conexion->close();
