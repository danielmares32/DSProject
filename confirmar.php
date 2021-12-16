<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header('Location: login.php');
    }
    $nombre = $_SESSION["nombre"];
    $id = $_SESSION["id"];
    $idEvento = $_POST["idEvento"];
    require ('connection.php');
    $connection=connect();

    $query = "SELECT * FROM evento,invitadosevento WHERE id_evento=idEvento and invitadosevento.idUsuario='$id' and idEvento = '$idEvento';";
    $resultado=$connection->query($query);
    $row = $resultado->fetch_assoc();
    $fecha = $row['fecha'];
    $ubicacion = $row['lugar'];
    $descripcion = $row['descripcion'];
    $hashtag = $row['hashtag'];
    $boletos = $row['boletos'];
    $idInvitado = $row['idInvitado'];
    if(isset($_POST["cantBoletos"])){
        $idInvitado = $_POST['idInvitado'];
        $cantidad = $_POST["cantBoletos"];
        $query = "UPDATE invitadosevento SET boletosConfirmados = '$cantidad' WHERE idInvitado='$idInvitado';";
        $result=$connection->query($query);
        if($result){
            disconnect($connection);
            echo '<script>window.alert("Boletos Registrados Correctamente");window.location.href = "index.php";</script>';
        } else {
            disconnect($connection);
            echo '<script>window.alert("Boletos NO Registrados Correctamente");window.location.href = "index.php";</script>';
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
                            <a href="invitaciones_usuario.php" class="dropdown-item">Ver Mis Invitaciones</a>
                            <a href="logout.php?salir=true" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="text-align:center;">
    
        <h1 style="text-align: center;">¡Te han invitado!</h1><br>
        <h2 style="text-align: center;">Te esperamos en: <?php echo $ubicacion ?> para festejar <?php echo $descripcion ?></h2><br>
        <h2 style="text-align: center;">¡Marca la fecha!<br> <?php echo $fecha ?></h2>
        <h2 style="text-align: center;">Tienes máximo<br> <?php echo $boletos ?> Boletos</h2>

        <form id="formBoletos" method="POST" action="">
            <input class="form-control" type="hidden" name="idInvitado" value="<?php echo $idInvitado;?>">
            <br>
            <h3>¿Cuántos boletos quieres confirmar? </h3> <input class="form-control" type="number" id="cantBoletos" name="cantBoletos" min="0" max="<?php echo $boletos;?>">
            <br>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>

    <br><br><br><br><br><br><br>
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
