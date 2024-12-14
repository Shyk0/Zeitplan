<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/Logo.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <title>Recuperar Contraseña</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background: url('assets/bg1.png') center/cover no-repeat; /* Imagen inicial */
            animation: backgroundChange 8s infinite; /* Cambia entre las imágenes cada 2 segundos */
        }

        /* Animación de cambio de fondo */
        @keyframes backgroundChange {
            0% {
                background-image: url('assets/bg1.png');
            }
            50% {
                background-image: url('assets/bg5.png');
            }
        }

        .container {
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco translúcido */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-content img {
            margin-bottom: 15px;
        }

        .login-content h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .input-div {
            position: relative;
            margin: 25px 0;
        }

        .input-div .i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #ff7e5f;
            font-size: 18px;
        }

        .input-div .input {
            width: 100%;
            padding: 15px 15px 15px 50px; /* Espacio extra a la izquierda para el icono */
            border: 1px solid #ccc;
            border-radius: 25px;
            outline: none;
            box-sizing: border-box; /* Evitar que el padding afecte el tamaño total */
            transition: border 0.3s;
        }

        .input-div .input:focus {
            border-color: #ff7e5f;
        }

        .input-div label {
            position: absolute;
            left: 50px; /* Ajusta la posición de la etiqueta para que no se sobreponga con el icono */
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #ff7e5f;
            transition: 0.3s;
        }

        .input-div .input:focus + label,
        .input-div .input:not(:placeholder-shown) + label {
            top: -10px;
            font-size: 16px;
            font-weight: bold;
            color: #2575fc;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: linear-gradient(to right, #feb47b, #ff7e5f);
        }

        .button {
            background-color: black;
            color: #fff;
            width: 8.5em;
            height: 2.9em;
            border: black#333 0.2em solid;
            border-radius: 11px;
            text-align: right;
            transition: all 0.6s ease;
        }

        .button:hover {
            background-color: #3654ff;
            cursor: pointer;
        }

        .button svg {
            width: 1.6em;
            margin: -0.2em 0.8em 1em;
            position: absolute;
            display: flex;
            transition: all 0.6s ease;
        }

        .button:hover svg {
            transform: translateX(5px);
        }

        .text {
            margin: 0 1.5em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-content">
            <a href="index.php" class="button-link">
                <button class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75-6.75M4.5 12l6.75 6.75"></path>
                    </svg>
                    <div class="text">Atrás</div>
                </button>
            </a>
            <form action="process_forgot_password.php" method="post">
                <img src="assets/logo.svg" alt="Logo" width="120px">
                <h2 class="title">Recuperar Contraseña</h2>
                <br>

                <!-- Campo Correo -->
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i> <!-- Ícono de correo electrónico -->
                    </div>
                    <input type="email" class="input" name="email" id="email" required placeholder=" ">
                    <label for="email">Correo Electrónico</label>
                </div>

                <input class="btn" type="submit" value="ENVIAR CORREO">
            </form>
        </div>
    </div>
</body>

</html>
