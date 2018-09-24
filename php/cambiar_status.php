<?php 
require_once("conn.php");
session_start();
$usrid=$_SESSION['id'];
$iddocum=$_POST['iddocum'];
$numguia=$_POST['numguia'];

$consulta = "SELECT COUNT(*) FROM `ordenes` WHERE `iddocumentos`=$iddocum";
if ($resultado = $con->query($consulta)) {
    $cantidad = $resultado->fetch_row();
    /* liberar el conjunto de resultados */
    $resultado->close();
}
$query = "UPDATE `documentos` SET `status`='Recibido',`usr_recibe`=$usrid,`fecha_recibe`='$fecha',`hora_recibe`='$hora',`cant_ordenes`=$cantidad[0] WHERE `id`= $iddocum";
	mysqli_query($con, $query);

$query = "UPDATE `ordenes` SET `status`=1 WHERE `iddocumentos`= $iddocum";
	mysqli_query($con, $query);
?>
<script>swal("Listo", "Recibida la encomienda <?php echo $numguia ?> con <?php echo $cantidad[0] ?> de ordenes", "success");</script>
