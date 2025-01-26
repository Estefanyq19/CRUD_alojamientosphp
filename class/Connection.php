<?php
// db_config.php: Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'alojamiento_app';
$username = 'root'; // Cambiar según configuración local
$password = ''; // Cambiar según configuración local

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>