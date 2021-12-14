<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header('Location: login.php');
    }
    $nombre = $_SESSION["nombre"];
    $id = $_SESSION["id"];
    $idEvento = $_GET["idEvento"];
    require ('connection.php');
    $connection=connect();
    $query = "SELECT * FROM evento WHERE id_evento = '$idEvento';";
    $result=$connection->query($query);
    if($result){
        disconnect($connection);
    } else {
        disconnect($connection);
        echo '<script>window.alert("Evento No Mostrado Correctamente");window.location.href = "index.php";</script>';
    }
    $row = $result->fetch_assoc();
    $fecha = $row['fecha'];
    $ubicacion = $row['lugar'];
    $descripcion = $row['descripcion'];
    $hashtag = $row['hashtag'];
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
                            <a href="" class="dropdown-item">Ver Mis Eventos</a>
                            <a href="" class="dropdown-item">Ver Mis Invitaciones</a>
                            <a href="logout.php?salir=true" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br>
    <h1 style="text-align: center;">¡Cumpleaños de Daniel!</h1>
    <br>

    <div class="container">
	    <!-- class="row row-cols-1 row-cols-md-3 g-4" -->
	    <div class="row" data-masonry='{"percentPosition": true }'>
		<div class="col-sm-4 col-md-3 py-3">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Fecha del Evento</h5>
					<p class="card-text"><?php echo $fecha;?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-3 py-3">
			<div class="card">
				<img src="cumpleaños3.jpg" class="card-img-top" alt="...">
			</div>
		</div>
		<div class="col-sm-4 col-md-3 py-3">
			<div class="card">
				<div class="container">
					<div id="map" style="margin-left: auto;margin-right: auto;height: 350px;width: 100%;"></div>
				</div>
				<div class="card-body">
					<h5 class="card-title">Ubicación</h5>
					<p class="card-text"><?php echo $ubicacion; ?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-3 py-3">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Descripción</h5>
					<p class="card-text"><?php echo $descripcion; ?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-3 py-3">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"><?php echo $hashtag; ?></h5>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-3 py-3">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Agregar a mi calendario en Google Calendar</h5>
					<p class="card-text">API de Google Calendar</p>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-3 py-3">
			<div class="card">
				<img src="cumpleaños.jpg" class="card-img-top" alt="...">
			</div>
		</div>
		<div class="col-sm-4 col-md-3 py-3">
			<div class="card">
				<img src="cumpleaños2.jpg" class="card-img-top" alt="...">
			</div>
		</div>
	    </div>
        </div>


    <br><br>
    <footer class="footer">       
        <br><br> 
        Comparte La Fiesta © 2021 Copyright
        <br>
        Ubicación: Aguascalientes, México
    </footer>

<script>
	
        let lugar="<?php echo $ubicacion; ?>";
        let map;
        let infowindow;
        let service;

        function initMap() {
            google.maps.event.addDomListener(window, 'load');
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 21.9338292, lng: -102.3196637 },
                zoom: 15,
            });
            const request = {
                query: lugar,
                fields: ["name", "geometry"],
            };
            service = new google.maps.places.PlacesService(map);
            service.findPlaceFromQuery(request, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK && results) {
                for (let i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }

                map.setCenter(results[0].geometry.location);
                }
            });
        }

        function createMarker(place) {
            if (!place.geometry || !place.geometry.location) return;

            const marker = new google.maps.Marker({
                map,
                position: place.geometry.location,
            });

            google.maps.event.addListener(marker, "click", () => {
                infowindow.setContent(place.name || "");
                infowindow.open(map);
            });
        }

    </script>

    <!--Bootstrap y jQuery JS-->
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABYfdNAPibREcz-3Clw0sKIQlkW6QzgLg&libraries=places&callback=initMap" async>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>