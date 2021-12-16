<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header('Location: login.php');
    }
    if(!isset($_POST["idEvento"])){
	header('Location: index.php');
    }
    $idEvento = $_POST["idEvento"];
    $nombre = $_SESSION["nombre"];
    $id = $_SESSION["id"];
    require ('connection.php');
    $connection=connect();
    if(isset($_FILES["archivo"]['tmp_name'])){
	$query="SELECT * FROM evento WHERE id_evento=$idEvento;";
	$result = $connection->query($query);
	$row = $result->fetch_assoc();
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key];
			$source = $_FILES["archivo"]["tmp_name"][$key]; 
			
			$directorio = substr($row["ubicacion_Media"],1); 
			
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			
			$dir=opendir($directorio); 
			$target_path = $directorio.'/'.$filename;
			
			if(move_uploaded_file($source, $target_path)) {	
				echo "<script>alert('El archivo $filename se ha almacenado en forma exitosa.');</script>";
			} else {	
				echo "<script>alert('Ha ocurrido un error, por favor inténtelo de nuevo.');</script>";
			}
			closedir($dir);
		}
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
    <title>Agrega Evento</title></head>
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
                </ul>
            </div>
        </div>
    </nav>

    <br>
    <h1 style="text-align: center;">¡Puedes agregar fotos de tu evento aquí!</h1>
    <br>

    <div class="container" style="text-align: center">		
	<form method="post" action="" enctype="multipart/form-data">			
		<h4 class="text-center">Cargar Multiple Archivos</h4>
		<div class="form-group">
			<input type="hidden" name="idEvento" value="<?php echo $idEvento;?>">
			<label class="col-sm-2 control-label">Archivos</label>
			<input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="" accept="image/*">
			<br>					
			<button type="submit" class="btn btn-primary">Cargar</button>
		</div>					
	</form>
     </div>

</body>
</html>
