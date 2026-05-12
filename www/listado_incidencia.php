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
                        </td>
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