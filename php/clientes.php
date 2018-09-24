<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$cliente=$_POST['cliente'];

$consulta = "SELECT `Cliente`, id FROM perdidas.`clientes` WHERE status=1 and cliente='$cliente'";
if ($resultado = $con->query($consulta)) {
	while ($fila = $resultado->fetch_row()) {
		if ($fila[0]=='') {
			echo "No se encontró el cliente";
		}
		?><div class="row">
				<div class="col-1"><input class="form-control" type="text" placeholder="<?php echo $fila[1] ?>" readonly></div>
		    <div class="col-2">
		    	<form id="actual_cliente"><input type="text" class="form-control" name="clinew" value="<?php echo $fila[0] ?>">
		    		<input type="hidden" name="cliold" value="<?php echo $cliente ?>">
		    		<input type="hidden" name="idcliente" value="<?php echo $fila[1] ?>"></form>
		    </div>
		    <div class="col-2">
					<input class="btn btn-primary" type="button" id="actualizar_cliente" onclick="actualizarc()" value="Actualizar nombre">
		    </div>
		  </div>
		  <div id="clientnew"></div><hr/><?php
	}
	/* liberar el conjunto de resultados */
	$resultado->close();
}
?>