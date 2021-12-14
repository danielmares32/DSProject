<?php
  session_start();
	if(!isset($_SESSION["id"])){
    header('Location: login.php');
  }
  $nombre = $_SESSION["nombre"];
  $id = $_SESSION["id"]; 
  require('connection.php');
  $idEvento = 1; //simplemente de prueba, modificar por post.
  $conexion = connect();
  if(isset($_POST["btnSubmit"])){
    $invitado = $_POST['nombreInvitado'];
    $invitaciones = $_POST['numInvitacion'];

    
    $queryA = "SELECT id from usuarios WHERE CONCAT(nombre,' ',apellidos)='$invitado';";
    $consulta = $conexion->query($queryA);
    $resultado = $consulta->fetch_assoc();
    $id_usu = $resultado['id'];


    $queryI = "INSERT into invitadosevento (idEvento,idUsuario,boletos) VALUES($idEvento,$id_usu,$invitaciones);";
    $consulta2 = $conexion->query($queryI);
    if($consulta2){
      echo '<script>alert("invitado agregado al evento");</script>';
    }else{
      echo '<script>alert("algo salio mal :c");</script>';
    }

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

 	<title>Invitados</title>
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

    <div class="container" style="background-image: url(invImg.jpg); background-repeat: no-repeat; background-size: cover; background-position: center; height: 400px;"></div>

    <br>
    <h1 style="text-align:center">Busca a tus invitados.</h1>
    <br>




    <div class="container">
        <div class="row" style="width: 100%;background-color:#3D59AB;height: 100%;">
            <div class="col-md-12" style="background-color:#3D59AB;padding:2%;">    
                <br><br>
                <input class="form-control" type="text" id="buscarInvitado" placeholder="Busca por Nombre o Apellidos">
                <br>
                <div class="card col-12 mt-5">
                    <div class="card-body">
                      <div id="resultados_buscador" class="container pl-5 pr-5"></div>
                    </div>
                </div>
                <br><br>
            </div>   		
        </div>  
      <!--<div class="col-md-4" style=" background-image: url(fondoInv.jpg); background-repeat:no-repeat; background-position:center; background-size:cover;"></div>-->
    </div>

    <br>
    <footer class="footer">       
        <br><br> 
        Comparte La Fiesta © 2021 Copyright
        <br>
        Ubicación: Aguascalientes, México
    </footer>

    <!--script para busqueda-->
    <script type="text/javascript">
      
        document.getElementById("buscarInvitado").addEventListener("keyup",()=>{
            //aquí pones la función
            let invitado = document.getElementById("buscarInvitado").value;
            buscar_ahora(invitado);
        });

      function buscar_ahora(buscarInvitado){
        var parametros = {"buscarInvitado":buscarInvitado};
        $.ajax({
          data: parametros,
          type: 'POST',
          url: 'buscar_Inv.php',
          success: function(data){
            document.getElementById("resultados_buscador").innerHTML = data;
          }
        });
      }
    </script>

<!--Bootstrap y jQuery JS-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 
    
 </body>
 </html>