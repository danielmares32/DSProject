<?php
    session_start();
	if(isset($_SESSION["id"])){
        header('Location: index.php');
    }
    require ('connection.php');
    if(isset($_POST["nombre"])){
       $nombre = $_POST["nombre"];
       $apellidos = $_POST["apellidos"];
       $fechaNacimiento = $_POST["fechaNac"];
       $correo = $_POST["correo"];
       $pass = md5($_POST["password"]);
       $query = "INSERT INTO usuarios(nombre,apellidos,fecha_nacimiento,correo,contrasena) VALUES ('$nombre','$apellidos','$fechaNacimiento','$correo','$pass')"; 
       $connection=connect();
       $result=$connection->query($query);
       if($result){
	    disconnect($connection);
        echo '<script>window.alert("Usuario Registrado Correctamente");window.location.href = "index.php";</script>';
       } else {
        disconnect($connection);
        echo '<script>window.alert("Usuario No Registrado Correctamente");window.location.href = "index.php";</script>';
       }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png">
    <title>Registro</title></head>
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
                        <a class="nav-link" href="login.php">Iniciar Sesi??n</a>
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
    <h1 style="text-align: center;">??Registrese Aqu??!</h1>
    <br>
    <div style="margin-left: auto;margin-right: auto;" class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
    <form id="myForm" method="POST" action="">
        <div class="form-outline mb-4"> 
	        <label class="form-label" for="nombre">Nombre</label>
            <input name="nombre" type="text" id="nombre" class="form-control form-control-lg" placeholder="Nombre"/>
        </div>
        <div class="form-outline mb-4"> 
	        <label class="form-label" for="apellidos">Apellidos</label>
            <input name="apellidos" type="text" id="apellidos" class="form-control form-control-lg" placeholder="Apellidos"/>
        </div>
        <div class="form-outline mb-4">
	        <label class="form-label" for="password">Fecha de Nacimiento</label>
	        <input class="form-control" type="date" id="fechaNac" name="fechaNac">
        </div>
	    <div class="form-outline mb-4"> 
	        <label class="form-label" for="correo">Correo</label>
            <input name="correo" type="email" id="email" class="form-control form-control-lg" placeholder="Correo"/>
        </div>
        <div class="form-outline mb-4">
	        <label class="form-label" for="password">Contrase??a</label>
            <input name="password" type="password" id="password" class="form-control form-control-lg" placeholder="Contrase??a" />       
        </div>
	    <div class="form-outline mb-4">
	        <label class="form-label" for="password">Confirmar Contrase??a</label>
            <input name="password" type="password" id="confirmar-password" class="form-control form-control-lg" placeholder="Confirmar Contrase??a" />       
        </div>
	    <p style="text-align: center;">
	        <button id="boton" type="button" class="btn btn-primary btn-lg btn-block">Sign up</button>
	    </p>       
    </form>
    </div>
    <br><br>
    <footer class="footer">       
        <br><br> 
        Comparte La Fiesta ?? 2021 Copyright
        <br>
        Ubicaci??n: Aguascalientes, M??xico
    </footer>	   
    <!--Bootstrap y jQuery JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
	    document.getElementById("boton").addEventListener("click",()=>{
		let nombre =document.getElementById("nombre");
		let apellidos =document.getElementById("apellidos");
		let fecNac =document.getElementById("fechaNac");
		let email =document.getElementById("email");
		let p1 = document.getElementById("password");
		let p2 = document.getElementById("confirmar-password");
		let condicion = !(nombre.value.length > 0 && apellidos.value.length > 0 && fecNac.value.length > 0 && email.value.length > 0 && p1.value.length > 0 && p2.value.length > 0);
		if(condicion){
			window.alert("Hay campos vacios");
		}else if(p1.value != p2.value){
			window.alert("Las contrase??as no coinciden");
		} else {
            document.getElementById("myForm").submit();
        }
	    });
    </script>
</body>
</html>