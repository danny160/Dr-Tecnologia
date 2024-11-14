<?php
include('../../conexion/conexionBD.php');  // Incluye la conexión a la base de datos

// Obtiene los datos enviados desde el fetch en JSON
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['idCategoria'])) {
    $idCategoria = $data['idCategoria'];

    // Primero, obtenemos el nombre de la imagen asociada a la categoría para eliminarla
    $query = "SELECT imagenCategoria FROM categoria WHERE idCategoria = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idCategoria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagen = $row['imagenCategoria'];

        // Ruta de la imagen en el servidor
        $rutaImagen = "../../imgCategoria/" . $imagen;

        // Inicia la transacción
        $conexion->begin_transaction();

        try {
            // Elimina la categoría de la base de datos
            $deleteQuery = "DELETE FROM categoria WHERE idCategoria = ?";
            $deleteStmt = $conexion->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $idCategoria);
            $deleteStmt->execute();

            // Verifica si la eliminación fue exitosa
            if ($deleteStmt->affected_rows > 0) {
                // Intenta eliminar la imagen del servidor si existe
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen); // Elimina el archivo de imagen
                }

                // Confirma la transacción
                $conexion->commit();

                // Devuelve una respuesta de éxito
                echo json_encode([
                    "success" => true,
                    "message" => "Categoría eliminada exitosamente"
                ]);
            } else {
                // Si la categoría no se eliminó, revierte la transacción
                $conexion->rollback();
                echo json_encode([
                    "success" => false,
                    "message" => "Error al eliminar la categoría de la base de datos"
                ]);
            }
        } catch (Exception $e) {
            // Si hay un error, revierte la transacción
            $conexion->rollback();
            echo json_encode([
                "success" => false,
                "message" => "Error: " . $e->getMessage()
            ]);
        }
    } else {
        // Si no se encuentra la categoría
        echo json_encode([
            "success" => false,
            "message" => "Categoría no encontrada"
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        "success" => false,
        "message" => "ID de categoría no proporcionado"
    ]);
}

$conexion->close();
