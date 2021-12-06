<?php
    session_start();
	if(!isset($_SESSION["id"])){
        header('Location: login.php');
    }
    $nombre = $_SESSION["nombre"];
    $id = $_SESSION["id"];
    require ('connection.php');
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
                            <a href="logout.php?salir=true" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br>
    <h1 style="text-align: center;">¡Puedes agregar tu evento aquí!</h1>
    <br>
    <div class="table-responsive">
        <table class="table table-responsive table-striped p-3">
            <tr>
                <td>Nombre del Evento</td>
                <td><input class="form-control" type="text" id="nombreEvento" name="nombreEvento" placeholder="Nombre del Evento"></td>
            </tr>
            <tr>
                <td>Fecha</td>
                <td><input class="form-control" type="date" id="fechaEvento" name="fechaEvento"></td>
            </tr>
            <tr>
                <td>Hora</td>
                <td><input class="form-control" type="time" id="horaEvento" name="horaEvento"></td>
            </tr>
            <tr>
                <td>Hashtag</td>
                <td><input class="form-control" type="text" id="hashtagEvento" name="hashtagEvento" placeholder="Hashtag del Evento"></td>
            </tr>
            <tr>
                <td>Locación</td>
                <td><input type="text" class="form-control" id="search" placeholder="Escribe la direccion del evento"></td>
            </tr>
        </table>
        <div style="text-align: center;">
            <button class="btn btn-primary" type="button" id="btn">Actualizar Mapa</button>
            <br><br>
            <h3>Mapa</h3>
            <div id="map" style="margin-left: auto;margin-right: auto;height: 450px;width: 1250px;"></div>
        </div>
        
    </div>
    <br><br>
    <footer class="footer">       
        <br><br> 
        Comparte La Fiesta © 2021 Copyright
        <br>
        Ubicación: Aguascalientes, México
    </footer>
    <!--Bootstrap y jQuery JS-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABYfdNAPibREcz-3Clw0sKIQlkW6QzgLg&libraries=places&callback=initMap" async>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        
        let lugar="Universidad Autonoma de Aguascalientes";
        let map;
        let infowindow;
        let service;

        document.getElementById("btn").addEventListener("click",()=>{
            lugar = document.getElementById("search").value;
            console.log("respuesta"+lugar);
            initMap()
        });

        function initialize() {
            var input = document.getElementById('search');
            new google.maps.places.Autocomplete(input);
        }

        function initMap() {
            google.maps.event.addDomListener(window, 'load', initialize);
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 21.9338292, lng: -102.3196637 },
                zoom: 13,
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
</body>
</html>