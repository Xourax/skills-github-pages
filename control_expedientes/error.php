<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Sistema de Expedientes</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="logo-container">
                <img src="img/sacs.png" alt="Logo" class="login-logo">
                <h1>Error en el Sistema</h1>
            </div>
            
            <div class="error-container">
                <?php 
                $mensajes = [
                    'campos_vacios' => 'Todos los campos son requeridos',
                    'credenciales' => 'Usuario o contraseña incorrectos',
                    'sesion' => 'Sesión inválida o expirada',
                    'servidor' => 'Error del servidor',
                    'default' => 'Error desconocido'
                ];
                
                $error = $_GET['error'] ?? 'default';
                $mensaje = $mensajes[$error] ?? $mensajes['default'];
                ?>
                
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3><?= htmlspecialchars($mensaje) ?></h3>
                    <p>Por favor intente nuevamente</p>
                    <a href="index.php" class="btn">Volver al Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>