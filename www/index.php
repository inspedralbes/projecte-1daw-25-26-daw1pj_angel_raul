<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-key="titulo_panel">Panel Principal</title>
    <script src="saludo.js"></script>
    <link rel="stylesheet" href="responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
<header class="bg-primary text-white py-3 shadow-sm" role="banner">

    <div class="container d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-house-door-fill fs-2" aria-hidden="true"></i>
            <div>
                <h1 class="fw-bold m-0 fs-4" data-key="titulo_panel">Panel Principal</h1>
                <p id="saludo" class="m-0"></p>
            </div>
        </div>

        <nav aria-label="Opciones de idioma y estadísticas">
            <div class="d-flex align-items-center gap-2">
                <a href="panel_estadisticas.php" class="btn btn-light btn-sm">
                    <i class="bi bi-graph-up" aria-hidden="true"></i>
                    Stats
                </a>
                <button id="btn-es" class="btn btn-light btn-sm" aria-label="Cambiar idioma a español">ES</button>
                <button id="btn-cat" class="btn btn-light btn-sm" aria-label="Canviar idioma a català">CAT</button>
            </div>
        </nav>

    </div>
</header>

<main class="container text-center mt-5">

    <img src="IMG/LogoEmpresa.jpg" class="img-fluid mb-4" style="max-height:150px;" alt="Logo de l'empresa">

    <h2 class="fw-semibold mb-5" data-key="que_hacemos">¿Qué hacemos hoy, Instituto?</h2>

    <div class="row g-4 justify-content-center">

        <div class="col-md-4">
            <a href="detalla_incidencia.php" class="btn btn-primary w-100 py-4 d-flex flex-column align-items-center gap-1">
                <i class="bi bi-plus-circle-fill fs-1" aria-hidden="true"></i>
                <span class="fw-bold" data-key="crear_incidencia">Crear una incidencia</span>
                <small class="text-white-50" data-key="crear_incidencia_desc">Reporta un problema rápidamente</small>
            </a>
        </div>

        <div class="col-md-4">
            <a href="login_incidencia.php" class="btn btn-outline-primary w-100 py-4 d-flex flex-column align-items-center gap-1">
                <i class="bi bi-search fs-1" aria-hidden="true"></i>
                <span class="fw-bold" data-key="seguimiento">Seguimiento</span>
                <small class="text-muted" data-key="seguimiento_desc">Consulta el estado de tu incidencia</small>
            </a>
        </div>

        <div class="col-md-4">
            <a href="login_tecnico.php" class="btn btn-secondary w-100 py-4 d-flex flex-column align-items-center gap-1">
                <i class="bi bi-tools fs-1" aria-hidden="true"></i>
                <span class="fw-bold" data-key="panel_tecnico">Panel técnico</span>
                <small class="text-white-50" data-key="panel_tecnico_desc">Acceso para técnicos</small>
            </a>
        </div>

        <div class="col-md-4">
            <a href="login_admin.php" class="btn btn-danger w-100 py-4 d-flex flex-column align-items-center gap-1">
                <i class="bi bi-shield-lock-fill fs-1" aria-hidden="true"></i>
                <span class="fw-bold" data-key="admin">Administrador</span>
                <small class="text-white-50" data-key="admin_desc">Gestión avanzada del sistema</small>
            </a>
        </div>

    </div>
</main>

<footer>
    <div class="text-center py-3 text-muted position-relative">
        <p data-key="creditos">Angel Domínguez, Raul Diaz.</p>
        <a href="informe.html" class="position-absolute end-0 bottom-0 me-3 mb-2 text-muted small" aria-label="Ver informe de accesibilidad">
            <i class="bi bi-file-text" aria-hidden="true"></i> Informe
        </a>
    </div>
</footer>

<script src="JS/idioma.js"></script>

</body>
</html>