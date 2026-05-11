<?php
include "conexion.php";

$stmt = $conn->prepare("SELECT * FROM INCIDENCIA");
$stmt->execute();
$incidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="ms-3 fw-bold fs-4 text-secondary">Listado de incidencias</span>
    </div>
    <a href="index.php" class="btn btn-outline-primary">
        <i class="bi bi-house-door-fill fs-4"></i>
    </a>
</header>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incidencias as $inc): ?>
                    <tr>
                        <td><?= $inc['num_incidencia'] ?></td>
                        <td><?= $inc['asunto'] ?></td>
                        <td>
                            <?php if ($inc['estado'] === 'Abierta'): ?>
                                <span class="badge bg-warning text-dark">Abierta</span>
                            <?php elseif ($inc['estado'] === 'En proceso'): ?>
                                <span class="badge bg-info text-dark">En proceso</span>
                            <?php else: ?>
                                <span class="badge bg-success">Cerrada</span>
                            <?php endif; ?>
                        </td>-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 08-05-2026 a las 10:40:04
-- Versión del servidor: 8.0.46
-- Versión de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `incidencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ACTUACION`
--

CREATE TABLE `ACTUACION` (
  `id_actuacion` int NOT NULL,
  `descripcion` varchar(2000) NOT NULL,
  `tipo_actuacion` varchar(200) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_incidencia` int DEFAULT NULL,
  `id_tecnico` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DEPARTAMENTO`
--

CREATE TABLE `DEPARTAMENTO` (
  `departamento_id` int UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `DEPARTAMENTO`
--

INSERT INTO `DEPARTAMENTO` (`departamento_id`, `nombre`) VALUES
(1, 'Informática'),
(2, 'Secretaría'),
(3, 'Dirección'),
(4, 'Mediateca'),
(5, 'Mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HISTORIAL_ESTADO`
--

CREATE TABLE `HISTORIAL_ESTADO` (
  `id_historial` int NOT NULL,
  `id_incidencia` int NOT NULL,
  `estado_anterior` varchar(50) DEFAULT NULL,
  `estado_nuevo` varchar(50) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INCIDENCIA`
--

CREATE TABLE `INCIDENCIA` (
  `num_incidencia` int NOT NULL,
  `asunto` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `estado` enum('Abierta','En proceso','Cerrada') NOT NULL DEFAULT 'Abierta',
  `id_tipo` int DEFAULT NULL,3
  `departamento_id` int UNSIGNED DEFAULT NULL,
  `id_usuario_creador` int UNSIGNED DEFAULT NULL,
  `id_tecnico` int UNSIGNED DEFAULT NULL,
  `id_prioridad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `INCIDENCIA`
--

INSERT INTO `INCIDENCIA` (`num_incidencia`, `asunto`, `descripcion`, `fecha_inicio`, `fecha_fin`, `estado`, `id_tipo`, `departamento_id`, `id_usuario_creador`, `id_tecnico`, `id_prioridad`) VALUES
(1, 'PC no enciende', 'El ordenador no arranca desde esta mañana.', '2026-05-08 10:33:26', NULL, 'Abierta', NULL, 1, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRIORIDAD`
--

CREATE TABLE `PRIORIDAD` (
  `id_prioridad` int NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `PRIORIDAD`
--

INSERT INTO `PRIORIDAD` (`id_prioridad`, `nombre`) VALUES
(1, 'Alta'),
(2, 'Media'),
(3, 'Baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO`
--

CREATE TABLE `TIPO` (
  `id_tipo` int NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `TIPO`
--

INSERT INTO `TIPO` (`id_tipo`, `nombre`) VALUES
(1, 'Hardware'),
(2, 'Software'),
(3, 'Red'),
(4, 'Aula'),
(5, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE `USUARIO` (
  `id_usuario` int UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `rol` enum('usuario','tecnico','admin') NOT NULL,
  `codigo` varchar(100) NOT NULL DEFAULT 'TECNICO123'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`id_usuario`, `nombre`, `rol`, `codigo`) VALUES
(1, 'Administrador', 'admin', 'ADMIN123'),
(2, 'Gerard Torrent', 'tecnico', 'TECNICO123'),
(3, 'Toni Marti', 'tecnico', 'TECNICO123'),
(4, 'Ermengol Bota', 'tecnico', 'TECNICO123'),
(5, 'Alvaro Perez', 'tecnico', 'TECNICO123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ACTUACION`
--
ALTER TABLE `ACTUACION`
  ADD PRIMARY KEY (`id_actuacion`),
  ADD KEY `id_incidencia` (`id_incidencia`),
  ADD KEY `id_tecnico` (`id_tecnico`);

--
-- Indices de la tabla `DEPARTAMENTO`
--
ALTER TABLE `DEPARTAMENTO`
  ADD PRIMARY KEY (`departamento_id`);

--
-- Indices de la tabla `HISTORIAL_ESTADO`
--
ALTER TABLE `HISTORIAL_ESTADO`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_incidencia` (`id_incidencia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
  ADD PRIMARY KEY (`num_incidencia`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_usuario_creador` (`id_usuario_creador`),
  ADD KEY `idx_estado` (`estado`),
  ADD KEY `idx_tecnico` (`id_tecnico`),
  ADD KEY `idx_prioridad` (`id_prioridad`),
  ADD KEY `idx_departamento` (`departamento_id`);

--
-- Indices de la tabla `PRIORIDAD`
--
ALTER TABLE `PRIORIDAD`
  ADD PRIMARY KEY (`id_prioridad`);

--
-- Indices de la tabla `TIPO`
--
ALTER TABLE `TIPO`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ACTUACION`
--
ALTER TABLE `ACTUACION`
  MODIFY `id_actuacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `DEPARTAMENTO`
--
ALTER TABLE `DEPARTAMENTO`
  MODIFY `departamento_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `HISTORIAL_ESTADO`
--
ALTER TABLE `HISTORIAL_ESTADO`
  MODIFY `id_historial` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
  MODIFY `num_incidencia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `PRIORIDAD`
--
ALTER TABLE `PRIORIDAD`
  MODIFY `id_prioridad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TIPO`
--
ALTER TABLE `TIPO`
  MODIFY `id_tipo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `id_usuario` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ACTUACION`
--
ALTER TABLE `ACTUACION`
  ADD CONSTRAINT `ACTUACION_ibfk_1` FOREIGN KEY (`id_incidencia`) REFERENCES `INCIDENCIA` (`num_incidencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ACTUACION_ibfk_2` FOREIGN KEY (`id_tecnico`) REFERENCES `USUARIO` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `HISTORIAL_ESTADO`
--
ALTER TABLE `HISTORIAL_ESTADO`
  ADD CONSTRAINT `HISTORIAL_ESTADO_ibfk_1` FOREIGN KEY (`id_incidencia`) REFERENCES `INCIDENCIA` (`num_incidencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `HISTORIAL_ESTADO_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `USUARIO` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
  ADD CONSTRAINT `INCIDENCIA_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `TIPO` (`id_tipo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `INCIDENCIA_ibfk_2` FOREIGN KEY (`departamento_id`) REFERENCES `DEPARTAMENTO` (`departamento_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `INCIDENCIA_ibfk_3` FOREIGN KEY (`id_usuario_creador`) REFERENCES `USUARIO` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `INCIDENCIA_ibfk_4` FOREIGN KEY (`id_tecnico`) REFERENCES `USUARIO` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `INCIDENCIA_ibfk_5` FOREIGN KEY (`id_prioridad`) REFERENCES `PRIORIDAD` (`id_prioridad`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

                        <td>
                            <?php if ($inc['id_prioridad'] == 1): ?>
                                <span class="badge bg-danger">Alta</span>
                            <?php elseif ($inc['id_prioridad'] == 2): ?>
                                <span class="badge bg-warning text-dark">Media</span>
                            <?php else: ?>
                                <span class="badge bg-success">Baja</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $inc['fecha_inicio'] ?></td>
                        <td>
                            <a href="gestionar_incidencia.php?id=<?= $inc['num_incidencia'] ?>" class="btn btn-sm btn-primary">Gestionar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>