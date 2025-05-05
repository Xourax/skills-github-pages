<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Sistema de Expedientes' ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/employee_detail.css">
    <link rel="stylesheet" href="css/expedientes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="img/sacs-white.png" alt="Logo" class="sidebar-logo">
                <h2>Sistema de Expedientes</h2>
            </div>
            
            <div class="user-panel">
                <div class="user-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div>
                    <strong><?= htmlspecialchars($_SESSION['usuario'] ?? 'Usuario') ?></strong>
                </div>
            </div>

            <nav class="sidebar-menu">
    <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="expedientes.php" class="<?= basename($_SERVER['PHP_SELF']) === 'detalle_trabajador.php' || basename($_SERVER['PHP_SELF']) === 'expedientes.php' ? 'active' : ''?>
    ">
        <i class="fas fa-folder-open"></i> Expedientes
    </a>
    <a href="#">
        <i class="fas fa-chart-bar"></i> Reportes
    </a>
    <a href="#">
        <i class="fas fa-cog"></i> Configuración
    </a>
    <a href="logout.php" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
</nav>
        </aside>