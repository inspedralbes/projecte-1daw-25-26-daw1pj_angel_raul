<?php
require_once "logger.php";
include "conexion.php";

$id = $_GET['id'] ?? $_POST['id'] ?? null;
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $conn->prepare("UPDATE INCIDENCIA 
                    SET estado=?, id_prioridad=? 
                    WHERE num_incidencia=?")
         ->execute([$_POST['estado'], $_POST['prioridad'], $id]);

    if (!empty($_POST['comentario'])) {
        $conn->prepare("INSERT INTO ACTUACION (descripcion, id_incidencia) 
                        VALUES (?, ?)")
             ->execute([$_POST['comentario'], $id]);
    }

    $mensaje = "Guardado!";
}

$stmt = $conn->prepare("SELECT * FROM INCIDENCIA WHERE num_incidencia=?");
$stmt->execute([$id]);
$inc = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT descripcion, fecha FROM ACTUACION WHERE id_incidencia=?");
$stmt2->execute([$id]);
$acts = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-key="gestionar_incidencia">Gestionar Incidencia</title>
    <link rel="stylesheet" href="responsive.css?v=100000">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm" role="banner">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo de l'empresa" style="height:40px;">
        <span class="ms-3 fw-bold fs-4 text-secondary" data-key="gestionar_incidencia">Gestionar incidencia</span>
    </div>
    <a href="listado_incidencia.php" class="btn btn-outline-primary" aria-label="Volver al listado">
        <i class="bi bi-arrow-left fs-4" aria-hidden="true"></i>
    </a>
</header>

<main class="container my-4" style="max-width:600px;">

    <?php if ($mensaje): ?>
        <div class="alert alert-success text-center" role="alert" data-key="guardar"><?= $mensaje ?></div>
    <?php endif; ?>

    <div class="card shadow-sm p-4 mb-4">
        <h1 class="fs-5 fw-bold">Incidencia #<?= $inc['num_incidencia'] ?></h1>
        <p><b data-key="asunto">Asunto</b>: <?= $inc['asunto'] ?></p>
        <p><b data-key="descripcion">Descripción</b>: <?= $inc['descripcion'] ?></p>
        <p><b data-key="fecha">Fecha</b>: <?= $inc['fecha_inicio'] ?></p>
    </div>

    <div class="card shadow-sm p-4 mb-4">
        <h2 class="fs-5 fw-bold mb-3" data-key="actualizar">Actualizar</h2>

        <form method="POST" novalidate>
            <input type="hidden" name="id" value="<?= $inc['num_incidencia'] ?>">

            <div class="mb-3">
                <label for="estado" class="form-label fw-bold" data-key="estado">Estado</label>
                <select id="estado" name="estado" class="form-select">
                    <?php foreach (['Abierta'=>'estado_abierta','En proceso'=>'estado_en_proceso','Cerrada'=>'estado_cerrada'] as $val=>$key): ?>
                        <option value="<?= $val ?>" data-key="<?= $key ?>" <?= $inc['estado']===$val?'selected':'' ?>>
                            <?= $val ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="prioridad" class="form-label fw-bold" data-key="prioridad">Prioridad</label>
                <select id="prioridad" name="prioridad" class="form-select">
                    <?php foreach ([1=>['Alta','prioridad_alta'],2=>['Media','prioridad_media'],3=>['Baja','prioridad_baja']] as $k=>$v): ?>
                        <option value="<?= $k ?>" data-key="<?= $v[1] ?>" <?= $inc['id_prioridad']==$k?'selected':'' ?>>
                            <?= $v[0] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="comentario" class="form-label fw-bold" data-key="comentario">Comentario</label>
                <textarea id="comentario" name="comentario" class="form-control" placeholder="Comentario..." data-key="comentario"></textarea>
            </div>

            <button type="submit" class="btn btn-success w-100" data-key="guardar">Guardar</button>
        </form>
    </div>

    <?php foreach ($acts as $a): ?>
        <div class="card shadow-sm p-3 mb-2">
            <p class="mb-0"><?= $a['descripcion'] ?></p>
            <small class="text-muted"><?= $a['fecha'] ?></small>
        </div>
    <?php endforeach; ?>

</main>

<footer>
    <div class="text-center py-3 text-muted">
        <p data-key="creditos">Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>

<script src="JS/idioma.js"></script>

</body>
</html>