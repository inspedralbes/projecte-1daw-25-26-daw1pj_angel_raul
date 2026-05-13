<?php
session_start();
include "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = trim($_POST['codigo'] ?? '');

    $stmt = $conn->prepare("SELECT id_usuario, nombre, rol 
                            FROM USUARIO 
                            WHERE codigo = ? AND rol = 'admin' 
                            LIMIT 1");
    $stmt->execute([$codigo]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        $_SESSION = [
            'id_usuario' => $admin['id_usuario'],
            'nombre'     => $admin['nombre'],
            'rol'        => $admin['rol']
        ];
        header("Location: panel_admin.php");
        exit;
    }

    $error = "Código incorrecto";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
<link rel="stylesheet" href="responsive.css?v=100000">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height:40px;">
    <a href="index.php" class="btn btn-outline-primary">
        <i class="bi bi-house-door-fill fs-4"></i>
    </a>
</header>

<div class="d-flex justify-content-center align-items-center" style="min-height:75vh;">
    <div class="border rounded p-4 shadow-lg bg-white" style="max-width:400px; width:100%;">

        <h5 class="fw-bold text-danger mb-3 text-center">Identificación de administrador</h5>

        <?php if ($error): ?>
            <div class="alert alert-danger text-center">
                <i class="bi bi-x-circle me-1"></i><?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Código de verificación</label>
                <input type="password" name="codigo"
                       class="form-control <?= $error ? 'is-invalid' : '' ?>"
                       placeholder="Introduce tu código" autofocus>
            </div>

            <button class="btn btn-danger w-100">
                <i class="bi bi-shield-lock me-1"></i> Entrar como administrador
            </button>
        </form>

    </div>
</div>
<footer>
    <div class="text-center py-3 text-muted">
    <p>Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>

</body>
</html>
