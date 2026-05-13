<?php
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
    <title>Gestionar incidencia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height:40px;">
        <span class="ms-3 fw-bold fs-4 text-secondary">Gestionar incidencia</span>
    </div>
    <a href="listado_incidencia.php" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left fs-4"></i>
    </a>
</header>

<div class="container mt-4" style="max-width:600px;">

    <?php if ($mensaje): ?>
        <div class="alert alert-success text-center"><?= $mensaje ?></div>
    <?php endif; ?>

    <div class="card shadow-sm p-4 mb-4">
        <h5 class="fw-bold">Incidencia #<?= $inc['num_incidencia'] ?></h5>
        <p><b>Asunto:</b> <?= $inc['asunto'] ?></p>
        <p><b>Descripción:</b> <?= $inc['descripcion'] ?></p>
        <p><b>Fecha:</b> <?= $inc['fecha_inicio'] ?></p>
    </div>

    <div class="card shadow-sm p-4 mb-4">
        <h5 class="fw-bold mb-3">Actualizar</h5>

        <form method="POST">
            <input type="hidden" name="id" value="<?= $inc['num_incidencia'] ?>">

            <label class="form-label fw-bold">Estado</label>
            <select name="estado" class="form-select mb-3">
                <?php foreach (['Abierta','En proceso','Cerrada'] as $estado): ?>
                    <option value="<?= $estado ?>" <?= $inc['estado']===$estado?'selected':'' ?>>
                        <?= $estado ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="form-label fw-bold">Prioridad</label>
            <select name="prioridad" class="form-select mb-3">
                <?php foreach ([1=>'Alta',2=>'Media',3=>'Baja'] as $k=>$v): ?>
                    <option value="<?= $k ?>" <?= $inc['id_prioridad']==$k?'selected':'' ?>>
                        <?= $v ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="form-label fw-bold">Comentario</label>
            <textarea name="comentario" class="form-control mb-3" placeholder="Comentario..."></textarea>

            <button class="btn btn-success w-100">Guardar</button>
        </form>
    </div>

    <?php foreach ($acts as $a): ?>
        <div class="card shadow-sm p-3 mb-2">
            <p class="mb-0"><?= $a['descripcion'] ?></p>
            <small class="text-muted"><?= $a['fecha'] ?></small>
        </div>
    <?php endforeach; ?>

</div>
<footer>
    <div class="text-center py-3 text-muted">
    <p>Angel Domínguez, Raul Diaz.</p>
    </div>
</footer>
</body>
</html>
