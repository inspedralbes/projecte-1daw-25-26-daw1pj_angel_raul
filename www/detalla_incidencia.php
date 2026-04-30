<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear incidencia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
    </div>

    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>

<h1 class="text-center fw-bold my-4">CREAR INCIDENCIA</h1>

<body class="bg-light">

    <div class="container">

    <form action="incidencia_enviada.php" method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">

            <div class="mb-3">
                <label class="form-label fw-semibold">Aula</label>
                <select name="aula" class="form-select">
                    <option value="">Selecciona tu aula</option>
                    <option value="INFO10">INF10 DAW</option>
                    <option value="INFO11">INFO11 DAM</option>
                    <option value="INFO12">INFO12 ASIX</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ordenador</label>
                <select name="ordenador" class="form-select">
                    <option value="">Selecciona tu número de ordenador</option>
                    <option>A1</option><option>A2</option><option>A3</option><option>A4</option><option>A5</option>
                    <option>B1</option><option>B2</option><option>B3</option><option>B4</option><option>B5</option>
                    <option>C1</option><option>C2</option><option>C3</option><option>C4</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-primary">Enviar</button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




