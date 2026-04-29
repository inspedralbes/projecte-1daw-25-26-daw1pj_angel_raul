CREATE DATABASE IF NOT EXISTS incidencias;
USE incidencias;


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
    rol ENUM('usuario', 'tecnico', 'admin') NOT NULL
);

CREATE TABLE INCIDENCIA(
    num_incidencia INT AUTO_INCREMENT PRIMARY KEY,
    asunto VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('Abierta', 'En proceso', 'Cerrada') NOT NULL DEFAULT 'Abierta',
    prioridad ENUM('Alta', 'Media', 'Baja') NOT NULL,

    id_tipo INT,
    departamento_id INT UNSIGNED,
    id_usuario_creador INT UNSIGNED,
    id_tecnico INT UNSIGNED,

    FOREIGN KEY (id_tipo) REFERENCES TIPO(id_tipo),
    FOREIGN KEY (departamento_id) REFERENCES DEPARTAMENTO(departamento_id),
    FOREIGN KEY (id_usuario_creador) REFERENCES USUARIO(id_usuario),
    FOREIGN KEY (id_tecnico) REFERENCES USUARIO(id_usuario)
);

CREATE TABLE ACTUACION(
    id_actuacion INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(2000) NOT NULL,
    tipo_actuacion VARCHAR(200) NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    id_incidencia INT,
    id_tecnico INT UNSIGNED,

    FOREIGN KEY (id_incidencia) REFERENCES INCIDENCIA(num_incidencia),
    FOREIGN KEY (id_tecnico) REFERENCES USUARIO(id_usuario)
);
