<?php
include "conexion.php";

$id_tecnico  = $_GET['tecnico'] ?? '';
$tecnicos    = $conn->query("SELECT * FROM USUARIO WHERE rol = 'tecnico'")->fetchAll(PDO::FETCH_ASSOC);
$incidencias = [];

if ($id_tecnico) {
    $stmt = $conn->prepare("SELECT * FROM INCIDENCIA WHERE id_tecnico = ?");
    $stmt->execute([$id_tecnico]);
    $incidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Técnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="ms-3 fw-bold fs-4 text-primary">Panel Técnico</span>
    </div>
    <a href="index.php" class="btn btn-outline-primary">
        <i class="bi bi-house-door-fill fs-4"></i>
    </a>
</header>

<div class="container mt-4">

    <div class="card shadow-sm p-4 mx-auto mb-4 text-center" style="max-width: 400px;">
        <h5 class="fw-bold mb-3">¿Quién eres?</h5>
        <form method="GET">
            <select name="tecnico" class="form-select" onchange="this.form.submit()">
                <option value="">Selecciona tu nombre</option>
                <?php foreach ($tecnicos as $tec): ?>
                    <option value="<?= $tec['id_usuario'] ?>" <?= $id_tecnico == $tec['id_usuario'] ? 'selected' : '' ?>>
                        <?= $tec['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <?php if ($id_tecnico): ?>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th><th>Asunto</th><th>Estado</th><th>Prioridad</th><th>Fecha</th><th>Acción</th>
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
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>