<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    session_destroy();
    header("Location: index.php?error=sesion");
    exit();
}
require_once 'includes/header.php';

?>
        <main class="main-content">
            <header class="top-bar">
                <form id="search-form" class="search-form">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input 
                            type="text" 
                            id="input-busqueda"
                            placeholder="Buscar trabajadores..." 
                            autocomplete="off"
                        >
                    </div>
                </form>

                <div class="user-actions">
                    <span class="welcome-msg">Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></span>
                </div>
            </header>
            
            <div class="content-area" id="content-area">
                <!-- El contenido se carga dinámicamente via JS -->
                <div class="loading-full">
                    <i class="fas fa-spinner fa-spin"></i>
                    <p>Cargando datos iniciales...</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Incluimos el archivo JS separado -->
    <script src="js/dashboard.js"></script>
</body>
</html>