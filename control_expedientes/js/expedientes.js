document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    const inputBusqueda = document.getElementById('input-busqueda'); // ¡Corrección clave!

    let searchTimeout;
    inputBusqueda.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            cargarExpedientes(this.value.trim());
        }, 300);
    });

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        cargarExpedientes(inputBusqueda.value.trim());
    });

    // Cargar expedientes inicialmente
    cargarExpedientes();
});

async function cargarExpedientes(busqueda = '') {
    const container = document.getElementById('expedientes-container');
    
    try {
        container.innerHTML = `
            <div class="loading-state">
                <i class="fas fa-spinner fa-spin"></i>
                <p>Cargando expedientes...</p>
            </div>
        `;

        // Usar rutas relativas correctas (ajusta según tu estructura de carpetas)
        const url = busqueda 
            ? `./buscar_expedientes.php?busqueda=${encodeURIComponent(busqueda)}` 
            : './obtener_expedientes.php';
            
        const response = await fetch(url);
        
        if (!response.ok) {
            throw new Error(`Error ${response.status}: ${response.statusText}`);
        }
        
        const data = await response.json();

        if (!data || data.length === 0) {
            container.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-folder-open"></i>
                    <p>${busqueda ? 'No hay resultados' : 'No hay expedientes'}</p>
                </div>
            `;
            return;
        }

        // Mostrar resultados (ajustado para el formato de respuesta de ambos PHP)
        const trabajadores = data.data || data; // Compatible con ambos endpoints
        container.innerHTML = trabajadores.map(trabajador => `
            <div class="expediente-card">
                <div class="expediente-content">
                    <h3>${trabajador.nombres || ''} ${trabajador.apellidos || ''}</h3>
                    <p class="genero">${trabajador.genero || 'No especificado'}</p>
                    <div class="expediente-details">
                        <p><strong>Cédula:</strong> ${trabajador.cedula || 'N/A'}</p>
                        <p><strong>Cargo:</strong> ${trabajador.cargo || 'No especificado'}</p>
                    </div>
                </div>
                <div class="expediente-footer">
                    <a href="detalle_trabajador.php?id=${trabajador.id}" class="btn-ver">
                        <i class="fas fa-eye"></i> Ver Detalles
                    </a>
                </div>
            </div>
        `).join('');

    } catch (error) {
        console.error('Error:', error);
        container.innerHTML = `
            <div class="error-state">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Error al cargar expedientes</p>
                <small>${error.message}</small>
                <button onclick="cargarExpedientes()" class="btn-retry">
                    <i class="fas fa-sync-alt"></i> Reintentar
                </button>
            </div>
        `;
    }
}