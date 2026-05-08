CREATE TABLE TIPO(
    id_tipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL
);

CREATE TABLE DEPARTAMENTO(
    departamento_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL
);

CREATE TABLE USUARIO(
    id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    rol ENUM('usuario', 'tecnico', 'admin') NOT NULL,
    codigo VARCHAR(50) UNIQUE NULL
);

CREATE TABLE PRIORIDAD(
    id_prioridad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

INSERT INTO PRIORIDAD(nombre) VALUES ('Alta'), ('Media'), ('Baja');

CREATE TABLE INCIDENCIA(
    num_incidencia INT AUTO_INCREMENT PRIMARY KEY,
    asunto VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_fin TIMESTAMP NULL,
    estado ENUM('Abierta', 'En proceso', 'Cerrada') NOT NULL DEFAULT 'Abierta',
    id_tipo INT,
    departamento_id INT UNSIGNED,
    id_usuario_creador INT UNSIGNED,
    id_tecnico INT UNSIGNED,
    id_prioridad INT,
    FOREIGN KEY (id_tipo) REFERENCES TIPO(id_tipo)
        ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (departamento_id) REFERENCES DEPARTAMENTO(departamento_id)
        ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (id_usuario_creador) REFERENCES USUARIO(id_usuario)
        ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (id_tecnico) REFERENCES USUARIO(id_usuario)
        ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (id_prioridad) REFERENCES PRIORIDAD(id_prioridad)
        ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE ACTUACION(
    id_actuacion INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(2000) NOT NULL,
    tipo_actuacion VARCHAR(200) NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_incidencia INT,
    id_tecnico INT UNSIGNED,
    FOREIGN KEY (id_incidencia) REFERENCES INCIDENCIA(num_incidencia)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_tecnico) REFERENCES USUARIO(id_usuario)
        ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE HISTORIAL_ESTADO(
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    id_incidencia INT NOT NULL,
    estado_anterior VARCHAR(50),
    estado_nuevo VARCHAR(50),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT,
    FOREIGN KEY (id_incidencia) REFERENCES INCIDENCIA(num_incidencia)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario)
        ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE ADJUNTO(
    id_adjunto INT AUTO_INCREMENT PRIMARY KEY,
    id_incidencia INT NOT NULL,
    ruta VARCHAR(500) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_incidencia) REFERENCES INCIDENCIA(num_incidencia)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX idx_estado ON INCIDENCIA(estado);
CREATE INDEX idx_tecnico ON INCIDENCIA(id_tecnico);
CREATE INDEX idx_prioridad ON INCIDENCIA(id_prioridad);
CREATE INDEX idx_departamento ON INCIDENCIA(departamento_id);
