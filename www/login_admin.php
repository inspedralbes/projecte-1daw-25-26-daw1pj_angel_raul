
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>
<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
    </div>

    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>

</header>


<body class="bg-light">

<div class="d-flex justify-content-center align-items-center" style="min-height: 75vh;">
    <fieldset class="border rounded p-4 shadow-lg bg-white" style="max-width: 400px; width: 100%;">

        <legend class="float-none w-auto px-3 fw-bold text-danger">
            Identificación de administrador
        </legend>

        <form action="validar_admin.php" method="POST">

            <div class="mb-3">
                <label for="codigo" class="form-label">Introduce el código de verificación</label>
                <input type="password" name="codigo" id="codigo" class="form-control" placeholder="Código">
            </div>

            <button type="submit" class="btn btn-danger w-100">Entrar como administrador</button>

        </form>

    </fieldset>
</div>

</body>
</html>
