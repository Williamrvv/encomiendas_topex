<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];

$ntransport=$_POST['ntransport'];

$consulta = "SELECT COUNT(`nombre`) FROM `transportes` WHERE `status` =1 AND `nombre` ='$ntransport'";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
         if ($fila[0]>=1) {
         	?><script type="text/javascript">swal("Atención!", "El medio de transporte ya existe!", "error");</script><?php die();
         }
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}

$query = "INSERT INTO `transportes`(`nombre`) VALUES ('$ntransport')";
	mysqli_query($con, $query);
	?><script type="text/javascript">swal("Todo listo!", "Nuevo transporte agregado!", "success");location.reload();</script><?php
?>