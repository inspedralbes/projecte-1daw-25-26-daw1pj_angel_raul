<?php
require_once 'config/database.php';

// ── Recoger datos del formulario ──────────────────────────────────────────
$ordenador           = trim($_POST['ordenador']          ?? '');
$asunto              = trim($_POST['asunto']             ?? '');
$descripcion         = trim($_POST['descripcion']        ?? '');
$prioridad           = $_POST['prioridad']               ?? 'Media';
$departamento_id     = !empty($_POST['departamento_id']) ? (int) $_POST['departamento_id'] : null;
$id_usuario_creador  = !empty($_POST['id_usuario_creador']) ? (int) $_POST['id_usuario_creador'] : null;

// Si tienes sesión activa, descomenta la línea siguiente y borra el hidden del formulario:
// $id_usuario_creador = $_SESSION['id_usuario'] ?? null;

// Añadir el ordenador al asunto si se seleccionó
if ($ordenador !== '') {
    $asunto .= ' — Ordenador: ' . $ordenador;
}

// ── Validaciones básicas ──────────────────────────────────────────────────
$errores = [];

if (empty($asunto)) {
    $errores[] = 'El asunto es obligatorio.';
}
if (empty($descripcion)) {
    $errores[] = 'La descripción es obligatoria.';
}
if (!in_array($prioridad, ['Alta', 'Media', 'Baja'], true)) {
    $errores[] = 'La prioridad seleccionada no es válida.';
}
if ($id_usuario_creador === null) {
    $errores[] = 'No se pudo identificar al usuario creador.';
}

if (!empty($errores)) {
    // Vuelve al formulario mostrando los errores
    header('Location: crear_incidencia.php?error=' . urlencode(implode(' | ', $errores)));
    exit;
}

// ── Insertar en la base de datos ──────────────────────────────────────────
$numero = null;

try {
    $db   = getDB();
    $stmt = $db->prepare("
        INSERT INTO INCIDENCIA
            (asunto, descripcion, prioridad, estado, departamento_id, id_usuario_creador)
        VALUES
            (:asunto, :descripcion, :prioridad, 'Abierta', :departamento_id, :id_usuario_creador)
    ");
    $stmt->execute([
        ':asunto'             => $asunto,
        ':descripcion'        => $descripcion,
        ':prioridad'          => $prioridad,
        ':departamento_id'    => $departamento_id,
        ':id_usuario_creador' => $id_usuario_creador,
    ]);

    $numero = (int) $db->lastInsertId();

} catch (Exception $e) {
    // En producción loguea el error en vez de mostrarlo
    header('Location: crear_incidencia.php?error=' . urlencode('Error al guardar la incidencia. Inténtalo de nuevo.'));
    exit;
}

// Etiqueta legible de prioridad para mostrar en pantalla
$badgeColor = match($prioridad) {
    'Alta'  => 'danger',
    'Media' => 'warning',
    'Baja'  => 'success',
    default => 'secondary',
};
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

        <div class="mb-3">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
        </div>

        <p class="fw-semibold mb-1">Tu número de incidencia es:</p>
        <p class="fw-bold text-primary mb-3" style="font-size: 2rem;">
            #<?php echo htmlspecialchars($numero); ?>
        </p>

        <hr>

        <div class="text-start small mb-3">
            <div class="mb-1">
                <span class="fw-semibold">Asunto:</span>
                <?php echo htmlspecialchars($asunto); ?>
            </div>
            <div class="mb-1">
                <span class="fw-semibold">Descripción:</span>
                <?php echo nl2br(htmlspecialchars($descripcion)); ?>
            </div>
            <div class="mb-1">
                <span class="fw-semibold">Prioridad:</span>
                <span class="badge bg-<?php echo $badgeColor; ?>">
                    <?php echo htmlspecialchars($prioridad); ?>
                </span>
            </div>
            <div>
                <span class="fw-semibold">Estado:</span>
                <span class="badge bg-secondary">Abierta</span>
            </div>
        </div>

        <p class="text-muted small">
            Guarda este número para hacer seguimiento de tu incidencia.
        </p>

        <a href="index.php" class="btn btn-primary mt-2">
            <i class="bi bi-house-door-fill me-1"></i> Volver al inicio
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>