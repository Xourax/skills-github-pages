-- Tabla de usuarios

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL, -- Almacenará el hash de la contraseña
    nombre_completo VARCHAR(100),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Creacion de usuarios (es decir llenar datos de la tabla)

INSERT INTO usuarios (usuario, clave, nombre_completo) 

-- Ejemplo (la clave de el ejemplo esta incriptada es 1234)

VALUES ('Leonard', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Leonard McCoy');

-- Tabla de trabajadores

CREATE TABLE trabajadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(10) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    genero ENUM('Masculino', 'Femenino', 'Otro'),
    fecha_nacimiento DATE,
    cargo VARCHAR(100),
    fecha_ingreso DATE,
    direccion TEXT,
    telefono VARCHAR(15)
);

-- Agregar usuario

iNSERT INTO trabajadores (cedula, nombres, apellidos, genero, cargo) 

-- Ejemplos para agg trabajadores en la tabla

VALUES
    ('27585167', 'Juan', 'Pérez', 'Masculino', 'Analista'),
    ('12875197', 'María', 'Gómez', 'Femenino', 'Gerente');


    ('12875180', 'María', 'Lopez', 'Femenino', 'Directora');

-- Otros datos agregados

ALTER TABLE control_expedientes.trabajadores
ADD COLUMN foto VARCHAR(255) NULL COMMENT 'Ruta o referencia a la foto subida',
ADD COLUMN estado_civil ENUM('Soltero', 'Casado') NULL,
ADD COLUMN correo_electronico VARCHAR(100) NULL,
ADD COLUMN nivel_instruccion VARCHAR(100) NULL,
ADD COLUMN padece_patologia BOOLEAN NULL COMMENT '0 = No, 1 = Si',
ADD COLUMN especificacion_patologia TEXT NULL,
ADD COLUMN estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
ADD COLUMN motivo_inactividad TEXT NULL;




INSERT INTO control_expedientes.trabajadores (
    nombres, apellidos, cedula, genero, fecha_nacimiento, cargo, 
    fecha_ingreso, direccion, telefono, foto, estado_civil, 
    correo_electronico, nivel_instruccion, padece_patologia, 
    especificacion_patologia, estado, motivo_inactividad
) VALUES
    ('Juan', 'Pérez', '12128990', 'Masculino', '1985-05-15', 'Gerente', 
     '2020-01-10', 'Calle Principal #123', '809-555-1234', 'fotos/juan.jpg', 'Casado', 
     'juan@empresa.com', 'Universitario', 0, NULL, 'Activo', NULL),
     
    ('María', 'González', '23005023', 'Femenino', '1990-08-22', 'Analista', 
     '2021-03-15', 'Avenida Central #456', '809-555-5678', 'fotos/maria.jpg', 'Soltero', 
     'maria@empresa.com', 'Técnico', 1, 'Hipertensión controlada', 'Activo', NULL),
     
    ('Carlos', 'Rodríguez', '219099354', 'Masculino', '1982-11-30', 'Supervisor', 
     '2019-07-01', 'Calle Secundaria #789', '809-555-9012', 'fotos/carlos.jpg', 'Casado', 
     'carlos@empresa.com', 'Universitario', 0, NULL, 'Inactivo', 'Renuncia voluntaria');




     /* Estructura principal */
.app-container {
    display: flex;
    min-height: 100vh;
}


/* Tarjetas de expedientes */
.expedientes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
}

.expediente-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.expediente-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

.expediente-content {
    padding: 20px;
}

.expediente-content h3 {
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-size: 1.2rem;
}

.genero {
    margin: 0 0 15px 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.expediente-details {
    margin-top: 15px;
}

.expediente-details p {
    margin: 8px 0;
    font-size: 0.9rem;
}

.expediente-details strong {
    color: #495057;
    font-weight: 600;
}

.expediente-footer {
    padding: 15px;
    background: #f8f9fa;
    border-top: 1px solid #eee;
    text-align: right;
}

.btn-ver {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 15px;
    background: #1c2b8f;
    color: white;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.btn-ver:hover {
    background: #0d47a1;
    transform: translateY(-2px);
}

/* Estados */
.loading-state, .error-state, .no-results {
    grid-column: 1 / -1;
    text-align: center;
    padding: 40px;
}

.loading-state {
    color: #1c2b8f;
}

.error-state {
    color: #dc3545;
}

.no-results {
    color: #6c757d;
}

.btn-retry {
    margin-top: 10px;
    padding: 8px 15px;
    background: #d5160a;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-retry:hover {
    background: #b71c1c;
}

/* Barra de búsqueda */
.search-form {
    width: 100%;
    max-width: 500px;
}

.search-box {
    position: relative;
}

.search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.search-box input {
    width: 100%;
    padding: 10px 15px 10px 40px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.search-box input:focus {
    outline: none;
    border-color: #1c2b8f;
    box-shadow: 0 0 0 3px rgba(28, 43, 143, 0.1);
}

