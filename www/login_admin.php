<?php
session_start();
include "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = trim($_POST['codigo'] ?? '');

    if ($codigo === '') {
        $error = "Introduce un código";
    } else {
        $stmt = $conn->prepare("SELECT id_usuario, nombre, rol FROM USUARIO WHERE codigo = ? AND rol = 'admin' LIMIT 1");
        $stmt->execute([$codigo]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            $_SESSION['id_usuario'] = $admin['id_usuario'];
            $_SESSION['nombre']     = $admin['nombre'];
            $_SESSION['rol']        = $admin['rol'];
            header("Location: panel_admin.php");
            exit();
        } else {
            $error = "Código incorrecto";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

<div class="d-flex justify-content-center align-items-center" style="min-height: 75vh;">
    <fieldset class="border rounded p-4 shadow-lg bg-white" style="max-width: 400px; width: 100%;">
        <legend class="float-none w-auto px-3 fw-bold text-danger">
            Identificación de administrador
        </legend>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <i class="bi bi-x-circle me-1"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código de verificación</label>
                <input type="password" name="codigo" id="codigo"
                       class="form-control <?= !empty($error) ? 'is-invalid' : '' ?>"
                       placeholder="Introduce tu código" autofocus>
            </div>
            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-shield-lock me-1"></i> Entrar como administrador
            </button>
        </form>
    </fieldset>
</div>

</body>
</html> 