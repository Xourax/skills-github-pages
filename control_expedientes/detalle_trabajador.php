<?php
session_start();
require_once 'conexion.php';

// Verificar sesión
if (empty($_SESSION['autenticado'])) {
    header("Location: index.php?error=sesion");
    exit();
}

// Validar ID
if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php?error=id_invalido");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM trabajadores WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $trabajador = $stmt->fetch();
    
    if (!$trabajador) {
        header("Location: dashboard.php?error=trabajador_no_encontrado");
        exit();
    }
    
    // Formatear datos
    $fecha_nacimiento = $trabajador['fecha_nacimiento'] ? date('d/m/Y', strtotime($trabajador['fecha_nacimiento'])) : 'No especificada';
    $fecha_ingreso = $trabajador['fecha_ingreso'] ? date('d/m/Y', strtotime($trabajador['fecha_ingreso'])) : 'No especificada';
    $edad = '';
    
    if ($trabajador['fecha_nacimiento']) {
        $nacimiento = new DateTime($trabajador['fecha_nacimiento']);
        $hoy = new DateTime();
        $edad = $hoy->diff($nacimiento)->y;
    }
    
} catch (PDOException $e) {
    error_log("Error al buscar trabajador: " . $e->getMessage());
    header("Location: dashboard.php?error=servidor");
    exit();
}

// Incluir cabecera común
require_once 'includes/header.php';
?>

<!-- Contenido principal -->
<main class="main-content">
    <header class="top-bar">
        <div class="user-actions">
            <a href="dashboard.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
    
        </div>
    </header>
    
    <div class="content-area">
        <?php include 'includes/employee_detail_card.php'; ?>
    </div>
</main>

<?php
// Incluir pie de página común
require_once 'includes/footer.php';
?>