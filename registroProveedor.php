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
       $query = "INSERT INTO proveedor(nombre_empresa, estado, calle, numero, cp, telefono, correo, constrasena) VALUES ('$nombre_empresa','$estado','$calle','$numero','$cp','$telefono','$correo','$pass')"; 
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
    <h1 style="text-align: center;">¡Proveedor Registrese Aquí!</h1>
    <br>
    <div style="margin-left: auto;margin-right: auto;" class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
    <form id="myForm" method="POST" action="">
        <div class="form-outline mb-4"> 
	        <label class="form-label" for="nombre_empresa">Nombre de la Empresa</label>
            <input name="nombre_empresa" type="text" id="nombre_empresa" class="form-control form-control-lg" placeholder="Nombre Empresa"/>
        </div>
        <div class="form-outline mb-4"> 
	        <label class="form-label" for="calle">Calle</label>
            <input name="calle" type="text" id="calle" class="form-control form-control-lg" placeholder="Calle"/>
        </div>
        <div class="form-outline mb-4">
	        <label class="form-label" for="numero">Número</label>
	        <input name="numero" class="form-control form-control-lg" type="number" id="numero" placeholder="Número">
        </div>
		<div class="form-outline mb-4">
	        <label class="form-label" for="cp">CP</label>
	        <input name="cp" class="form-control form-control-lg" type="text" pattern="[0-9]*" id="cp" placeholder="Código Postal">
        </div>
		<div class="form-outline mb-4">
	        <label class="form-label" for="telefono">Teléfono</label>
	        <input name="telefono" class="form-control form-control-lg" type="tel" id="telefono" placeholder="Teléfono">
        </div>
	    <div class="form-outline mb-4"> 
	        <label class="form-label" for="correo">Correo</label>
            <input name="correo" type="email" id="email" class="form-control form-control-lg" placeholder="Correo"/>
        </div>
        <div class="form-outline mb-4">
	        <label class="form-label" for="password">Contraseña</label>
            <input name="password" type="password" id="password" class="form-control form-control-lg" placeholder="Contraseña" />       
        </div>
	    <div class="form-outline mb-4">
	        <label class="form-label" for="password">Confirmar Contraseña</label>
            <input name="password" type="password" id="confirmar-password" class="form-control form-control-lg" placeholder="Confirmar Contraseña" />       
        </div>
	    <p style="text-align: center;">
	        <button id="boton" type="button" class="btn btn-primary btn-lg btn-block">Sign up</button>
	    </p>       
    </form>
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
    <script>
	    document.getElementById("boton").addEventListener("click",()=>{
		let nombre_empresa =document.getElementById("nombre_empresa");
		let calle =document.getElementById("calle");
		let num =document.getElementById("numero");
        let cp = document.getElementById("cp");
        let telefono = document.getElementById("telefono");
		let email =document.getElementById("email");
		let p1 = document.getElementById("password");
		let p2 = document.getElementById("confirmar-password");
		let condicion = !(nombre_empresa.value.length > 0 && calle.value.length > 0 && num.value.length > 0 && cp.value.length > 0 && telefono.value.length > 0 && email.value.length > 0 && p1.value.length > 0 && p2.value.length > 0);
		if(condicion){
			window.alert("Hay campos vacios");
		}else if(p1.value != p2.value){
			window.alert("Las contraseñas no coinciden");
		} else {
            document.getElementById("myForm").submit();
        }
	    });
    </script>
</body>
</html>