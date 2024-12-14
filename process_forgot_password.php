<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Verificar si el correo existe en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Simular envío de correo (puedes integrar un servicio como PHPMailer)
        echo "<script>alert('Correo enviado a $email con instrucciones para recuperar tu contraseña.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('El correo ingresado no está registrado.'); window.history.back();</script>";
    }
}
?>
