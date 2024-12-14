<?php
$host = 'localhost';
$dbname = 'sistema_login';
$username = 'root'; // Cambiar si usas otro usuario
$password = ''; // Cambiar si tienes una contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
