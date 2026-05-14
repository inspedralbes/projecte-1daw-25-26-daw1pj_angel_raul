<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $departamento = $_POST['aula'] ?: null;
    $descripcion = $_POST['descripcion'] ?? '';

    $stmt = $conn->prepare("
        INSERT INTO INCIDENCIA (asunto, descripcion, departamento_id, estado)
        VALUES (?, ?, ?, 'Abierta')
    ");

    if (strlen($descripcion) >= 15) {

        $stmt->execute([
            $_POST['titulo'],
            $descripcion,
            $departamento
        ]);

        header("Location: guardar_incidencia.php?numero=" . $conn->lastInsertId());
        exit;

    } else {
        echo "<script>alert('La descripción debe tener al menos 15 caracteres.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-key="detalla_incidencia">Detalla tu incidencia</title>
    <link rel="stylesheet" href="responsive.css?v=100000">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height:40px;">
        <span class="fw-bold text-primary ms-3" data-key="detalla_incidencia">Detalla tu incidencia</span>
    </div>

    <a href="index.php" class="btn btn-outline-primary">
        <i class="bi bi-house-door-fill fs-4"></i>
    </a>
</header>

<div class="d-flex justify-content-center align-items-center my-5">
    <div class="card p-4 text-center shadow-sm" style="width:100%; max-width:400px;">

        <form method="POST">

            <input type="text" name="titulo" class="form-control mb-3"
                   placeholder="Título" data-key="ph_titulo" required>

            <select name="aula" class="form-select mb-3" required>
                <option value="" disabled selected data-key="sel_departamento">Selecciona un departamento</option>
                <?php foreach ([1=>"Informática",2=>"Secretaría",3=>"Dirección",4=>"Mediateca",5=>"Mantenimiento"] as $id=>$dep): ?>
                    <option value="<?= $id ?>"><?= $dep ?></option>
                <?php endforeach; ?>
            </select>

            <textarea name="descripcion" class="form-control mb-3"
                      placeholder="Descripción" data-key="ph_descripcion" required></textarea>

            <button class="btn btn-primary w-100" data-key="btn_enviar">Enviar</button>

        </form>

    </div>
</div>

<footer>
    <div class="text-center py-3 text-muted">
        <p data-key="creditos">Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>

<!-- RUTA CORRECTA -->
<script src="JS/idioma.js"></script>

</body>
</html>
