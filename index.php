<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/LogoV.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <title>Inicio de Sesión</title>
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
            background: url('assets/bg2.png') center/cover no-repeat;
            animation: backgroundChange 10s infinite;
        }

        @keyframes backgroundChange {
            0% {
                background-image: url('assets/bg2.png');
            }
            33% {
                background-image: url('assets/bg3.png');
            }
            66% {
                background-image: url('assets/bg4.png');
            }
        }

        .container {
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
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
            color: #6a11cb;
            font-size: 18px;
        }

        .input-div .input {
            width: 100%;
            padding: 15px 15px 15px 50px;
            border: 1px solid #ccc;
            border-radius: 25px;
            outline: none;
            transition: border 0.3s;
            box-sizing: border-box;
        }

        .input-div .input:focus {
            border-color: #6a11cb;
        }

        .input-div label {
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #6a11cb;
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
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
        }

        .forgot-password {
            display: block;
            margin: 10px 0;
            color: #6a11cb;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-content">
            <form action="carga.php" method="post">
                <img src="assets/logoPNG.png" alt="Logo" width="160px">
                <h2 class="title">Inicio de Sesión</h2>
                <br>

                <!-- Campo Usuario -->
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" class="input" name="usuario" id="usuario" required placeholder=" " autocomplete="off">
                    <label for="usuario">Institución Educativa</label>
                </div>

                <!-- Campo Contraseña -->
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" class="input" name="password" id="password" required placeholder=" ">
                    <label for="password">Contraseña</label>
                </div>

                <a href="forgot_password.php" class="forgot-password">¿Olvidaste tu contraseña?</a>
                <input class="btn" type="submit" value="INICIAR SESIÓN">
            </form>
        </div>
    </div>
</body>

</html>
