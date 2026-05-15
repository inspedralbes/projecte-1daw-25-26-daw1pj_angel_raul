<?php
require_once "logger.php";
include "conexion.php";

$tecnicos = $conn->query("SELECT id_usuario, nombre FROM USUARIO WHERE rol='tecnico'")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tecnico = empty($_POST['tecnico']) ? null : $_POST['tecnico'];

    $conn->prepare("UPDATE INCIDENCIA SET id_tecnico = ? WHERE num_incidencia = ?")
         ->execute([$tecnico, $_POST['id']]);
}

$incidencias = $conn->query("SELECT * FROM INCIDENCIA")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="responsive.css?v=100000">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="ms-3 fw-bold fs-4 text-danger">Panel Administrador</span>
    </div>
    <a href="index.php" class="btn btn-outline-primary">
        <i class="bi bi-house-door-fill fs-4"></i>
    </a>
</header>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover text-center align-middle">
                <thead class="table-danger">
                    <tr>
                        <th>ID</th>
                        <th data-key="asunto">Asunto</th>
                        <th data-key="estado">Estado</th>
                        <th data-key="prioridad">Prioridad</th>
                        <th data-key="accion">Acción</th>
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
                        <td>
                            <form method="POST" class="d-flex gap-2 justify-content-center">
                                <input type="hidden" name="id" value="<?= $inc['num_incidencia'] ?>">
                                <select name="tecnico" class="form-select form-select-sm" style="max-width:150px">
                                    <option value="">Sin asignar</option>
                                    <?php foreach ($tecnicos as $tec): ?>
                                        <option value="<?= $tec['id_usuario'] ?>" <?= $inc['id_tecnico'] == $tec['id_usuario'] ? 'selected' : '' ?>>
                                            <?= $tec['nombre'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-sm btn-danger">Asignar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="JS/idioma.js"></script>

</body>
<footer>
    <div class="text-center py-3 text-muted">
        <p>Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>

</html>