<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="ms-3 fw-bold fs-4 text-secondary">Listado de incidencias</span>
    </div>

    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>


<div class="text-center">
    <label for="tecnico" class="form-label fw-bold fs-5 mt-4">Selecciona tu nombre</label>

    <select id="tecnico" class="form-select w-25 mx-auto p-2">
        <option value="">Seleccionar</option>
        <option value="1">Gerard Torrent</option>
        <option value="2">Toni Marti</option>
        <option value="3">Ermengol Bota</option>
        <option value="4">Alvaro Perez</option>
    </select>
</div>

<div class="container mt-4">
    <div class="w-75 mx-auto">

        <div class="card shadow-sm bg-white">
            <div class="card-body">

                <table class="table table-striped table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="p-3">ID</th>
                            <th class="p-3">Asunto</th>
                            <th class="p-3">Departamento</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3">Prioridad</th>
                            <th class="p-3">Fecha</th>
                            <th class="p-3">Acción</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>PC no enciende</td>
                            <td>Informática</td>
                            <td><span class="badge bg-warning text-dark">Abierta</span></td>
                            <td><span class="badge bg-danger">Alta</span></td>
                            <td>2026-05-08</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Gestionar</button>
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
