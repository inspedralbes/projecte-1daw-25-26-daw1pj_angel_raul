<?php
session_start();
include "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once "logger.php";

    $codigo = trim($_POST['codigo'] ?? '');

    if ($codigo === '') {
        $error = "Introduce un código";
    } else {
        $stmt = $conn->prepare("
            SELECT id_usuario, nombre, rol 
            FROM USUARIO 
            WHERE codigo = ? AND rol = 'tecnico'
            LIMIT 1
        ");
        $stmt->execute([$codigo]);
        $tec = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tec) {
            $_SESSION = [
                'id_usuario' => $tec['id_usuario'],
                'nombre'     => $tec['nombre'],
                'rol'        => $tec['rol']
            ];
            header("Location: listado_incidencia.php");
            exit;
        }

        $error = "Código incorrecto";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-key="panel_tecnico">Panel técnico</title>
    <link rel="stylesheet" href="responsive.css?v=100000">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm" role="banner">
    <img src="IMG/LogoEmpresa.jpg" alt="Logo de l'empresa" style="height:40px;">
    <a href="index.php" class="btn btn-outline-primary" aria-label="Volver al inicio">
        <i class="bi bi-house-door-fill fs-4" aria-hidden="true"></i>
    </a>
</header>

<main class="d-flex justify-content-center align-items-center" style="min-height:80vh;">

    <div class="border rounded p-4 shadow-lg bg-white" style="max-width:400px; width:100%;">

        <h1 class="fw-bold text-secondary mb-3 text-center fs-5" data-key="identificacion_tecnico">Identifícate, por favor</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger text-center" role="alert">
                <i class="bi bi-x-circle me-1" aria-hidden="true"></i>
                <span data-key="codigo_incorrecto"><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" novalidate>
            <div class="mb-3">
                <label for="codigo" class="form-label text-secondary" data-key="codigo_verificacion">Código de verificación</label>
                <input type="password" id="codigo" name="codigo"
                       class="form-control <?= $error ? 'is-invalid' : '' ?>"
                       placeholder="Código" data-key="codigo_verificacion"
                       required aria-required="true">
            </div>

            <button type="submit" class="btn btn-secondary w-100">
                <i class="bi bi-shield-lock me-1" aria-hidden="true"></i>
                <span data-key="entrar_tecnico">Entrar como técnico</span>
            </button>
        </form>

    </div>

</main>

<footer>
    <div class="text-center py-3 text-muted">
        <p data-key="creditos">Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>

<script src="JS/idioma.js"></script>

</body>
</html>