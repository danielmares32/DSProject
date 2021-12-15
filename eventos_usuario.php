<?php
   session_start();
	if(!isset($_SESSION["id"])){
        header('Location: login.php');
    }
    $nombre = $_SESSION["nombre"];
    $id = $_SESSION["id"];
    
    require ('connection.php');
    $connection=connect();
    $query = "SELECT * FROM evento,adminsevento WHERE evento.id_evento=adminsevento.idEvento AND adminsevento.idUsuario=$id ORDER BY id_evento DESC;";
    $result = $connection->query($query);
    $array = array();
    while($row = $result->fetch_assoc()){
        $array[] = $row;
    }

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
    <title>Tus eventos</title></head>
	
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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">
                        	<?php echo $_SESSION["nombre"]; ?></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="" class="dropdown-item">Ver Mis Invitaciones</a>
                            <a href="logout.php?salir=true" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
     <h1 style="text-align: center;">Tus Eventos</h1><br>

<?php
        echo '<div class="card-group">';
        for($i=0;$i<count($array);$i++){
		$idEvent=$array[$i]['id_evento'];
	    if($i % 3 == 0 && $i != 1){
		echo '</div>';
		echo '<div class="card-group">';    
	    }
	    echo '<div class="card m-4 p-3 text-center text-white rounded" style="width: 18rem;background-color:#3D59AB;">
		<img class="card-img-top" src="cumpleaños3.jpg" alt="Card image cap">
		<div class="card-body">
			<h5 class="card-title">'.$array[$i]['nombre'].'</h5>
			<p class="card-text">'.$array[$i]['descripcion'].'</p>
			<p><a href="#" class="btn btn-primary">Ver Evento</a> o <a href="invitar.php?idEvento=$idEvent" class="btn btn-primary">Invitar</a></p>
		</div>
	        </div>';    
	    
	}
	echo '</div>';
    ?>



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
