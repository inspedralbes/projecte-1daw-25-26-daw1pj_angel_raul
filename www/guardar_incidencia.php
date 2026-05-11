<?php
include "conexion.php";

$titulo = $_POST["titulo"];
$aula = $_POST["aula"];
$descripcion = $_POST["descripcion"];

$sql = $conn->prepare("
    INSERT INTO INCIDENCIA (asunto, descripcion)
    VALUES (?, ?)
");
$sql->execute([$titulo, $descripcion]);

$numero = $conn->lastInsertId();
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Incidencia creada</title></head>
<body>

<h2>Tu número de incidencia es:</h2>
<h1><?php echo $numero; ?></h1>

</body>
</html>
