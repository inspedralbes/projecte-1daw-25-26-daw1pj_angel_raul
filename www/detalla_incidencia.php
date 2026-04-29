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
        <form class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">

            <div class="mb-3">
                <label class="form-label fw-semibold">Aula</label>
                <select name="tipo" class="form-select">
                    <option value="">Selecciona tu aula</option>
                    <option value="INFO10">INF10 DAW</option>
                    <option value="INFO11">INFO11 DAM</option>
                    <option value="INFO12">INFO12 ASIX</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Prioridad</label>
                <select name="prioridad" class="form-select">
                    <option value="">Selecciona tu numero de ordenador</option>
                    <option value="baja">A1</option>
                    <option value="media">A2</option>
                    <option value="alta">A3</option>
                    <option value="critica">A4</option>
                    <option value="baja">A5</option>
                    <option value="media">B1</option>
                    <option value="alta">B2</option>
                    <option value="critica">B3</option>
                    <option value="baja">B4</option>
                    <option value="media">B5</option>
                    <option value="alta">C1</option>
                    <option value="critica">C2</option>
                    <option value="alta">C3</option>
                    <option value="critica">C4</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Descripción</label>
                <textarea name="descripcion2" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="index.php" class="btn btn-outline-secondary">Regresar</a>
                <button class="btn btn-primary">Enviar</button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



