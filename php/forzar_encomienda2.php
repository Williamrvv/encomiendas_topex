<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$bfe=$_POST['bfe'];
$motivoforz=$_POST['motivoforz'];
$iddo=$_POST['iddo'];
 if ($motivoforz=='') {
 	?><p style="color:red;">Debes describir el motivo por el que se forzará la encomienda en la caja de texto</p><script type="text/javascript">$( "#motivoforz" ).focus();</script><?php die(); 
 }

$query ="UPDATE `documentos` SET `status`='Recibido',`usr_recibe`=$usr,`fecha_recibe`='$fecha',`hora_recibe`='$hora',`forzada`='$motivoforz' WHERE `id` = '$iddo'";
mysqli_query($con, $query); 
?>

<script type="text/javascript">
	swal("Encomienda recibida!", "Se forzó el status de la encomienda a recibido", "success");
	iniconfig();
</script>