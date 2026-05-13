<?php
$numero = $_GET['numero'] ?? '?';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencia Creada</title>
<link rel="stylesheet" href="responsive.css?v=100000">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<div class="container my-5">
<body class="bg-light">

<div class="container my-5" style="max-width: 400px;">
    <div class="card p-4 text-center shadow-sm">
        <p class="text-muted">Tu número de incidencia es</p>
        <h1 class="text-primary fw-bold" style="font-size: 5rem;"><?= $numero ?></h1>
        <p class="text-muted">Apunta este número para hacer seguimiento</p>
        <a href="index.php" class="btn btn-outline-primary mt-2">Volver al inicio</a>
    </div>
</div>
</div>

</body>   
</html>
