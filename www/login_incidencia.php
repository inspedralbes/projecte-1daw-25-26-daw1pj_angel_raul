<?php
include "conexion.php";

$error      = "";
$incidencia = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = trim($_POST['codigo'] ?? '');

    if ($numero === '') {
        $error = "Introduce un número";
    } elseif (!is_numeric($numero)) {
        $error = "Solo se permiten números";
    } else {
        $stmt = $conn->prepare("SELECT * FROM INCIDENCIA WHERE num_incidencia = ?");
        $stmt->execute([$numero]);
        $incidencia = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$incidencia) {
            $error = "Incidencia no encontrada";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Buscar Incidencia</title>
</head>
<body class="bg-light">

<div class="d-flex justify-content-center align-items-center" style="min-height: 75vh;">

    <?php if ($incidencia): ?>

        <div class="card p-4 shadow-sm" style="max-width: 500px; width: 100%;">
            <h5>Incidencia #<?= $incidencia['num_incidencia'] ?></h5>
            <p><b>Asunto:</b> <?= $incidencia['asunto'] ?></p>
            <p><b>Descripción:</b> <?= $incidencia['descripcion'] ?></p>
            <p><b>Estado:</b> <?= $incidencia['estado'] ?></p>
            <p><b>Prioridad:</b> <?= $incidencia['prioridad'] ?></p>
            <a href="login_incidencia.php" class="btn btn-primary">Buscar otra</a>
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
                  <input type="text" name="codigo" class="form-control" placeholder="Ejemplo: 0000">
                </div>
                <button type="submit" class="btn btn-outline-primary w-100">Buscar</button>
            </form>
        </fieldset>

    <?php endif; ?>

</div>
</body>
</html>