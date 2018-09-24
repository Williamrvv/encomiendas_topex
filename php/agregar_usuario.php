<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$usrn=$_POST['usrn'];
$usrc=$_POST['usrc'];
$usrt=$_POST['usrt'];
$idmensajero=time();
$contra=sha1($usrc);

if ($usrc=='') {
	?><script type="text/javascript">swal("Debes ingresar una contraseña!");</script><?php die();
}

$consulta = "SELECT count(`contrasena`) FROM `usuarios` WHERE `contrasena`='$contra'";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
    	if ($fila[0]!=0) {
    		?><script type="text/javascript">
	         	swal({
				  title: "Error!",
				  text: "Elije otra contraseña!",
				  icon: "error",
				  button: "Aceptar!",
				});
         	</script><?php die();
    	}
         
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}
$consulta = "SELECT count(`nombre`) FROM `usuarios` WHERE `nombre`='$usrn'";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
    	if ($fila[0]!=0) {
    		?><script type="text/javascript">
	         	swal({
				  title: "Error!",
				  text: "Elije otro nombre de usuario!",
				  icon: "error",
				  button: "Aceptar!",
				});
         	</script><?php die();
    	}
         
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}

if ($usr!='' and $usrc!='' and $usrt!='') {
$query = "INSERT INTO `usuarios`(`nombre`, `contrasena`, `tipo`, `idmensajero`) VALUES ('$usrn','$contra','$usrt','$idmensajero')";
mysqli_query($con, $query);
?><script type="text/javascript">swal("Todo listo!", "Usuario nuevo creado con éxito!", "success");</script><?php 
}

if ($usrt=='mensajero') {
	$query = "INSERT INTO `mensajeros`(`id`, `nombre`) VALUES ($idmensajero,'$usrn')";
mysqli_query($con, $query);
?><script type="text/javascript">
swal({
	  title: "Todo listo!",
	  text: "Usuario nuevo creado con éxito!",
	  icon: "success",
	  button: "Aceptar!",
	})
.then((value) => {
  swal(`Se ha añadido a <?php echo $usrn ?> a la lista de mensajeros!`);
});

</script><?php 
}
?>
<script type="text/javascript">
    $('#exampleModal').modal('toggle');
    setTimeout ("iniconfig();", 500); 
</script>