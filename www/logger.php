<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    require_once __DIR__ . "/vendor/autoload.php";

    $url = strtok($_SERVER['REQUEST_URI'], '?');

    $excluir = ['panel_estadisticas.php', 'panel_admin.php'];
    foreach ($excluir as $ex) {
        if (str_contains($url, $ex)) return;
    }

    $client     = new MongoDB\Client("mongodb://root:example@mongo:27017");
    $collection = $client->logs->accessos;

    $log = [
        "url"        => $url,
        "method"     => $_SERVER['REQUEST_METHOD'],
        "user"       => $_SESSION['nombre'] ?? null,
        "timestamp"  => new MongoDB\BSON\UTCDateTime(),
        "ip"         => $_SERVER['REMOTE_ADDR']     ?? null,
        "user_agent" => $_SERVER['HTTP_USER_AGENT'] ?? null
    ];

    $collection->insertOne($log);

} catch (Exception $e) {
    error_log("Logger MongoDB error: " . $e->getMessage());
}