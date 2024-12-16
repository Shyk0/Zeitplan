<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir al login si no está autenticado
    exit();
}

// Lógica para cambiar el logo según el usuario
$logo_url = "assets/LogoPNG.png"; // Logo por defecto

// Aquí puedes agregar más condiciones para cambiar el logo según el usuario
if ($_SESSION['usuario'] == 'admin') {
    $logo_url = "assets/LogoPNG.png"; // Logo para el usuario admin
} elseif ($_SESSION['usuario'] == 'El Triunfo Santa Teresa') {
    $logo_url = "assets/LOGO TST.png"; // Logo para el usuario colegio
} 
// Agregar más condiciones si es necesario
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

        /* Contenedor principal de la barra */
        .navbar-container {
            display: flex;
            align-items: center;
            background-color: #1a3b5d; /* Azul oscuro */
            height: 3.12em;
            justify-content: space-between;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        /* Contenedor del logo (ahora un enlace) */
        .logo-container {
            background-color: white;
            height: 6em;
            width: 6em;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0.4em;
            left: 20px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.4);
            border-radius: 10px; /* Bordes redondeados */
            z-index: 2;
        }

        /* Imagen del logo */
        .logo-container img {
            height: 90%;
            width: 90%;
            object-fit: contain;
        }

        /* Barra de navegación */
        .navbar {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            margin-left: 6.5em; /* Reducido para acercar el "Inicio" al logo */
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 5px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #000000; /* Color negro al pasar el cursor */
        }

        /* Botón de cerrar sesión */
        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;  /* Reducir el tamaño del padding */
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px; /* Reducir el tamaño de la fuente */
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Sección de usuario */
        .user-info span {
            font-weight: bold;
            margin-right: 10px;
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
            color: rgb(0, 0, 0);
        }

        .card .btn {
            margin-top: 10px;
            background: linear-gradient(to right, rgb(0, 0, 0), #1a3b5d);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .card .btn:hover {
            background: linear-gradient(to right, #1a3b5d, rgb(0, 0, 0));
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); /* Añadir sombra sutil al pasar */
        }

        footer {
            background-color: #1a3b5d;
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
    <!-- Contenedor principal -->
    <div class="navbar-container">
        <!-- Contenedor del Logo con enlace -->
        <a href="dashboard.php" class="logo-container">
            <img src="<?php echo $logo_url; ?>" alt="Logo de la Compañía">
        </a>

        <!-- Barra de navegación -->
        <div class="navbar">
            <div>
                <a href="dashboard.php">Inicio</a>
            </div>
            <div class="user-info">
                <span>Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</span>
                <a href="#" onclick="openSettingsModal();"><i class="fas fa-cog"></i> Ajustes</a>
                <button class="btn-danger" onclick="logoutWithDelay();">Cerrar Sesión</button>
            </div>
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
            <a href="gestiondocente.php" class="btn btn-primary">Entrar</a>
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
