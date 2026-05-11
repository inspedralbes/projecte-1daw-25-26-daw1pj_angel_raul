<?php
$numero = $_GET['numero'] ?? '?';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Incidencia creada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 400px;">
    <div class="card p-4 text-center shadow-sm">
        <p class="text-muted">Tu número de incidencia es</p>
        <h1 class="text-primary fw-bold" style="font-size: 5rem;"><?= $numero ?></h1>
        <p class="text-muted">Apunta este número para hacer seguimiento</p>
        <a href="index.php" class="btn btn-outline-primary mt-2">Volver al inicio</a>
    </div>
</div>
</body>   
</html>