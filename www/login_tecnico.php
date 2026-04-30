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
    
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <fieldset class="border rounded p-4 shadow-lg" style="max-width: 400px; width: 100%; background: white;">
        
        <legend class="float-none w-auto px-3 fw-bold text-primary">
            Identifícate, por favor
        </legend>

        <form action="identificacion" method="POST">

            <div class="mb-3">
                <label for="codigo" class="form-label">Introduce el código de verificación</label>
                <input type="password" name="codigo" id="codigo" class="form-control" placeholder="Código">
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>

        </form>

    </fieldset>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>