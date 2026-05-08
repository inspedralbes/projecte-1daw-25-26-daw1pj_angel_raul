<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Incidencia</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="text-center fw-bold my-4 text-danger ms-3">Listado de incidencias</span>
    </div>

    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>


<div class="container mt-4">
    <div class="card p-4 shadow-sm mx-auto bg-white" style="max-width: 900px;">

        <table class="table table-hover text-center align-middle">
<h1 class="text-center fw-bold my-4 text-danger"> Panel Administradores </h1>
            <thead>
                <tr>
                    <th class="py-1 align-middle bg-danger-subtle text-dark fw-bold">Título</th>
                    <th class="py-1 align-middle bg-danger-subtle text-dark fw-bold">Aula</th>
                    <th class="py-1 align-middle bg-danger-subtle text-dark fw-bold">Descripción</th>
                    <th class="py-1 align-middle bg-danger-subtle text-dark fw-bold">Estado</th>
                    <th class="py-1 align-middle bg-danger-subtle text-dark fw-bold">Administrador asignado</th>
                </tr>
            </thead>

            <tbody class="table-light">
                <tr>
                    <td>Ordenador no enciende</td>
                    <td>INF11</td>
                    <td>El ordenador no arranca desde esta mañana.</td>
                    <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                    <td>No asignado</td>
                </tr>
            </tbody>

        </table>

    </div>
</div>

</body>
</html>
