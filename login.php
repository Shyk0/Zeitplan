<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    // Verificar si algún campo está vacío
    if (empty($usuario) || empty($password)) {
        echo "<script>alert('Por favor, complete todos los campos.'); window.history.back();</script>";
        exit();
    }

    // Verificar si el usuario existe (sin filtrar por estado)
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $stmt->execute(['usuario' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verificar si el usuario está activo
        if ($user['estado'] == 1) {
            // Validar la contraseña
            if ($user['password'] === $password) {
                // Credenciales válidas
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['nombre'] = $user['nombre'];
                echo "<script>alert('Bienvenido {$user['nombre']}'); window.location.href = 'dashboard.php';</script>";
            } else {
                // Contraseña incorrecta
                echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
            }
        } else {
            // Usuario inactivo
            echo "<script>alert('Su usuario está inactivo. Por favor, contacte a soporte para restablecer su acceso.'); window.history.back();</script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>alert('El usuario no existe. Verifique y vuelva a intentarlo.'); window.history.back();</script>";
    }
}
?>
