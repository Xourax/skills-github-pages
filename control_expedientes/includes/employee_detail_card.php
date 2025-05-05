<div class="employee-detail-container">
    <!-- Encabezado con foto y datos básicos -->
    <div class="employee-header">
        <div class="employee-avatar">
            <?php if (!empty($trabajador['foto'])): ?>
                <img src="<?= htmlspecialchars($trabajador['foto']) ?>" alt="Foto de <?= htmlspecialchars($trabajador['nombres']) ?>">
            <?php else: ?>
                <i class="fas fa-user"></i>
            <?php endif; ?>
        </div>
        <div class="employee-info">
            <h1 class="employee-name"><?= htmlspecialchars($trabajador['nombres'].' '.htmlspecialchars($trabajador['apellidos'])) ?></h1>
            <p class="employee-position"><?= htmlspecialchars($trabajador['cargo']) ?></p>
            <span class="badge <?= htmlspecialchars($trabajador['genero']) ?>">
                <?= htmlspecialchars($trabajador['genero']) ?>
            </span>
        </div>
    </div>
    
    <!-- Cuerpo con la información detallada -->
    <div class="employee-body">
        <!-- Columna izquierda -->
        <div class="employee-column">
            <!-- Información Personal -->
            <div class="info-section">
                <h3><i class="fas fa-id-card"></i> Información Personal</h3>
                <div class="info-grid">
                    <div class="info-label">Cédula:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['cedula']) ?></div>
                    
                    <div class="info-label">Fecha Nacimiento:</div>
                    <div class="info-value">
                        <?= $fecha_nacimiento ?>
                        <?= $edad ? "($edad años)" : '' ?>
                    </div>
                    
                    <div class="info-label">Estado Civil:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['estado_civil'] ?? 'No especificado') ?></div>
                    
                    <div class="info-label">Nivel Instrucción:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['nivel_instruccion'] ?? 'No especificado') ?></div>
                </div>
            </div>
            
            <!-- Información Laboral -->
            <div class="info-section">
                <h3><i class="fas fa-briefcase"></i> Información Laboral</h3>
                <div class="info-grid">
                    <div class="info-label">Cargo:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['cargo']) ?></div>
                    
                    <div class="info-label">Fecha Ingreso:</div>
                    <div class="info-value"><?= $fecha_ingreso ?></div>
                    
                    <div class="info-label">Estado:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['estado'] ?? 'Activo') ?></div>
                    
                    <?php if ($trabajador['estado'] !== 'Activo' && !empty($trabajador['motivo_inactividad'])): ?>
                    <div class="info-label">Motivo Inactividad:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['motivo_inactividad']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Columna derecha -->
        <div class="employee-column">
            <!-- Datos de Contacto -->
            <div class="info-section">
                <h3><i class="fas fa-address-book"></i> Datos de Contacto</h3>
                <div class="info-grid">
                    <div class="info-label">Dirección:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['direccion'] ?? 'No especificada') ?></div>
                    
                    <div class="info-label">Teléfono:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['telefono'] ?? 'No especificado') ?></div>
                    
                    <div class="info-label">Correo:</div>
                    <div class="info-value">
                        <?php if (!empty($trabajador['correo_electronico'])): ?>
                            <a href="mailto:<?= htmlspecialchars($trabajador['correo_electronico']) ?>">
                                <?= htmlspecialchars($trabajador['correo_electronico']) ?>
                            </a>
                        <?php else: ?>
                            No especificado
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Salud -->
            <div class="info-section">
                <h3><i class="fas fa-heartbeat"></i> Información de Salud</h3>
                <div class="info-grid">
                    <div class="info-label">Padece Patología:</div>
                    <div class="info-value"><?= $trabajador['padece_patologia'] === 'Si' ? 'Sí' : ($trabajador['padece_patologia'] === 'No' ? 'No' : 'No especificado') ?></div>
                    
                    <?php if ($trabajador['padece_patologia'] === 'Si' && !empty($trabajador['especificacion_patologia'])): ?>
                    <div class="info-label">Especificación:</div>
                    <div class="info-value"><?= htmlspecialchars($trabajador['especificacion_patologia']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            
        </div>
    </div>
    
    <!-- Pie de página con acciones -->
    <div class="employee-footer">
        <div class="employee-status">
            <span class="status-badge <?= strtolower($trabajador['estado'] ?? 'activo') ?>">
                <?= htmlspecialchars($trabajador['estado'] ?? 'Activo') ?>
            </span>
        </div>

    </div>
</div>