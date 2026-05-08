<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalla tu incidencia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="ms-3 fw-bold fs-4 text-dark">Registrar incidencia</span>
    </div>

    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>

<div class="container mt-5">
    <div class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">

        <form action="guardar_incidencia.php" method="POST">

            <label class="form-label">Título</label>
            <input type="text" class="form-control mb-3" name="titulo" placeholder="Títol de la incidència" required>
 
            <label class="form-label">Aula</label>
            <select class="form-select mb-3" name="aula" required>
                <option value="" disabled selected hidden>- Selecciona -</option>
                <option value="INF10">INF10</option>
                <option value="INF11">INF11</option>
                <option value="INF12">INF12</option>
                <option value="Mediateca">Mediateca</option>
            </select>

            <label class="form-label">Descripción</label>
            <textarea class="form-control mb-3" name="descripcion" rows="3" placeholder="Descriu la incidència" required></textarea>

            <button class="btn btn-primary w-100">Enviar incidència</button>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
