<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="UTF-8">
    <title>Crear incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body> 

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="ms-3 fw-bold fs-4 text-primary">SEGUIMIENTO</span>
    </div>

    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>

<div class="container mt-4">

    <h2 class="text-primary fw-bold mb-4 text-center">Detalla tu incidencia</h2>

    <form action="guardar_incidencia.php" method="POST">

        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control mb-3" required>

        <label class="form-label">Aula</label>
        <select name="aula" class="form-select mb-3" required>
            <option value="">Selecciona</option>
            <option value="INF10">INF10</option>
            <option value="INF11">INF11</option>
            <option value="INF12">INF12</option>
            <option value="Mediateca">Mediateca</option>
        </select>

        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control mb-3" required></textarea>

        <button type="submit" class="btn btn-primary w-100">Enviar incidencia</button>

    </form>

</div>

</body>
</html>
