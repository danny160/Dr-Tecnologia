<?php
// Datos de la conexión
$host = "localho";  // Servidor de la base de datos (localhost si usas XAMPP)
$username = "root";    // Usuario de MySQL (por defecto es 'root' en XAMPP)
$password = "";        // Contraseña del usuario MySQL (por defecto está vacía en XAMPP)
$database = "drtecnologia";  // Nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
