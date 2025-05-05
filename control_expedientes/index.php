<?php

// Esto se encarga de guardar los datos de inicio de sesion que permite comunicar entre los archivos si existe una session ya iniciada
session_start();

?>


<!DOCTYPE html>
<html lang="es">

<!-- El encabezado donde ponemos titulo a la pagina y conectamos con los archivo CSS, el css que es un link es para cocitas como un candado-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Expedientes</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<!-- El formulario donde se pone el logo el formulario y envia datos de inicio a auth.php-->
<body>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="logo-container">
                <img src="img/sacs.png" alt="Logo Empresa" class="login-logo">
                <h1>Sistema de Expedientes</h1>
            </div>
            
            <form class="login-form" action="auth.php" method="post">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="usuario" placeholder="Usuario" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="clave" placeholder="Contraseña" required>
                </div>
                
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </button>
            </form>
        </div>
    </div>
</body>
</html>