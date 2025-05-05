<?php

// Realiza la conexion y el inicio de sesion
session_start();
require_once 'conexion.php';

// Verifica que ningun campo este vacio de asi estarlo devuelve al login notificando que un campo esta vacio
if (empty($_POST['usuario']) || empty($_POST['clave'])) {
    header("Location: error.php?error=campos_vacios");
    exit();
}

// El trim evita tomar espacios en cuenta
$usuario = trim($_POST['usuario']);
$clave = trim($_POST['clave']);

try {
// Buscar usuario en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar que las credenciales sean correctas
    if ($user && $clave === $user['clave']) {

// Almacena en el inicio de sesion los datos como ultimo acceso o nombre etc
        $_SESSION = [
            'autenticado' => true,
            'usuario' => $user['usuario'],
            'nombre' => $user['nombre_completo'],
            'rol' => $user['rol'] ?? 'usuario',
            'ultimo_acceso' => time()
        ];
        
 // Tras las comprobacion usa una linea de codigo de javascrip para redirigir al dashloard
        echo '<script>window.location.href = "dashboard.php";</script>';
        header("Location: dashboard.php");
        exit();


// Manejo de errores como la base de dato o credenciales incorrectas si es de ser asi redirige al index pero notifica un error
    } else {
        header("Location: error.php?error=credenciales");
        exit();
    }
} catch (PDOException $e) {
    error_log("Error de base de datos: " . $e->getMessage());
    header("Location: error.php?error=servidor");
    exit();
}
?>