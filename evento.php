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
	$nombreE = $row['nombre'];
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
<pre id="content" style="white-space: pre-wrap;"></pre>
    <br>
    <h1 style="text-align: center;">¡Cumpleaños de Daniel!</h1>
    <br>

    <div class="container" style="margin-left: auto;margin-right: auto;">
	    <!-- class="row row-cols-1 row-cols-md-3 "-->
	    <div id="datos" class="grid row g-4" style="text-align:center;">
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
                        <p class="card-text"><button onclick="handleAddEvent()" id="Add Event"> Añadir Evento</button> </p>
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

        window.onload = function() {
            let parametros = {"hashtag":"<?php echo $hashtag;?>"}
            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'instagramAPI.php',
                success: function(data){
                    console.log(data);
                    document.getElementById("datos").innerHTML += data;
                    setTimeout(() => {
                        var $grid = $('.grid').masonry({
                            percentPosition: true,
                        });
                        $grid.masonry();
                    }, 50);
                    
                }
            });
        };

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
	 <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
	<script>
	function testP(event){
		
		console.log('Working');
		}
		
		var AddEventButton=null;
		
      // Client ID and API key from the Developer Console
      var CLIENT_ID = '705113182929-2412er76mrocql9c8n18obp2uvaca13r.apps.googleusercontent.com';
      var API_KEY = 'AIzaSyCSoXISVENbLOHL06lUWvIPkpYiTzONGMc';

      // Array of API discovery doc URLs for APIs used by the quickstart
      var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

      // Authorization scopes required by the API; multiple scopes can be
      // included, separated by spaces.
      var SCOPES = "https://www.googleapis.com/auth/calendar";

     // var authorizeButton = document.getElementById('authorize_button');
      //var signoutButton = document.getElementById('signout_button');
	 
      /**
       *  On load, called to load the auth2 library and API client library.
       */
      function handleClientLoad() {
        gapi.load('client:auth2', initClient);
      }

      /**
       *  Initializes the API client library and sets up sign-in state
       *  listeners.
       */
	   
      function initClient() {
        gapi.client.init({
          apiKey: API_KEY,
          clientId: CLIENT_ID,
          discoveryDocs: DISCOVERY_DOCS,
          scope: SCOPES
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);
			console.log('Hola');
          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
           AddEventButton = document.getElementById('Add Event');
		   //AddEventButton.onclick= handleAddEvent;
		console.log('AEB: '+AddEventButton.id+' '+AddEventButton.onclick);
		  //authorizeButton.onclick = handleAuthClick;
         // signoutButton.onclick = handleSignoutClick;
		   }, function(error) {
          appendPre(JSON.stringify(error, null, 2));
        });
      }

      /**
       *  Called when the signed in status changes, to update the UI
       *  appropriately. After a sign-in, the API is called.
       */
      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
         // authorizeButton.style.display = 'none';
          //signoutButton.style.display = 'block';
		  AddEventButton.style.display = 'block';
          listUpcomingEvents();
        } else {
         // authorizeButton.style.display = 'block';
          //signoutButton.style.display = 'none';
        }
      }

      /**
       *  Sign in the user upon button click.
       */
      function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
      }

      /**
       *  Sign out the user upon button click.
       */
      function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }

      /**
       * Append a pre element to the body containing the given message
       * as its text node. Used to display the results of the API call.
       *
       * @param {string} message Text to be placed in pre element.
       */
      function appendPre(message) {
        var pre = document.getElementById('content');
        var textContent = document.createTextNode(message + '\n');
        pre.appendChild(textContent);
      }

      /**
       * Print the summary and start datetime/date of the next ten events in
       * the authorized user's calendar. If no events are found an
       * appropriate message is printed.
       */
      function listUpcomingEvents() {
        gapi.client.calendar.events.list({
          'calendarId': 'primary',
          'timeMin': (new Date()).toISOString(),
          'showDeleted': false,
          'singleEvents': true,
          'maxResults': 10,
          'orderBy': 'startTime'
        }).then(function(response) {
          var events = response.result.items;
          appendPre('Upcoming events:');

          if (events.length > 0) {
            for (i = 0; i < events.length; i++) {
              var event = events[i];
              var when = event.start.dateTime;
              if (!when) {
                when = event.start.date;
              }
              appendPre(event.summary + ' (' + when + ')')
            }
          } else {
            appendPre('No upcoming events found.');
          }
        });
      }
	  
	  function handleAddEvent(event){
		console.log('HOLA!!!');
		gapi.auth2.getAuthInstance().signIn();
			// Refer to the JavaScript quickstart on how to setup the environment:
		// https://developers.google.com/calendar/quickstart/js
		// Change the scope to 'https://www.googleapis.com/auth/calendar' and delete any
		// stored credentials.

		var evento = {
		  'summary': '<?php echo $nombreE; ?>',
		  'location': '<?php echo $ubicacion; ?>',
		'description':"Comparte la fiesta!",
		  'start': {
			'dateTime': "<?php $date = new DateTime($fecha);echo $date->format('Y-m-d\TH:i:s'); ?>",
			'timeZone': 'America/Los_Angeles'
		  },
		  'end': {
			'dateTime': "<?php $date = new DateTime($fecha);$date->add(new DateInterval('P1D'));echo $date->format('Y-m-d\TH:i:s');?>",
			'timeZone': 'America/Los_Angeles'
		  },
		  'recurrence': [
			'RRULE:FREQ=DAILY;COUNT=2'
		  ],
		  'attendees': [
			{'email': 'lpage@example.com'},
			{'email': 'sbrin@example.com'}
		  ],
		  'reminders': {
			'useDefault': false,
			'overrides': [
			  {'method': 'email', 'minutes': 24 * 60},
			  {'method': 'popup', 'minutes': 10}
			]
		  }
		};

		var request = gapi.client.calendar.events.insert({
		  'calendarId': 'primary',
		  'resource': evento
		});

		request.execute(function(event) {
			console.log('');
		  appendPre('Event created: ' + event.htmlLink);
		});

	}


	

 
	</script>	
</body>
</html>
