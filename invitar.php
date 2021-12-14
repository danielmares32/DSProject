<?php 
require('connection.php');
$idEvento = 1; //simplemente de prueba, modificar por post.
$conexion = connect();
  if(isset($_POST["btnSubmit"])){
    $invitado = $_POST['nombreInvitado'];
    $invitaciones = $_POST['numInvitacion'];

    
    $queryA = "SELECT id from usuarios WHERE nombre='$invitado'";
    $consulta = $conexion->query($queryA);
    $resultado = $consulta->fetch_assoc();
    $id_usu = $resultado['id'];


    $queryI = "INSERT into invitadosevento (idEvento,idUsuario,boletos) VALUES($idEvento,$id_usu,$invitaciones)";
    $consulta2 = $conexion->query($queryI);
    if($consulta2){
      alert("invitado agregado al evento");
    }else{
      alert("algo salio mal :c");
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
 
 <div class="container-xl" style="width: 100%; height: 100%">
 	<div class="row" style="width: 100%; background-color: green; height: 100%;">

 		<div class="col-md-8" style="background-color: #474A4C;">


       <h1 style="color: #F6F7F9; text-align:center">Busca a tus invitados.</h1>
       <br>
       <br>
       	<input class="form-control" type="text" id="buscarInvitado" placeholder="Nombre">
       	<br>
       	<br>

       	<div class="card col-12 mt-5">
       		<div class="card-body">
       			<div id="resultados_buscador" class="container pl-5 pr-5"></div>
       		</div>
       	</div><br><br><br>

<!--formulario-->
       <div class="table-responsive container">
        <form id="myFormInv" method="POST" action="">
        <table class="table table-responsive table-striped p-3">
            <tr>
                <td style="color:#F6F7F9;">Nombre del Invitado</td>
                <td><input class="form-control" type="text" id="nombreInvitado" name="nombreInvitado" placeholder="Nombre del Invitado"></td>
            </tr>
            <tr>
                <td style="color:#F6F7F9;">Numero de invitaciones</td>
                <td><input class="form-control" type="number" id="numInvitacion" name="numInvitacion"></td>
            </tr>
        </table>
        <br><br>
            <button class="btn btn-primary" type="button" id="btnSubmit" name="btnSubmit">Invitar</button>
        </form>
      </div>		
 	</div>

    <div class="col-md-4" style=" background-image: url(inv.jpg); background-repeat:no-repeat; background-position:center"></div>
 
   </div>




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