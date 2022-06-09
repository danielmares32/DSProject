<?php
    session_start();
	if(isset($_SESSION["id"])){
        header('Location: index.php');
    }
    require ('connection.php');
    if(isset($_POST["email"])){
        $email=$_POST["email"];
        $pass=md5($_POST["password"]);
        $query="SELECT * FROM usuarios;";
        $connection=connect();
        $result=$connection->query($query);
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                if($row["correo"]==$email && $row["contrasena"]==$pass){
                    $_SESSION["id"]=$row["id"];
                    $_SESSION["nombre"]=$row["nombre"];
                    disconnect($connection);
                    echo '<script>window.alert("Login Correcto");window.location.href = "index.php";</script>';
                }
            }
	        disconnect($connection);
            echo '<script>window.alert("Login Incorrecto");</script>';
        } else {
            disconnect($connection);
            echo '<script>window.alert("Login Incorrecto");</script>';
        }

    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png">
    <title>Incio Sesión</title></head>
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
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item active">
						<a class="nav-link" href="anuncios.php">Proveedores</a>
					</li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Registrarse</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="registro.php">Registro Usuario</a>
                            <a class="dropdown-item" href="registroProveedor.php">Registro Proveedor</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <h1 style="text-align: center;">¡Inicie Sesión Aquí!</h1>
    <br>
    <div style="margin-left: auto;margin-right: auto;" class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
    <form method="POST" action="">
        <div class="form-outline mb-4"> 
	        <label class="form-label" for="email">Email address</label>
            <input name="email" type="email" id="email" class="form-control form-control-lg" placeholder="Email address"/>
        </div>
        <div class="form-outline mb-4">
	        <label class="form-label" for="password">Password</label>
            <input name="password" type="password" id="password" class="form-control form-control-lg" placeholder="Password" />       
        </div>
	    <p style="text-align: center;">
	        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
	    </p>
    </form>
    <p style="text-align: center;">¿No estás registrado?<br>¡Haz click <a class="link-primary" href="Registro.html">aquí</a>!</p><br>
    </div>
    <br><br>
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