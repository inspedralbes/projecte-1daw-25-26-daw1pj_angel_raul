<?php
include "conexion.php";

$sql = "SELECT * FROM INCIDENCIA";
$stmt = $conn->prepare($sql);
$stmt->execute();
$incidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head> 

<body class="bg-light">

<header class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <img src="IMG/LogoEmpresa.jpg" alt="Logo" style="height: 40px;">
        <span class="ms-3 fw-bold fs-4 text-secondary">Listado de incidencias</span>
    </div>

    <a href="index.php" class="btn btn-outline-primary d-flex align-items-center">
        <i class="bi bi-house-door-fill fs-4"></i>
    </a> 
</header>

<div class="text-center mt-4">
    <label for="tecnico" class="form-label fw-bold fs-5">Selecciona tu nombre</label>

    <select id="tecnico" class="form-select w-25 mx-auto p-2">
        <option value="">Seleccionar</option>
        <option value="1">Gerard Torrent</option>
        <option value="2">Toni Marti</option>
        <option value="3">Ermengol Bota</option>
        <option value="4">Alvaro Perez</option>
    </select>
</div>

<div class="container mt-4">
    <div class="w-75 mx-auto">

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-striped table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="p-3">ID</th>
                            <th class="p-3">Asunto</th>
                            <th class="p-3">Departamento</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3">Prioridad</th>
                            <th class="p-3">Fecha</th>
                            <th class="p-3">Acción</th>
                        </tr>
                    </thead>

               <tbody>
<?php foreach ($incidencias as $inc): ?>
    <tr>
        <td><?= $inc['num_incidencia'] ?></td>
        <td><?= $inc['asunto'] ?></td>
        <td><?= $inc['departamento_id'] ?></td>

        <td>
            <?php if ($inc['estado'] === 'Abierta'): ?>
                <span class="badge bg-warning text-dark">Abierta</span>
            <?php elseif ($inc['estado'] === 'En proceso'): ?>
                <span class="badge bg-info text-dark">En proceso</span>
            <?php else: ?>
                <span class="badge bg-success">Cerrada</span>
            <?php endif; ?>
        </td>

        <td>
            <?php if ($inc['id_prioridad'] == 1): ?>
                <span class="badge bg-danger">Alta</span>
            <?php elseif ($inc['id_prioridad'] == 2): ?>
                <span class="badge bg-warning text-dark">Media</span>
            <?php else: ?>
                <span class="badge bg-success">Baja</span>
            <?php endif; ?>
        </td>

        <td><?= $inc['fecha_inicio'] ?></td>

        <td>
            <button class="btn btn-sm btn-primary" onclick="mostrarTarjeta(<?= $inc['num_incidencia'] ?>)">Gestionar</button>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>


                </table>

            </div>
        </div>

    </div>
</div>


<div id="tarjetaGestion" class="card shadow p-3"
     style="display:none; position:fixed; bottom:20px; right:20px; width:300px; z-index:999;">

    <h5 class="fw-bold">Gestionar incidencia</h5>
    <p>ID: <span id="idIncidencia"></span></p>

    
    <label class="fw-bold">Estado</label>
    <select id="estado" class="form-select mb-2">
        <option value="Abierta">Abierta</option>
        <option value="En proceso">En proceso</option>
        <option value="Cerrada">Cerrada</option>
    </select>

    <label class="fw-bold">Prioridad</label>
    <select id="prioridad" class="form-select mb-2">
        <option value="1">Alta</option>
        <option value="2">Media</option>
        <option value="3">Baja</option>
    </select>

    <!-- COMENTARIO -->
    <textarea id="comentario" class="form-control mb-2" placeholder="Escribe un comentario..."></textarea>

    <button class="btn btn-success w-100 mb-2" onclick="guardarGestion()">Guardar cambios</button>
    <button class="btn btn-danger w-100" onclick="cerrarTarjeta()">Cerrar</button>
</div>

<script>
function mostrarTarjeta(id) {
    document.getElementById("tarjetaGestion").style.display = "block";
    document.getElementById("idIncidencia").innerText = id;
}

function cerrarTarjeta() {
    document.getElementById("tarjetaGestion").style.display = "none";
}

function guardarGestion() {
    let id = document.getElementById("idIncidencia").innerText;
    let comentario = document.getElementById("comentario").value;
    let estado = document.getElementById("estado").value;
    let prioridad = document.getElementById("prioridad").value;

    let formData = new FormData();
    formData.append("id", id);
    formData.append("comentario", comentario);
    formData.append("estado", estado);
    formData.append("prioridad", prioridad);

    fetch("guardar_gestion.php", {
        method: "POST",
        body: formData
    })
    .then(r => r.text())
    .then(res => {
        if (res === "OK") {
            alert("Cambios guardados");
            cerrarTarjeta();
            location.reload(); 
        } else {
            alert("Error al guardar");
        }
    });
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
