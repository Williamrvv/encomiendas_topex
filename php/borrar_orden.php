<?php 
require_once("conn.php");
$borrar=$_POST['borrar'];
$query = "DELETE FROM `ordenes` WHERE `id`= $borrar";
	mysqli_query($con, $query);
?>

<script type="text/javascript">
	agregar_orden();
</script>