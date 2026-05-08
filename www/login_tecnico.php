<?php
session_start();
include "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = trim($_POST['codigo'] ?? '');

    if ($codigo === '') {
        $error = "Introduce un código";
    } else {
        $stmt = $conn->prepare("SELECT id_usuario, nombre, rol FROM USUARIO WHERE codigo = ? AND rol = 'tecnico' LIMIT 1");
        $stmt->execute([$codigo]);
        $tecnico = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tecnico) {
            $_SESSION['id_usuario'] = $tecnico['id_usuario'];
            $_SESSION['nombre']     = $tecnico['nombre'];
            $_SESSION['rol']        = $tecnico['rol'];
            header("Location: listado_incidencia.php");
            exit();
        } else {
            $error = "Código incorrecto";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="login_tecnico.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Tecnico</title>
</head>
<body>

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
    </div>
    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>

<div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 80vh;">
    <fieldset class="border rounded p-4 shadow-lg bg-white" 
              style="max-width: 400px; width: 100%; background: #f1f1f1;">
        
        <legend class="float-none w-auto px-3 fw-bold text-secondary">
            Identifícate, por favor
        </legend>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <i class="bi bi-x-circle me-1"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="codigo" class="form-label text-secondary">Introduce el código de verificación</label>
                <input type="password" name="codigo" id="codigo"
                       class="form-control <?= !empty($error) ? 'is-invalid' : '' ?>"
                       placeholder="Código">
            </div>

            <button type="submit" class="btn btn-secondary w-100">
                <i class="bi bi-shield-lock me-1"></i>Entrar como técnico
            </button>
        </form>
    </fieldset>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 