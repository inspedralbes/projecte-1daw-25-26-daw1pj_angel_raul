<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RANGEL SUPPORT – Panel Principal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="bg-primary text-white py-3 shadow-sm">
    <div class="container">
        <h2 class="fw-bold m-0">Panel Principal</h2>
    </div>
</header>

<div class="container text-center mt-5">

    <img src="IMG/LogoEmpresa.jpg" class="img-fluid mb-4" style="max-height:150px;" alt="Logo">

    <h3 class="fw-semibold mb-5">¿Qué hacemos hoy, Instituto?</h3>

    <div class="row g-4 justify-content-center">

        <div class="col-md-4">
            <a href="detalla_incidencia.php" class="btn btn-primary w-100 py-4 d-flex flex-column align-items-center">
                <i class="bi bi-plus-circle-fill fs-1 mb-2"></i>
                <span class="fw-bold">Crear una incidencia</span>
                <span class="text-white-50">Reporta un problema rápidamente</span>
            </a>
        </div>

        <div class="col-md-4">
            <a href="login_incidencia.php" class="btn btn-outline-primary w-100 py-4 d-flex flex-column align-items-center">
                <i class="bi bi-search fs-1 mb-2"></i>
                <span class="fw-bold">Seguimiento</span>
                <span class="text-muted">Consulta el estado de tu incidencia</span>
            </a>
        </div>

        <div class="col-md-4">
            <a href="login_tecnico.php" class="btn btn-secondary w-100 py-4 d-flex flex-column align-items-center">
                <i class="bi bi-tools fs-1 mb-2"></i>
                <span class="fw-bold">Panel técnico</span>
                <span class="text-white-50">Acceso para técnicos</span>
            </a>
        </div>

        <div class="col-md-4">
            <a href="login_admin.php" class="btn btn-danger w-100 py-4 d-flex flex-column align-items-center">
                <i class="bi bi-shield-lock-fill fs-1 mb-2"></i>
                <span class="fw-bold">Administrador</span>
                <span class="text-white-50">Gestión avanzada del sistema</span>
            </a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
