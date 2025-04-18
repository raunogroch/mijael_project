<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="views/login/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
    <title>Inicio de sesión</title>
</head>

<body>
    <img >
    <div class="container">
        <div class="img">
            <img src="views/login/img/mate1.jpg">
        </div>
        <div class="login-content">
            <form method="POST" action="">
                <img src="views/login/img/avatar.svg">
                <h2 class="title">BIENVENIDO</h2>
                <?php 
                    include($_SERVER['DOCUMENT_ROOT'] . '/model/conexion.php');
                    include($_SERVER['DOCUMENT_ROOT'] . '/controller/login.php');
                 ?>             
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input id="usuario" type="text"
                            class="input" name="usuario"
                            title="ingrese su nombre de usuario" autocomplete="usuario" value="">


                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" id="input" class="input"
                            name="password" title="ingrese su clave para ingresar" autocomplete="current-password">


                    </div>
                </div>
                <div class="view">
                    <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                </div>


                <div class="text-center">
                    
                </div>
                <input name="btningresar" class="btn" title="click para ingresar" type="submit" value="INICIAR SESION">
                <div class="d-flex justify-content-end mt-3"> <!-- Contenedor flexible a la derecha -->
    <a href="/" class="btn btn-secondary rounded-pill d-flex align-items-center">
        ATRAS
    </a>
</div>
            </form>

        </div>
    </div>
    <script src="views/login/js/fontawesome.js"></script>
    <script src="views/login/js/main.js"></script>
    <script src="views/login/js/main2.js"></script>
    <script src="views/login/js/jquery.min.js"></script>
    <script src="views/login/js/bootstrap.js"></script>
    <script src="views/login/js/bootstrap.bundle.js"></script>

</body>

</html>

