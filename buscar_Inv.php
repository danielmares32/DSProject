<?php 

require('connection.php');

$queryB = "SELECT nombre,apellidos FROM usuarios WHERE nombre LIKE LOWER('%".$_POST["buscarInvitado"]."%') OR nombre LIKE UPPER( '%".$_POST['buscarInvitado']."%' )";

$conexion = connect();
$consulta = $conexion->query($queryB);


?>


<?php  while($resultado = $consulta->fetch_assoc()) { ?>

<p class="card-text"><?php echo $resultado["nombre"]." ".$resultado["apellidos"] ?></p>

<?php } ?>