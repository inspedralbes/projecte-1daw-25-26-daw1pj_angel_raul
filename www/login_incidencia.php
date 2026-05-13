<?php
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
    <title>Seguimiento</title>
    
    <link rel="stylesheet" href="responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height:40px;">
        <span class="ms-3 fw-bold fs-4 text-primary">SEGUIMIENTO</span>
    </div>
    <a href="index.php" class="btn btn-outline-primary">
        <i class="bi bi-house-door-fill fs-4"></i>
    </a>
</header>

<div class="d-flex justify-content-center align-items-center" style="min-height:75vh;">

    <?php if ($incidencia): ?>

        <div class="card p-4 shadow-sm" style="max-width:500px; width:100%;">
            <h5 class="fw-bold">Incidencia #<?= $incidencia['num_incidencia'] ?></h5>

            <p><b>Asunto:</b> <?= $incidencia['asunto'] ?></p>
            <p><b>Descripción:</b> <?= $incidencia['descripcion'] ?></p>
            <p><b>Estado:</b> <?= $incidencia['estado'] ?></p>

            <?php if ($comentarios): ?>
                <hr>
                <h6 class="fw-bold">Comentarios del técnico</h6>

                <?php foreach ($comentarios as $c): ?>
                    <div class="border rounded p-2 mb-2">
                        <p class="mb-0"><?= $c['descripcion'] ?></p>
                        <small class="text-muted"><?= $c['fecha'] ?></small>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

            <a href="login_incidencia.php" class="btn btn-primary mt-3 w-100">Buscar otra</a>
        </div>

    <?php else: ?>

        <div class="border rounded p-4 shadow-lg bg-white" style="max-width:400px; width:100%;">

            <h5 class="fw-bold text-primary mb-3 text-center">Pon tu número de incidencia</h5>

            <?php if ($error): ?>
                <div class="alert alert-danger text-center"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Número de incidencia</label>
                    <input type="text" name="codigo" class="form-control"
                           value="<?= $numero_url ?>" placeholder="Ejemplo: 0000">
                </div>

                <button class="btn btn-outline-primary w-100">Buscar</button>
            </form>

        </div>

    <?php endif; ?>

</div>
<footer>
    <div class="text-center py-3 text-muted">
    <p>Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>

</body>
</html>
