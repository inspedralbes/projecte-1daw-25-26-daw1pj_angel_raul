<?php
include "conexion.php";
$error       = "";
$incidencia  = null;
$comentarios = [];
$numero_url  = $_GET['codigo'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = trim($_POST['codigo'] ?? '');
    $stmt   = $conn->prepare("SELECT * FROM INCIDENCIA WHERE num_incidencia = ?");
    $stmt->execute([$numero]);
    $incidencia = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$incidencia) {
        $error = "Incidencia no encontrada";
    } else {
        $stmt2 = $conn->prepare("SELECT * FROM ACTUACION WHERE id_incidencia = ?");
        $stmt2->execute([$numero]);
        $comentarios = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seguimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="ms-3 fw-bold fs-4 text-primary">SEGUIMIENTO</span>
    </div>
    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>

<div class="d-flex justify-content-center align-items-center" style="min-height: 75vh;">

    <?php if ($incidencia): ?>
        <div class="card p-4 shadow-sm" style="max-width: 500px; width: 100%;">
            <h5>Incidencia #<?= $incidencia['num_incidencia'] ?></h5>
            <p><b>Asunto:</b> <?= $incidencia['asunto'] ?></p>
            <p><b>Descripción:</b> <?= $incidencia['descripcion'] ?></p>
            <p><b>Estado:</b> <?= $incidencia['estado'] ?></p>

            <?php if ($comentarios): ?>
                <hr>
                <h6 class="fw-bold">Comentarios del técnico:</h6>
                <?php foreach ($comentarios as $com): ?>
                    <div class="border rounded p-2 mb-2">
                        <p class="mb-0"><?= $com['descripcion'] ?></p>
                        <small class="text-muted"><?= $com['fecha'] ?></small>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <a href="login_incidencia.php" class="btn btn-primary mt-2">Buscar otra</a>
        </div>

    <?php else: ?>
        <fieldset class="border rounded p-4 shadow-lg bg-white" style="max-width: 400px; width: 100%;">
            <legend class="fw-bold text-primary">Pon tu número de incidencia</legend>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Número de incidencia</label>
                    <input type="text" name="codigo" class="form-control"
                           value="<?= $numero_url ?>" placeholder="Ejemplo: 0000">
                </div>
                <button type="submit" class="btn btn-outline-primary w-100">Buscar</button>
            </form>
        </fieldset>
    <?php endif; ?>

</div>
</body>
</html>