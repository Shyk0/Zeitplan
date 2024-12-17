<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir al login si no está autenticado
    exit();
}


// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_login";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'register') {
    $nombre = $_POST['nombre'];
    $asignatura = $_POST['asignatura'];
    $cedula = $_POST['cedula'];
    $grupo = $_POST['grupo'];
    $grado = $_POST['grado'];

    // Validar si la cédula ya existe en la base de datos
    $sql_check = "SELECT * FROM docentes WHERE cedula = '$cedula'";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        $mensaje = "Error: Ya existe un docente con esa cédula.";
    } else {
        // Insertar los datos en la base de datos si no existe duplicado
        $sql = "INSERT INTO docentes (nombre, asignatura, cedula, grupo, grado) VALUES ('$nombre', '$asignatura', '$cedula', '$grupo', '$grado')";
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Docente registrado con éxito.";
        } else {
            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Eliminar docente
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM docentes WHERE id = '$id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Docente eliminado con éxito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el docente']);
    }
    exit();
}

// Modificar docente
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $asignatura = $_POST['asignatura'];
    $cedula = $_POST['cedula'];
    $grupo = $_POST['grupo'];
    $grado = $_POST['grado'];

    $sql_update = "UPDATE docentes SET nombre = '$nombre', asignatura = '$asignatura', cedula = '$cedula', grupo = '$grupo', grado = '$grado' WHERE id = '$id'";
    if ($conn->query($sql_update) === TRUE) {
        $mensaje = "Docente modificado con éxito.";
    } else {
        $mensaje = "Error: " . $sql_update . "<br>" . $conn->error;
    }
}

// Cargar los docentes existentes (AJAX)
if (isset($_GET['action']) && $_GET['action'] == 'load_docentes') {
    $result = $conn->query("SELECT * FROM docentes");
    $docentes = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $docentes[] = $row;
        }
    }
    
    echo json_encode($docentes);
    exit();
}

$conn->close(); // Cerrar la conexión solo al final del script

// Lógica para cambiar el logo según el usuario
$logo_url = "assets/Logo.svg"; // Logo por defecto

// Aquí puedes agregar más condiciones para cambiar el logo según el usuario
if ($_SESSION['usuario'] == 'admin') {
    $logo_url = "assets/Logo.svg"; // Logo para el usuario admin
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
    <title>Gestión Docente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/logoV.ico">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
        }

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


        .table-container {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 20px;
        }

        .table {
            margin-top: 20px;
        }

        .btn-action {
            margin: 5px;
        }

        .btn-action i {
            font-size: 20px;
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

<!-- Barra de navegación -->
<div class="navbar-container">
        <!-- Contenedor del Logo con enlace -->
        <a href="cargaBtinicio.php" class="logo-container">
            <img src="<?php echo $logo_url; ?>" alt="Logo de la Compañía">
        </a>

    <!-- Barra de navegación -->
    <div class="navbar">
        <div>
            <a href="cargaBtinicio.php">Inicio</a>
        </div>
        <div class="user-info">
            <span>Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</span>
            <a href="#" onclick="openSettingsModal();"><i class="fas fa-cog"></i> Ajustes</a>
            <button class="btn-danger" onclick="logoutWithDelay();">Cerrar Sesión</button>
        </div>
    </div>
</div>

<!-- Contenedor de tarjetas -->
<div class="cards-container">
    <div class="card">
        <i class="fas fa-users"></i>
        <h5>Gestión de Docentes</h5>
        <p>Consulta y gestiona información del personal docente.</p>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroModal">Registrar Docente</button>
    </div>

    <div class="card">
        <i class="fas fa-eye"></i>
        <h5>Visualizar Horarios</h5>
        <p>Consulta los horarios creados para estudiantes y docentes.</p>
        <a href="#" class="btn btn-primary">Entrar</a>
    </div>
</div>
<br>

<!-- Tabla de Docentes con barra de scroll -->
<div class="container">
    <h2>Lista de Docentes</h2>
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Asignatura</th>
                    <th>Cédula</th>
                    <th>Grupo</th>
                    <th>Grado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="docentes-list">
                <!-- Aquí se agregarán los docentes con JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Registro Docente -->
<div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroModalLabel">Registrar Docente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioRegistro">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="asignatura" class="form-label">Asignatura</label>
                        <input type="text" class="form-control" id="asignatura" name="asignatura" required>
                    </div>
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" required>
                    </div>
                    <div class="mb-3">
                        <label for="grupo" class="form-label">Grupo</label>
                        <input type="text" class="form-control" id="grupo" name="grupo" required>
                    </div>
                    <div class="mb-3">
                        <label for="grado" class="form-label">Grado</label>
                        <input type="text" class="form-control" id="grado" name="grado" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Pie de página -->
<footer>
        &copy; 2024 Plataforma Escolar - Creado por StrokBig
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Función para cargar la lista de docentes usando AJAX
    window.onload = function() {
        loadDocentes();
    }

    function loadDocentes() {
        fetch('index.php?action=load_docentes')
            .then(response => response.json())
            .then(data => {
                let docentesList = document.getElementById('docentes-list');
                docentesList.innerHTML = '';

                data.forEach(docente => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${docente.nombre}</td>
                        <td>${docente.asignatura}</td>
                        <td>${docente.cedula}</td>
                        <td>${docente.grupo}</td>
                        <td>${docente.grado}</td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-action" onclick="editDocente(${docente.id})"><i class="fas fa-edit"></i> Editar</button>
                            <button class="btn btn-danger btn-sm btn-action" onclick="deleteDocente(${docente.id})"><i class="fas fa-trash-alt"></i> Eliminar</button>
                        </td>
                    `;
                    docentesList.appendChild(row);
                });
            });
    }

    // Función para eliminar un docente
    function deleteDocente(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este docente?')) {
            fetch(`index.php?action=delete&id=${id}`, { method: 'GET' })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    loadDocentes(); // Recargar la lista de docentes
                });
        }
    }

    // Función para editar docente
    function editDocente(id) {
        // Aquí podrías abrir un formulario con los datos del docente para editar
        alert('Funcionalidad de edición aún no implementada');
    }

    function logoutWithDelay() {
            alert("Gracias por usar nuestros servicios. Cerrando sesión...");
            setTimeout(() => {
                window.location.href = "logout.php";
            }, 2000); // 2 segundos de espera
        }
</script>
</body>
</html>
