<?php
// El AJAX echo con js trabaja enviando a este scrip y este revisa la base datos para proporcionar resultados

header('Content-Type: application/json');
require_once 'conexion.php';

$termino = isset($_GET['busqueda']) ? '%' . trim($_GET['busqueda']) . '%' : '';

try {
    $sql = "SELECT id, cedula, nombres, apellidos, genero, cargo 
            FROM trabajadores 
            WHERE cedula LIKE ? OR nombres LIKE ? OR apellidos LIKE ?
            ORDER BY apellidos ASC
            LIMIT 50";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$termino, $termino, $termino]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>