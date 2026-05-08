<?php
include "conexion.php";

$id = $_POST['id'] ?? null;
$comentario = $_POST['comentario'] ?? null;
$estado = $_POST['estado'] ?? null;
$prioridad = $_POST['prioridad'] ?? null;

if (!$id) {
    echo "ERROR";
    exit;
}

/* 1. ACTUALIZAR ESTADO Y PRIORIDAD */
$sql1 = "UPDATE INCIDENCIA SET estado = ?, id_prioridad = ? WHERE num_incidencia = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute([$estado, $prioridad, $id]);

/* 2. GUARDAR COMENTARIO (si hay) */
if ($comentario && trim($comentario) !== "") {
    $sql2 = "INSERT INTO ACTUACION (descripcion, tipo_actuacion, id_incidencia, id_tecnico)
             VALUES (?, 'comentario', ?, NULL)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$comentario, $id]);
}

echo "OK";
