<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$idu=$_POST['idu'];
$usract=$_POST['usract'];
$usrco=$_POST['usrco'];
$ncont=sha1($usrco);
$usrti=$_POST['usrti'];

if ($idu==2) {
	?><script type="text/javascript">
		swal("Error!", "No puedes hacerle cambios al desarrollador ;)", "error");
		$('#exampleModal').modal('toggle');
	</script><?php die();
}

$consulta = "SELECT `nombre` FROM `usuarios` WHERE `id`='$idu'";
if ($resultado = $con->query($consulta)) {
    $nombre = $resultado->fetch_row();
    /* liberar el conjunto de resultados */
    $resultado->close();
}

$consulta = "SELECT IF (
				(SELECT COUNT(`nombre`) from usuarios WHERE `nombre`!= '$nombre[0]' and `nombre` != '$usract') < (SELECT COUNT(`nombre`) from usuarios WHERE `nombre`!= '$nombre[0]'),'no', 'si' 
			) FROM `usuarios` LIMIT 1";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
    	if ($fila[0]=='no') {
    		?><script type="text/javascript">swal("Error!", "El usuario ya existe", "error");
    		$('#exampleModal').modal('toggle');</script><?php die();
    	}
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}
$consulta = "SELECT COUNT(`contrasena`) FROM `usuarios` WHERE `contrasena`='$ncont'";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
    	if ($fila[0]==1) {
    		echo "$fila[0]";
    		?><script type="text/javascript">swal("Error!", "Elije otra contraseña", "error");
    		$('#exampleModal').modal('toggle');</script><?php die();
    	}
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}


$consulta = "SELECT `idmensajero` FROM `usuarios` WHERE `id` = $idu";
if ($resultado = $con->query($consulta)) {
    $idmensj = $resultado->fetch_row();
    $resultado->close();
}
if ($usrti!='mensajero') {
	$query = "UPDATE `mensajeros` SET `status`=0 WHERE `id`=$idmensj[0]";
 	mysqli_query($con, $query);
}
if ($usrti=='mensajero') {
$query = "INSERT INTO `mensajeros`(`id`, `nombre`) VALUES ($idmensj[0],'$usract') ON DUPLICATE KEY UPDATE `nombre`= '$usract', status=1";
mysqli_query($con, $query); 
?><script type="text/javascript">swal("Usuario agregado a la lista de mensajeros!");</script><?php 
}
$query = "UPDATE `usuarios` SET `nombre`='$usract', `tipo`='$usrti' WHERE `id`= $idu";
mysqli_query($con, $query); 
if ($usrco!='') {
	$query = "UPDATE `usuarios` SET `contrasena`='$ncont' WHERE `id`= $idu";
	mysqli_query($con, $query);
?><script type="text/javascript">swal("Todo listo!", "Usuario Actualizado!", "success");</script><?php 
}

?>
<script type="text/javascript">
	$('#exampleModal').modal('toggle');
	setTimeout ("iniconfig();", 500); 
</script>
