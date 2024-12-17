<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/logoV.ico">
    <title>Cargando...</title>
    <style>
        /* Estilo de la página de carga */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Estilo para el video de carga */
        #loading-video {
            width: 50%; /* Ajusta el tamaño del video al 50% del ancho */
            height: auto;
            object-fit: cover; /* Mantiene la relación de aspecto */
        }
    </style>
</head>
<body>

    <!-- Contenedor del video de carga -->
    <video id="loading-video" autoplay muted disablePictureInPicture>
        <source src="assets/AnimacionCarga.mp4" type="video/mp4">
        Tu navegador no soporta la etiqueta de video.
    </video>

    <script>
        // Redirigir a la página de destino después de 3 segundos
        setTimeout(function() {
            window.location.href = "dashboard.php"; // Redirige a la página de destino después de 3 segundos
        }, 3000); // 3000 milisegundos = 3 segundos
    </script>

</body>
</html>
