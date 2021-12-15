<?php 

require('connection.php');

$queryB = "SELECT nombre,apellidos FROM usuarios WHERE nombre LIKE LOWER('%".$_POST["buscarInvitado"]."%') OR nombre LIKE UPPER( '%".$_POST['buscarInvitado']."%') OR apellidos LIKE LOWER('%".$_POST["buscarInvitado"]."%') OR apellidos LIKE UPPER( '%".$_POST['buscarInvitado']."%')";

$conexion = connect();
$consulta = $conexion->query($queryB);
$idEvento = $_POST["idEvento"];

?>


<?php  while($resultado = $consulta->fetch_assoc()) { ?>


<div class="table-responsive container">
        <form id="myFormInv" method="POST" action="invitar.php">
        <table class="table table-responsive table-striped p-3">
            <tr>
            	<td style="color:#082152;"><?php echo $resultado["nombre"]." ".$resultado["apellidos"] ?></td>
                <td>
                    <input class="form-control" type="hidden" id="nombreInvitado" name="nombreInvitado" value='<?php echo $resultado["nombre"]." ".$resultado["apellidos"] ?>'>
                    <input type="hidden" name="idEvento" value="<?php echo $idEvento ?>">
                </td>
            </tr>
            <tr>
                <td style="color:#082152">Numero de invitaciones</td>
                <td><input class="form-control" type="number" id="numInvitacion" value='1' name="numInvitacion"></td>
            </tr>
        </table>
            <button class="btn btn-primary" type="submit" id="btnSubmit" name="btnSubmit">Invitar</button>
        </form><br>
</div>

<?php } ?>