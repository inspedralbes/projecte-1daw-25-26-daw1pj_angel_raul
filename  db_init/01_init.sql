CREATE DATABASE IF NOT EXISTS incidencias;
USE incidencias;

CREATE TABLE IF NOT EXISTS TIPO(
    id_tipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS DEPARTAMENTO(
    departamento_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS USUARIO(
    id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    rol ENUM('usuario', 'tecnico', 'admin') NOT NULL,
    codigo VARCHAR(100) NOT NULL DEFAULT 'TECNICO123'
);

CREATE TABLE IF NOT EXISTS PRIORIDAD(
    id_prioridad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS INCIDENCIA(
    num_incidencia INT AUTO_INCREMENT PRIMARY KEY,
    asunto VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_fin TIMESTAMP NULL DEFAULT NULL,
    estado ENUM('Abierta', 'En proceso', 'Cerrada') NOT NULL DEFAULT 'Abierta',
    id_tipo INT DEFAULT NULL,
    departamento_id INT UNSIGNED DEFAULT NULL,
    id_usuario_creador INT UNSIGNED DEFAULT NULL,
    id_tecnico INT UNSIGNED DEFAULT NULL,
    id_prioridad INT DEFAULT NULL,
    FOREIGN KEY (id_tipo) REFERENCES TIPO(id_tipo) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (departamento_id) REFERENCES DEPARTAMENTO(departamento_id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_usuario_creador) REFERENCES USUARIO(id_usuario) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_tecnico) REFERENCES USUARIO(id_usuario) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_prioridad) REFERENCES PRIORIDAD(id_prioridad) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS ACTUACION(
    id_actuacion INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(2000) NOT NULL,
    tipo_actuacion VARCHAR(200) NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_incidencia INT DEFAULT NULL,
    id_tecnico INT UNSIGNED DEFAULT NULL,
    FOREIGN KEY (id_incidencia) REFERENCES INCIDENCIA(num_incidencia) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tecnico) REFERENCES USUARIO(id_usuario) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS HISTORIAL_ESTADO(
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    id_incidencia INT NOT NULL,
    estado_anterior VARCHAR(50) DEFAULT NULL,
    estado_nuevo VARCHAR(50) DEFAULT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT UNSIGNED DEFAULT NULL,
    FOREIGN KEY (id_incidencia) REFERENCES INCIDENCIA(num_incidencia) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Datos iniciales
INSERT INTO TIPO (nombre) VALUES
('Hardware'),('Software'),('Red'),('Aula'),('Otros');

INSERT INTO DEPARTAMENTO (nombre) VALUES
('Informática'),('Secretaría'),('Dirección'),('Mediateca'),('Mantenimiento');

INSERT INTO PRIORIDAD (nombre) VALUES
('Alta'),('Media'),('Baja');

INSERT INTO USUARIO (nombre, rol, codigo) VALUES
('Administrador', 'admin',   'ADMIN123'),
('Gerard Torrent','tecnico', 'TECNICO123'),
('Toni Marti',    'tecnico', 'TECNICO123'),
('Ermengol Bota', 'tecnico', 'TECNICO123'),
('Alvaro Perez',  'tecnico', 'TECNICO123');

INSERT INTO INCIDENCIA (asunto, descripcion, departamento_id, id_prioridad, estado) VALUES
('PC no enciende',       'El ordenador del aula no arranca desde esta mañana.', 1, 1, 'Abierta'),
('Impresora sin papel',  'La impresora de secretaría se ha quedado sin papel.', 2, 3, 'Abierta');