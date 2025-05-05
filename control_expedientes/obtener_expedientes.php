<?php
session_start();
require_once 'conexion.php';

// Verificar autenticación
if (!isset($_SESSION['autenticado'])) {
    header('Content-Type: application/json');
    http_response_code(401);
    die(json_encode(['error' => 'No autenticado']));
}

header('Content-Type: application/json; charset=utf-8');

try {
    // Ordenamos por apellidos ASC (A-Z) en lugar de fecha_ingreso
    $query = "SELECT 
                id,
                nombres, 
                apellidos, 
                cedula, 
                genero, 
                cargo,
                fecha_ingreso AS fecha_registro,
                estado
              FROM trabajadores
              ORDER BY apellidos ASC";  // ¡Cambio clave aquí!
    
    $stmt = $pdo->query($query);
    $expedientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'count' => count($expedientes),
        'data' => $expedientes
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error de base de datos',
        'detalle' => $e->getMessage()
    ]);
}
?>