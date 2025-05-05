<?php
require_once 'conexion.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT genero, COUNT(*) as total FROM trabajadores GROUP BY genero");
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Normalizar datos para asegurar consistencia
    $estadisticas = [
        ['genero' => 'Masculino', 'total' => 0],
        ['genero' => 'Femenino', 'total' => 0]
    ];
    
    foreach ($resultados as $fila) {
        $genero = ucfirst(strtolower($fila['genero']));
        if ($genero === 'Masculino' || $genero === 'Femenino') {
            $index = array_search($genero, array_column($estadisticas, 'genero'));
            if ($index !== false) {
                $estadisticas[$index]['total'] = (int)$fila['total'];
            }
        }
    }
    
    echo json_encode($estadisticas);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error en el servidor',
        'message' => $e->getMessage()
    ]);
}