<?php
$host='localhost';
$user='root';
$password = '';
$dbname = 'ecolac';
try {
    $conexion = new PDO("mysql:host=".$host.";dbname=".$dbname, $user, $password);
    $conexion->exec("SET NAMES utf8");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>