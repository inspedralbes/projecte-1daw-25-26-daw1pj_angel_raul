<?php
include "conexion.php";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO INCIDENCIA (asunto, descripcion, departamento_id, id_prioridad, estado) VALUES (?, ?, ?, ?, 'Abierta')");
    $stmt->execute([$_POST['titulo'], $_POST['descripcion'], $_POST['aula'], $_POST['prioridad']]);
    $numero = $conn->lastInsertId();
    header("Location: guardar_incidencia.php?numero=" . $numero);
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4" style="max-width: 600px;">
    <h2 class="text-center text-primary fw-bold mb-4">Crear incidencia</h2>

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

        <select name="prioridad" class="form-select mb-3" required>
            <option value="">Prioridad</option>
            <option value="1">Alta</option>
            <option value="2">Media</option>
            <option value="3">Baja</option>
        </select>

        <textarea name="descripcion" class="form-control mb-3" placeholder="Descripción" required></textarea>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
</div>
</body>
</html>