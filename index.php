<?php require_once("php/conn.php");
session_start();
if ($_SESSION['user']=='') {
    header('Location: php/cerrar_sesion.php');
    die();
}

$usr= $_SESSION['user'];
$consulta = "SELECT `id`,`nombre`,`tipo`,`idmensajero` FROM `usuarios` WHERE `contrasena`='$usr'";
if ($resultado = $con->query($consulta)) {
    $fila = $resultado->fetch_row();
        $_SESSION['id']=$fila[0];
        $_SESSION['nombre']=$fila[1];
        $_SESSION['tipo']=$fila[2];
        @$_SESSION['idmensj']=$fila[3];
    
    /* liberar el conjunto de resultados */
  $resultado->close();
}
if ($_SESSION['tipo']=='mensajero') {
$load="inicmensajero()";
}else{$load="inic()";}
?>
<!doctype html>
<html lang="es">
  <head>
<script src="js/jquery.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!--fonts-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--Alertas-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Autocomplete-->
    <script src="js/jquery.auto-complete.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.auto-complete.css">
    <!--esilo personalizado-->
    <link rel="stylesheet" type="text/css" href="css/estylo.css">
    <!--Controlador-->
    <script src="js/controlador.js"></script>
    <!--buscador-->
    <script src="js/quicksearch.js"></script>

    <title>Encomiendas Topex</title>
  </head>
  <body onload='<?php echo $load ?>'>
  	<form id="menuu" >
		<div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav();"><i class="fas fa-times"></i></a>
<?php if ($_SESSION['tipo']!='mensajero') {
          ?><a href="#" id="inicio" onclick="inic();"><i class="fas fa-home"></i> Inicio</a><?php 
}?>
		  <a href="#" id="btn_encomiendas" onclick="inicmensajero();"><i class="fas fa-list-ol"></i> Encomiendas</a>
<?php if ($_SESSION['tipo']!='mensajero' and $_SESSION['tipo']!='operario') {
    ?><a href="#" onclick="iniconfig()"><i class="fas fa-cogs"></i> configuración</a><?php 
}?>
          <a href="php/cerrar_sesion.php"><i class="fas fa-door-open"></i> Cerrar sesión</a>
		</div>
		</form>
		<div id="main">
		  <center><h2>Sistema de control de encomiendas recibidas</h2></center>
		  <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fas fa-bars"></i> Menú</span>
		  <div id="cuerpo"></div>
		</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  </body>
</html>