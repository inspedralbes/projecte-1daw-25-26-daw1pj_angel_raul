<?php
include "conexion.php";
require_once "logger.php";

$id_tecnico = $_GET['tecnico'] ?? '';

$tecnicos = $conn->query("SELECT id_usuario, nombre FROM USUARIO WHERE rol='tecnico'")
                 ->fetchAll(PDO::FETCH_ASSOC);

$incidencias = [];

if ($id_tecnico) {
    $stmt = $conn->prepare("SELECT * FROM INCIDENCIA WHERE id_tecnico=?");
    $stmt->execute([$id_tecnico]);
    $incidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function badge($value, $map) {
    return $map[$value] ?? '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-key="panel_tecnico">Panel Técnico</title>
    <link rel="stylesheet" href="responsive.css?v=100000">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm" role="banner">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo de l'empresa" style="height:40px;">
        <span class="ms-3 fw-bold fs-4 text-primary" data-key="panel_tecnico">Panel Técnico</span>
    </div>
    <a href="index.php" class="btn btn-outline-primary" aria-label="Volver al inicio">
        <i class="bi bi-house-door-fill fs-4" aria-hidden="true"></i>
    </a>
</header>

<main class="container mt-4">

    <div class="card shadow-sm p-4 mx-auto mb-4 text-center" style="max-width:400px;">
        <h1 class="fw-bold mb-3 fs-5" data-key="quien_eres">¿Quién eres?</h1>

        <form method="GET">
            <label for="tecnico-select" class="visually-hidden">Selecciona tu nombre</label>
            <select id="tecnico-select" name="tecnico" class="form-select" onchange="this.form.submit()">
                <option value="" data-key="selecciona_nombre">Selecciona tu nombre</option>
                <?php foreach ($tecnicos as $t): ?>
                    <option value="<?= $t['id_usuario'] ?>" <?= $id_tecnico == $t['id_usuario'] ? 'selected' : '' ?>>
                        <?= $t['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <?php if ($id_tecnico): ?>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-striped table-hover text-center align-middle" aria-label="Incidencias asignadas">
                <caption class="visually-hidden">Listado de incidencias asignadas al técnico seleccionado</caption>
                <thead class="table-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" data-key="asunto">Asunto</th>
                        <th scope="col" data-key="estado">Estado</th>
                        <th scope="col" data-key="prioridad">Prioridad</th>
                        <th scope="col" data-key="fecha">Fecha</th>
                        <th scope="col" data-key="accion">Acción</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($incidencias as $i): ?>

                    <tr>
                        <td><?= $i['num_incidencia'] ?></td>
                        <td><?= $i['asunto'] ?></td>

                        <td>
                            <?= badge($i['estado'], [
                                'Abierta'    => '<span class="badge bg-warning text-dark">Abierta</span>',
                                'En proceso' => '<span class="badge bg-info text-dark">En proceso</span>',
                                'Cerrada'    => '<span class="badge bg-success">Cerrada</span>'
                            ]) ?>
                        </td>

                        <td>
                            <?= badge($i['id_prioridad'], [
                                1 => '<span class="badge bg-danger">Alta</span>',
                                2 => '<span class="badge bg-warning text-dark">Media</span>',
                                3 => '<span class="badge bg-success">Baja</span>'
                            ]) ?>
                        </td>

                        <td><?= $i['fecha_inicio'] ?></td>

                        <td>
                            <a href="gestionar_incidencia.php?id=<?= $i['num_incidencia'] ?>"
                               class="btn btn-sm btn-primary" data-key="gestionar_incidencia"
                               aria-label="Gestionar incidencia <?= $i['num_incidencia'] ?>">
                               Gestionar
                            </a>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

    <?php endif; ?>

</main>

<footer>
    <div class="text-center py-3 text-muted">
        <p data-key="creditos">Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>

<script src="JS/idioma.js"></script>

</body>
</html>