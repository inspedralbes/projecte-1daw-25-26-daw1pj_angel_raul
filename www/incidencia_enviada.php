<?php
require_once 'config/database.php'; // PDO ya configurado

// Aquí deberías recibir los datos del formulario, no solo insertar vacío.
// Ejemplo mínimo con los campos obligatorios:
$asunto             = $_POST['asunto']            ?? 'Sin asunto';
$descripcion        = $_POST['descripcion']       ?? '';
$prioridad          = $_POST['prioridad']         ?? 'Media';
$id_usuario_creador = $_POST['id_usuario_creador'] ?? null;

try {
    $db   = getDB();
    $stmt = $db->prepare("
        INSERT INTO INCIDENCIA (asunto, descripcion, prioridad, id_usuario_creador)
        VALUES (:asunto, :descripcion, :prioridad, :id_usuario_creador)
    ");
    $stmt->execute([
        ':asunto'             => $asunto,
        ':descripcion'        => $descripcion,
        ':prioridad'          => $prioridad,
        ':id_usuario_creador' => $id_usuario_creador,
    ]);
    $numero = $db->lastInsertId(); // MySQL genera el número solo
} catch (Exception $e) {
    die('Error al guardar la incidencia.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Incidencia enviada</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
    </div>
    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>

<h1 class="text-center fw-bold my-4">INCIDENCIA ENVIADA</h1>

<div class="container">
    <div class="card p-4 shadow-sm mx-auto text-center" style="max-width: 600px;">
        <p class="fw-semibold mb-3">Tu número de incidencia es:</p>
        <p class="fw-bold text-primary" style="font-size: 1.8rem;">
            <?php echo htmlspecialchars($numero); ?>
        </p>
        <a href="index.php" class="btn btn-primary">Volver al inicio</a>
    </div>
</div>

</body>
</html>