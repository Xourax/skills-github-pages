<?php

// credenciales de la conexion de base de datos
$host = 'localhost';
$dbname = 'control_expedientes';
$user = 'root';
$pass = '';

try {

// Linea de codigo que realiza la conexion en si con los parametros ya pautados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

// Define como manejar errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Captura y muestra el error
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>