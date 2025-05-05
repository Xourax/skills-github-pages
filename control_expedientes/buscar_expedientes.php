<?php
session_start(); // Añadido para consistencia con obtener_expedientes.php
header('Content-Type: application/json');
require_once 'conexion.php';

// Verificar autenticación (igual que en obtener_expedientes.php)
if (!isset($_SESSION['autenticado'])) {
    http_response_code(401);
    die(json_encode(['error' => 'No autenticado']));
}

$termino = isset($_GET['busqueda']) ? '%' . trim($_GET['busqueda']) . '%' : '';

try {
    $sql = "SELECT id, cedula, nombres, apellidos, genero, cargo 
            FROM trabajadores 
            WHERE cedula LIKE ? OR nombres LIKE ? OR apellidos LIKE ?
            ORDER BY apellidos ASC
            LIMIT 50";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$termino, $termino, $termino]);
    echo json_encode([
        'success' => true,
        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC) // Mismo formato que obtener_expedientes.php
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>