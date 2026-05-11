<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO INCIDENCIA (asunto, descripcion, departamento_id, estado) VALUES (?, ?, ?, 'Abierta')");
    $stmt->execute([$_POST['titulo'], $_POST['descripcion'], $_POST['aula']]);
    header("Location: guardar_incidencia.php?numero=" . $conn->lastInsertId());
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
   <header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="text-center fw-bold my-4 text-primary ms-3">Detalla tu incidencia</span>
    </div>

    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill" style="font-size: 1.3rem;"></i>
    </a>
</header>

<div class="container mt-4" style="max-width: 600px;">
  

    <form method="POST">
        <input type="text" name="titulo" class="form-control mb-3" placeholder="Título" required>

        <select name="aula" class="form-select mb-3" required>
            <option value="">Departamento</option>
            <option value="1">Informática</option>
            <option value="2">Secretaría</option>
            <option value="3">Dirección</option>
            <option value="4">Mediateca</option>
            <option value="5">Mantenimiento</option>
        </select>

        <textarea name="descripcion" class="form-control mb-3" placeholder="Descripción" required></textarea>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
</div>
</body>
</html>