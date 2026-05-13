<?php
session_start();
include "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

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
    <title>Panel Técnico</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height:40px;">
    <a href="index.php" class="btn btn-outline-primary">
        <i class="bi bi-house-door-fill fs-4"></i>
    </a>
</header>

<div class="d-flex justify-content-center align-items-center" style="min-height:80vh;">

    <div class="border rounded p-4 shadow-lg bg-white" style="max-width:400px; width:100%;">

        <h5 class="fw-bold text-secondary mb-3 text-center">Identifícate, por favor</h5>

        <?php if ($error): ?>
            <div class="alert alert-danger text-center">
                <i class="bi bi-x-circle me-1"></i><?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label class="form-label text-secondary">Código de verificación</label>
            <input type="password" name="codigo"
                   class="form-control mb-3 <?= $error ? 'is-invalid' : '' ?>"
                   placeholder="Código">

            <button class="btn btn-secondary w-100">
                <i class="bi bi-shield-lock me-1"></i> Entrar como técnico
            </button>
        </form>

    </div>

</div>
<footer>
 <footer>
    <div class="text-center py-3 text-muted">
    <p>Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>

</footer>
</body>
</html>
