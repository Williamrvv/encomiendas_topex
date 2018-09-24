<?php 
require_once("conn.php");
$client=$_POST['client'];
if ($client=='') {
	echo "Utiliza el autocompletado para escribir el nombre del cliente más facil.";
	die();
}
$consulta = "SELECT `id` FROM perdidas.`clientes` WHERE status=1 and cliente='$client'";
if ($resultado = $con->query($consulta)) {
	$fila = $resultado->fetch_row(); 
		if ($fila[0]=='') {
			echo "<p style='color:red;'>No se encontró el cliente en la base de datos<p>";
		}
	/* liberar el conjunto de resultados */
	$resultado->close();
}
 ?>