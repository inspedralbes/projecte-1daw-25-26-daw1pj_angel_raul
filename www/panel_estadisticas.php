<?php
require_once "logger.php";
require_once __DIR__ . "/vendor/autoload.php";

$uri        = 'mongodb+srv://a25josdomesp_db_user:UacWEKAbGdNPNwAk@cluster0.x1vhtyf.mongodb.net/';
$client     = new MongoDB\Client($uri);
$collection = $client->logs->accessos;

$filtro = ['url' => ['$not' => new MongoDB\BSON\Regex('panel_admin', 'i')]];
if (!empty($_GET['fecha_inicio']))
    $filtro['timestamp']['$gte'] = new MongoDB\BSON\UTCDateTime(strtotime($_GET['fecha_inicio']) * 1000);
if (!empty($_GET['fecha_fin']))
    $filtro['timestamp']['$lte'] = new MongoDB\BSON\UTCDateTime((strtotime($_GET['fecha_fin']) + 86399) * 1000);
if (!empty($_GET['usuario']))
    $filtro['user'] = $_GET['usuario'];
if (!empty($_GET['pagina']))
    $filtro['url'] = new MongoDB\BSON\Regex(preg_quote($_GET['pagina']), 'i');

$match = [['$match' => $filtro]];

$total    = $collection->countDocuments($filtro);
$topPages = $collection->aggregate(array_merge($match, [['$group' => ['_id' => '$url', 'total' => ['$sum' => 1]]], ['$sort' => ['total' => -1]], ['$limit' => 5]]));
$topUsers = $collection->aggregate(array_merge($match, [['$group' => ['_id' => '$user', 'total' => ['$sum' => 1]]], ['$sort' => ['total' => -1]], ['$limit' => 5]]));
$byDay    = $collection->aggregate(array_merge($match, [['$group' => ['_id' => ['$dateToString' => ['format' => '%Y-%m-%d', 'date' => '$timestamp']], 'total' => ['$sum' => 1]]], ['$sort' => ['_id' => 1]]]));
$usuarios = $collection->aggregate([['$group' => ['_id' => '$user']], ['$sort' => ['_id' => 1]]]);

$dias = $counts = [];
foreach ($byDay as $d) { $dias[] = $d['_id']; $counts[] = $d['total']; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title data-key="estadisticas">Estadísticas de accesos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<header class="bg-primary text-white py-3 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <h5 class="m-0">📊 <span data-key="estadisticas">Estadísticas de accesos</span></h5>
        <div class="d-flex gap-2">
            <button id="btn-es" class="btn btn-light btn-sm">ES</button>
            <button id="btn-cat" class="btn btn-light btn-sm">CAT</button>
            <a href="index.php" class="btn btn-light btn-sm" data-key="volver_inicio">Volver al inicio</a>
        </div>
    </div>
</header>

<div class="container py-4">

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label" data-key="fecha_inicio">Fecha inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="<?= $_GET['fecha_inicio'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label" data-key="fecha_fin">Fecha fin</label>
                    <input type="date" name="fecha_fin" class="form-control" value="<?= $_GET['fecha_fin'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label" data-key="usuario">Usuario</label>
                    <select name="usuario" class="form-select">
                        <option value="" data-key="todos">Todos</option>
                        <?php foreach ($usuarios as $u): ?>
                            <option value="<?= htmlspecialchars($u['_id'] ?? '') ?>"
                                <?= ($_GET['usuario'] ?? '') === ($u['_id'] ?? '') ? 'selected' : '' ?>>
                                <?= htmlspecialchars($u['_id'] ?? 'Usuario normal') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" data-key="pagina">Página</label>
                    <input type="text" name="pagina" class="form-control" value="<?= $_GET['pagina'] ?? '' ?>">
                </div>
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary" data-key="filtrar">Filtrar</button>
                    <a href="panel_estadisticas.php" class="btn btn-outline-secondary" data-key="limpiar">Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="alert alert-primary text-center fs-5">
        <span data-key="total_accesos">Total de accesos</span>: <strong><?= $total ?></strong>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white" data-key="paginas_visitadas">Páginas más visitadas</div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($topPages as $p): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= htmlspecialchars($p['_id'] ?? '—') ?></span>
                        <strong><?= $p['total'] ?></strong>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white" data-key="usuarios_activos">Usuarios más activos</div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($topUsers as $u): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= htmlspecialchars($u['_id'] ?? 'Usuario normal') ?></span>
                        <strong><?= $u['total'] ?></strong>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white" data-key="accesos_dia">Accesos por día</div>
                <ul class="list-group list-group-flush" style="max-height:300px;overflow-y:auto">
                    <?php foreach (array_combine($dias ?: [''], $counts ?: [0]) as $dia => $n): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= $dia ?></span><strong><?= $n ?></strong>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-key="tendencia">Tendencia de accesos por día</div>
        <div class="card-body">
            <canvas id="grafico" height="100"></canvas>
        </div>
    </div>

</div>

<script>
new Chart(document.getElementById('grafico'), {
    type: 'line',
    data: {
        labels: <?= json_encode($dias) ?>,
        datasets: [{ label: 'Accesos', data: <?= json_encode($counts) ?>, borderColor: '#0d6efd', backgroundColor: 'rgba(13,110,253,0.1)', tension: 0.3, fill: true }]
    },
    options: { scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
});

const t = {
    es: {
        estadisticas: "Estadísticas de accesos",
        total_accesos: "Total de accesos",
        paginas_visitadas: "Páginas más visitadas",
        usuarios_activos: "Usuarios más activos",
        accesos_dia: "Accesos por día",
        tendencia: "Tendencia de accesos por día",
        fecha_inicio: "Fecha inicio",
        fecha_fin: "Fecha fin",
        usuario: "Usuario",
        todos: "Todos",
        pagina: "Página",
        filtrar: "Filtrar",
        limpiar: "Limpiar",
        volver_inicio: "Volver al inicio"
    },
    cat: {
        estadisticas: "Estadístiques d'accessos",
        total_accesos: "Total d'accessos",
        paginas_visitadas: "Pàgines més visitades",
        usuarios_activos: "Usuaris més actius",
        accesos_dia: "Accessos per dia",
        tendencia: "Tendència d'accessos per dia",
        fecha_inicio: "Data inici",
        fecha_fin: "Data fi",
        usuario: "Usuari",
        todos: "Tots",
        pagina: "Pàgina",
        filtrar: "Filtrar",
        limpiar: "Netejar",
        volver_inicio: "Tornar a l'inici"
    }
};

function traducir(idioma) {
    localStorage.setItem("idioma", idioma);
    document.querySelectorAll("[data-key]").forEach(el => {
        const texto = t[idioma][el.getAttribute("data-key")];
        if (texto) el.textContent = texto;
    });
}

document.getElementById("btn-es").addEventListener("click", () => traducir("es"));
document.getElementById("btn-cat").addEventListener("click", () => traducir("cat"));

traducir(localStorage.getItem("idioma") || "es");
</script>

</body>
</html>