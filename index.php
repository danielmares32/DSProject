<?php
    session_start();
	if(isset($_SESSION["id"])){
        //Mostrar Nombre de Usuario, Agregar y Buscar
        $nombre = $_SESSION["nombre"];
        $id = $_SESSION["id"];
        $estaLogeado=true;
    } else {
        //Mostrar Login y Registro
        $estaLogeado=false;
    }
    require ('connection.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png">
    <title>Comparte la Fiesta</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg static-top navbar-dark" style="background-color:rgb(52, 13, 95);">
        <div class="container">
            <a class="navbar-brand" href="index.php"> 
                <img src="logo.png" alt="Logo" srcset=""> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto justify-content-end">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <?php if($estaLogeado){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="agregar.php">Agregar Fiesta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buscar.php">Buscar Fiesta</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><?php echo $_SESSION["nombre"]; ?></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="eventos_usuario.php" class="dropdown-item">Ver Mis Eventos</a>
                            <a href="" class="dropdown-item">Ver Mis Invitaciones</a>
                            <a href="logout.php?salir=true" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                    <?php } else{?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro.php">Registrarse</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <h1 style="text-align: center;">Compartir tus Fiestas con el Mundo</h1>
    <br>
    <h5 style="text-align: center;">Comparte La Fiesta es una red social para eventos sociales.</h5>
    <h5 style="text-align: center;">Logramos que organizar eventos sea una tarea fácil, </h5> 
    <h5 style="text-align: center;">ayudamos a tener toda la información de la fiesta en un solo espacio,</h5> 
    <h5 style="text-align: center;">permitiendo compartir experiencias, videos y fotos,</h5>
    <h5 style="text-align: center;">confirmar invitados, y mucho más.</h5>
    <br>
    <div class="table-responsive">
        <table class="table table-borderless" style="text-align: center;margin: 0;">
            <tr>
                <td colspan="2">
                    <img src="fiesta-de-cumpleaños-1.jpg" alt="" class="img-thumbnail" id="imgInicio">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <h1>Comparte tus platillos favoritos</h1>
                    <h5>Sorprende a tus invitados con la mejor comida</h5> 
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="banquete-boda2.jpg" alt="" class="img-thumbnail" id="imgInicio">
                </td>
                <td>
                    <img src="banquete-boda.jpg" alt="" class="img-thumbnail" id="imgInicio">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <h1>Porque recordar es volver a vivir</h1>
                    <h5>Publica tus mejores fotos y videos después de la fiesta, </h5> 
                    <h5>para después compartirlos a través de redes sociales.</h5> 
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <img src="boda.jpg" alt="" class="img-thumbnail" id="imgInicio">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <h1>Y Mucho Más...</h1>
                    <br>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <footer class="footer">       
        <br><br> 
        Comparte La Fiesta © 2021 Copyright
        <br>
        Ubicación: Aguascalientes, México
    </footer>

    <!--Bootstrap y jQuery JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
