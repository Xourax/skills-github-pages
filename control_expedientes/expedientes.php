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
                            placeholder="Buscar expedientes..." 
                            autocomplete="off"
                        >
                    </div>
                </form>

                <div class="user-actions">
                    <span class="welcome-msg">Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></span>
                </div>
            </header>
            
            <div class="content-area">
                <section class="expedientes-section">
                    <div class="section-header">
                        <h2><i class="fas fa-folder-open"></i> Expedientes Registrados</h2>
                    </div>
                    
                    <div id="expedientes-container" class="expedientes-grid">
                        <div class="loading-state">
                            <i class="fas fa-spinner fa-spin"></i>
                            <p>Cargando expedientes...</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <script src="js/expedientes.js"></script>

</body>
</html>