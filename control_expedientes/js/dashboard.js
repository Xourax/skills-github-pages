// Selectores DOM
const searchForm = document.getElementById('search-form');
const inputBusqueda = document.getElementById('input-busqueda');
const contentArea = document.getElementById('content-area');

// Función para mostrar estadísticas
async function mostrarEstadisticas() {
    try {
        // Mostrar loader
        contentArea.innerHTML = `
            <div class="loading-full">
                <i class="fas fa-spinner fa-spin"></i>
                <p>Cargando estadísticas...</p>
            </div>
        `;

        // Obtener datos
        const response = await fetch('obtener_estadisticas.php');
        
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const estadisticas = await response.json();

        // Construir HTML
        let html = `
            <section class="stats-section">
                <h2><i class="fas fa-chart-pie"></i> Estadísticas</h2>
                <div class="stats-grid">
        `;

        estadisticas.forEach(est => {
            html += `
                <div class="stat-card">
                    <h3>${est.total}</h3>
                    <p>${est.genero}</p>
                    <i class="fas fa-${est.genero.toLowerCase() === 'femenino' ? 'female' : 'male'}"></i>
                </div>
            `;
        });

        // Total de trabajadores
        const totalTrabajadores = estadisticas.reduce((sum, est) => sum + parseInt(est.total), 0);
        
        html += `
                <div class="stat-card highlight">
                    <h3>${totalTrabajadores}</h3>
                    <p>Total Trabajadores</p>
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </section>
        `;

        // Insertar en el DOM
        contentArea.innerHTML = html;

    } catch (error) {
        console.error('Error al cargar estadísticas:', error);
        contentArea.innerHTML = `
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Error al cargar las estadísticas</p>
                <button onclick="mostrarEstadisticas()">Reintentar</button>
            </div>
        `;
    }
}

// Función para realizar búsqueda
async function realizarBusqueda(termino) {
    // Si el término está vacío, mostrar estadísticas
    if (!termino || termino.trim() === '') {
        await mostrarEstadisticas();
        return;
    }

    try {
        // Mostrar loader
        contentArea.innerHTML = `
            <div class="loading-full">
                <i class="fas fa-spinner fa-spin"></i>
                <p>Buscando "${termino}"...</p>
            </div>
        `;

        // Obtener resultados
        const response = await fetch(`buscar_trabajadores.php?busqueda=${encodeURIComponent(termino)}`);
        
        if (!response.ok) {
            throw new Error('Error en la búsqueda');
        }

        const resultados = await response.json();

        // Construir HTML de resultados
        if (resultados.length > 0) {
            let html = `
                <section class="search-results">
                    <h2><i class="fas fa-search"></i> Resultados para "${termino}"</h2>
                    <div class="results-grid">
            `;

            resultados.forEach(trabajador => {
                html += `
                    <article class="employee-card">
                        <header class="card-header">
                            <h3>${trabajador.nombres} ${trabajador.apellidos}</h3>
                            <span class="gender-badge ${trabajador.genero.toLowerCase()}">
                                ${trabajador.genero}
                            </span>
                        </header>
                        <div class="card-body">
                            <p><strong>Cédula:</strong> ${trabajador.cedula}</p>
                            <p><strong>Cargo:</strong> ${trabajador.cargo || 'No especificado'}</p>
                        </div>
                        <footer class="card-footer">
                            <a href="detalle_trabajador.php?id=${trabajador.id}" class="view-btn">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                        </footer>
                    </article>
                `;
            });

            html += `</div></section>`;
            contentArea.innerHTML = html;
        } else {
            // No hay resultados
            contentArea.innerHTML = `
                <section class="search-results">
                    <h2><i class="fas fa-search"></i> Resultados para "${termino}"</h2>
                    <div class="no-results">
                        <i class="fas fa-exclamation-circle"></i>
                        <p>No se encontraron resultados</p>
                    </div>
                </section>
            `;
        }

    } catch (error) {
        console.error('Error en la búsqueda:', error);
        contentArea.innerHTML = `
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Error al realizar la búsqueda</p>
                <button onclick="realizarBusqueda('${termino}')">Reintentar</button>
            </div>
        `;
    }
}

// Manejadores de eventos
function setupEventListeners() {
    // Formulario de búsqueda
    searchForm.addEventListener('submit', (e) => {
        e.preventDefault();
        realizarBusqueda(inputBusqueda.value.trim());
    });

    // Búsqueda en tiempo real con debounce
    let timeout;
    inputBusqueda.addEventListener('input', () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            realizarBusqueda(inputBusqueda.value.trim());
        }, 300);
    });
}

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
    setupEventListeners();
    mostrarEstadisticas();
});

// Hacer funciones disponibles globalmente para botones de reintento
window.mostrarEstadisticas = mostrarEstadisticas;
window.realizarBusqueda = realizarBusqueda;