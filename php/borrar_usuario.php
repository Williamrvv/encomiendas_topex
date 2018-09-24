<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$idu=$_POST['idu'];

if ($idu==2) {
	?><script type="text/javascript">
		swal("Error!", "No puedes borrar al desarrollador ;)", "error");
	</script><?php die();
}


$query = "UPDATE `usuarios` SET `status`=0 WHERE `id` = $idu";
mysqli_query($con, $query); 
$query = "UPDATE `mensajeros` SET `status`=0 WHERE `id` = $idu";
mysqli_query($con, $query); 

$consulta = "SELECT `idmensajero` FROM `usuarios` WHERE `id` = $idu";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
        $query = "UPDATE `mensajeros` SET `status`=0 WHERE `id` = $fila[0]";
		mysqli_query($con, $query); 
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}
?>
<script type="text/javascript">
	setTimeout ("iniconfig();", 500); 
</script>