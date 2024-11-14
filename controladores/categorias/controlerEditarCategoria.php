<?php
// Incluir el archivo de conexión a la base de datos
include('../../conexion/conexionBD.php');

// Obtener los datos del formulario
$idCategoria = $_POST['idCategoria'];
$nombreCategoria = $_POST['nombreCategoria'];
$descripcionCategoria = $_POST['descripcionCategoria'];
$imagenCategoria = $_FILES['imagenCategoria']; // Nueva imagen (si existe)
$imagenAnterior = $_POST['imagenAnterior']; // Nombre de la imagen anterior

// Si se ha subido una nueva imagen
if ($imagenCategoria['error'] == 0) {
    // Obtener la extensión de la imagen
    $ext = pathinfo($imagenCategoria['name'], PATHINFO_EXTENSION);
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array(strtolower($ext), $allowedExt)) {
        echo json_encode(['success' => false, 'message' => 'Solo se permiten imágenes en formato JPG, PNG o GIF.']);
        exit;
    }

    // Ruta completa de la imagen anterior
    $uploadDir = '../../imgCategoria/';
    $oldImagePath = $uploadDir . $imagenAnterior;

    // Eliminar la imagen anterior
    if (file_exists($oldImagePath)) {
        unlink($oldImagePath); // Elimina la imagen antigua
    }

    // Generar el nuevo nombre de la imagen (mantener el mismo nombre)
    $newImageName = $imagenAnterior; // Mantener el nombre de la imagen anterior

    // Ruta de la nueva imagen
    $imagePath = $uploadDir . $newImageName;

    // Mover la nueva imagen al directorio deseado
    if (move_uploaded_file($imagenCategoria['tmp_name'], $imagePath)) {
        // Actualizar la base de datos con la nueva imagen
        $stmt = $conexion->prepare("UPDATE categoria SET nombreCategoria = ?, descripcionCategoria = ?, imagenCategoria = ? WHERE idCategoria = ?");
        $stmt->bind_param("sssi", $nombreCategoria, $descripcionCategoria, $newImageName, $idCategoria);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Categoría actualizada correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos en la base de datos.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar la nueva imagen.']);
    }
} else {
    // Si no se subió una nueva imagen, se mantiene la imagen anterior
    $stmt = $conexion->prepare("UPDATE categoria SET nombreCategoria = ?, descripcionCategoria = ? WHERE idCategoria = ?");
    $stmt->bind_param("ssi", $nombreCategoria, $descripcionCategoria, $idCategoria);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Categoría actualizada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos en la base de datos.']);
    }

    $stmt->close();
}

// Cerrar la conexión
$conexion->close();
