<?php
$host = "db"; 
$dbname = "incidencias";
$user = "usuari"; 
$pass = "usuari1234"; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de connexió: " . $e->getMessage();
}
?>
