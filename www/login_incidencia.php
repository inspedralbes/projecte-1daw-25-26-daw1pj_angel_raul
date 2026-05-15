<?php
require_once "logger.php";
include "conexion.php";

$error       = "";
$incidencia  = null;
$comentarios = [];
$numero_url  = $_GET['codigo'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $numero = trim($_POST['codigo'] ?? '');

    $stmt = $conn->prepare("SELECT * FROM INCIDENCIA WHERE num_incidencia = ?");
    $stmt->execute([$numero]);
    $incidencia = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($incidencia) {
        $stmt2 = $conn->prepare("SELECT descripcion, fecha FROM ACTUACION WHERE id_incidencia = ?");
        $stmt2->execute([$numero]);
        $comentarios = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error = "Incidencia no encontrada";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-key="seguimiento">Seguimiento</title>
    <link rel="stylesheet" href="responsive.css?v=100000">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm" role="banner">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo de l'empresa" style="height:40px;">
        <span class="ms-3 fw-bold fs-4 text-primary" data-key="seguimiento">SEGUIMIENTO</span>
    </div>
    <a href="index.php" class="btn btn-outline-primary" aria-label="Volver al inicio">
        <i class="bi bi-house-door-fill fs-4" aria-hidden="true"></i>
    </a>
</header>

<main class="d-flex justify-content-center align-items-center" style="min-height:75vh;">

    <?php if ($incidencia): ?>

        <div class="card p-4 shadow-sm" style="max-width:500px; width:100%;">
            <h1 class="fs-5 fw-bold">
                <span data-key="incidencia">Incidencia</span> #<?= $incidencia['num_incidencia'] ?>
            </h1>

            <p><b data-key="asunto">Asunto</b>: <?= $incidencia['asunto'] ?></p>
            <p><b data-key="descripcion">Descripción</b>: <?= $incidencia['descripcion'] ?></p>
            <p><b data-key="estado">Estado</b>: <?= $incidencia['estado'] ?></p>

            <?php if ($comentarios): ?>
                <hr>
                <h2 class="fs-6 fw-bold" data-key="comentarios_tecnico">Comentarios del técnico</h2>

                <?php foreach ($comentarios as $c): ?>
                    <div class="border rounded p-2 mb-2">
                        <p class="mb-0"><?= $c['descripcion'] ?></p>
                        <small class="text-muted"><?= $c['fecha'] ?></small>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

            <a href="login_incidencia.php" class="btn btn-primary mt-3 w-100" data-key="buscar_otra">Buscar otra</a>
        </div>

    <?php else: ?>

        <div class="border rounded p-4 shadow-lg bg-white" style="max-width:400px; width:100%;">

            <h1 class="fw-bold text-primary mb-3 text-center fs-5" data-key="pon_numero">Pon tu número de incidencia</h1>

            <?php if ($error): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <span data-key="incidencia_no_encontrada"><?= $error ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" novalidate>
                <div class="mb-3">
                    <label for="codigo" class="form-label" data-key="numero_incidencia">Número de incidencia</label>
                    <input type="text" id="codigo" name="codigo" class="form-control"
                           value="<?= $numero_url ?>" placeholder="Ejemplo: 0000"
                           required aria-required="true">
                </div>

                <button type="submit" class="btn btn-outline-primary w-100" data-key="buscar">Buscar</button>
            </form>

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