<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir al login si no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/logo.ico">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .navbar {
            top: auto;
            z-index: 1;
            background-color: #6a11cb;
            height: 3.12em;
            color: white;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            border: 10px black;
        }

        .logo-container {
            background-color: white;
            margin-top: 0.5rem;
            height: 100px;
            width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-left: 15px;
            border-radius: 10px;
            z-index: -1;
        }

        .logo-container img {
            max-width: 95%;
            max-height: 95%;
        }

        .navbar .nav-left {
            align-items: center;
            gap: 20px;
        }

        .user-info {
            align-items: flex-end;
        }

        .user-info span {
            font-weight: bold;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 5px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #5a0db8;
        }

        .welcome {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .welcome h1 {
            font-size: 24px;
            margin: 0;
            color: #333;
        }

        .welcome p {
            color: #555;
        }

        .cards-container {
            max-height: 400px;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            flex: 1 1 300px;
            max-width: 300px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 40px;
            margin-bottom: 10px;
            color: #6a11cb;
        }

        .card .btn {
            margin-top: 10px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
        }

        .card .btn:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
        }

        footer {
            background-color: #6a11cb;
            color: white;
            text-align: center;
            padding: 5px;
            margin-top: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Barra de navegación -->
    <div class="logo-container">
             <img src="assets/LOGO TST.png" alt="Logo de la Compañía">
        </div>
    <div class="navbar">
        <div class="nav-left">
            <a href="#" class="">Inicio</a>
        </div>
        <div class="user-info">
            <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</span>
            <a href="#" onclick="openSettingsModal();"><i class="fas fa-cog"></i> Ajustes</a>
            <a href="#" class="btn btn-danger btn-sm" onclick="logoutWithDelay();">Cerrar Sesión</a>
        </div>
    </div>

    <!-- Mensaje de bienvenida -->
    <div class="welcome">
        <h1>¿Qué deseas hacer hoy?</h1>
        <p>Selecciona una de las opciones disponibles a continuación</p>
    </div>

    <!-- Contenedor de tarjetas -->
    <div class="cards-container">
        <div class="card">
            <i class="fas fa-users"></i>
            <h5>Gestión de Docentes</h5>
            <p>Consulta y gestiona información del personal docente.</p>
            <a href="#" class="btn btn-primary">Entrar</a>
        </div>
        <div class="card">
            <i class="fas fa-clock"></i>
            <h5>Crear Horarios</h5>
            <p>Crea y asigna horarios para los diferentes grupos.</p>
            <a href="form_materias.html" class="btn btn-primary">Entrar</a>
        </div>
        <div class="card">
            <i class="fas fa-eye"></i>
            <h5>Visualizar Horarios</h5>
            <p>Consulta los horarios creados para estudiantes y docentes.</p>
            <a href="#" class="btn btn-primary">Entrar</a>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        &copy; 2024 Plataforma Escolar - Creado por StrokBig
    </footer>

    <!-- Scripts -->
    <script>
        function logoutWithDelay() {
            alert("Gracias por usar nuestros servicios. Cerrando sesión...");
            setTimeout(() => {
                window.location.href = "logout.php";
            }, 5000); // 5 segundos de espera
        }
    </script>
</body>

</html>
