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

    // Verificar si el usuario existe
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

                // Tipo de usuario
                if ($usuario == 'admin') {
                    $_SESSION['tipo_usuario'] = 'admin';
                } elseif ($usuario == 'El triunfo santa teresa') {
                    $_SESSION['tipo_usuario'] = 'el_triunfo';
                } else {
                    $_SESSION['tipo_usuario'] = 'default';
                }

                // Mostrar video de carga antes de redirigir
                echo '
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <link rel="icon" type="image/x-icon" href="assets/logoV.ico">
                    <meta charset="UTF-8">
                    <title>Cargando...</title>
                    <style>
                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }
                        body, html {
                            width: 100%;
                            height: 100%;
                            overflow: hidden; /* Evita el desplazamiento */
                            background-color: white;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }
                        video {
                            width: 50%; /* Ajustar al 50% del tamaño de la pantalla */
                            height: auto; /* Mantiene la relación de aspecto del video */
                            object-fit: cover; /* Ajusta el video a la pantalla */
                        }
                    </style>
                </head>
                <body>
                    <video autoplay muted disablePictureInPicture playsinline>
                        <source src="assets/AnimacionCarga.mp4" type="video/mp4">
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                    <script>
                        // Redirige al Dashboard después de que termine el video
                        const video = document.querySelector("video");
                        video.addEventListener("ended", function() {
                            window.location.href = "dashboard.php";
                        });
                    </script>
                </body>
                </html>';
                exit();
            } else {
                // Contraseña incorrecta
                echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
            }
        } else {
            // Usuario inactivo
            echo "<script>alert('Su usuario está inactivo. Por favor, contacte a soporte.'); window.history.back();</script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>alert('El usuario no existe.'); window.history.back();</script>";
    }
}
?>
