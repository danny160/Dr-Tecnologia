<?php
// Incluir el archivo de conexión a la base de datos
include('../../conexion/conexionBD.php');

// Obtener los datos del formulario
$nombreCategoria = $_POST['nombreCategoria'];
$descripcionCategoria = $_POST['descripcionCategoria'];
$imagenCategoria = $_FILES['imagenCategoria'];

// Validar si se ha subido una imagen
if ($imagenCategoria['error'] == 0) {
    // Obtener la extensión de la imagen
    $ext = pathinfo($imagenCategoria['name'], PATHINFO_EXTENSION);
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array(strtolower($ext), $allowedExt)) {
        echo json_encode(['success' => false, 'message' => 'Solo se permiten imágenes en formato JPG, PNG o GIF.']);
        exit;
    }

    // Crear una carpeta 'imgCategoria' si no existe
    $uploadDir = '../../imgCategoria/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generar un nombre único para la imagen de 4 dígitos
    $imageName = rand(1000, 9999) . '.' . $ext; // Genera un nombre aleatorio de 4 dígitos
    $imagePath = $uploadDir . $imageName;

    // Mover la imagen al directorio deseado
    if (move_uploaded_file($imagenCategoria['tmp_name'], $imagePath)) {
        // Insertar los datos en la base de datos
        $stmt = $conexion->prepare("INSERT INTO categoria (nombreCategoria, descripcionCategoria, imagenCategoria) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombreCategoria, $descripcionCategoria, $imageName);  // Solo guardar el nombre de la imagen

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Categoría guardada correctamente.', 'type' => 'exito']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar los datos en la base de datos.', 'type' => 'error']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar la imagen.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Por favor, sube una imagen válida.']);
}

// Cerrar la conexión
$conexion->close();
