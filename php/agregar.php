<script type="text/javascript">
function  enviar_form(){
document.crear_encomienda.submit();
$( "#crear_documento" ).submit();
}
</script>
<div onclick=""></div>
<?php 
require_once("conn.php");
session_start();
$usuario=$_SESSION['id'];
$cliente=$_POST['client'];
$cant_ordenes=$_POST['cant_ordenes'];
$encomienda=$_POST['encomienda'];
$transporte=$_POST['transporte'];
$notificacion=$_POST['notificacion'];
$id=time();
echo "<br>";

$consulta = "SELECT COUNT(`guia`) FROM `documentos` WHERE `guia`='$encomienda'";
if ($resultado = $con->query($consulta)) {
	$fila = $resultado->fetch_row(); 
		if ($fila[0]=='1') {
			echo '<script>swal("Error", "El número de encomienda ya fue ingresado", "error");</script>';die();
		}}

if ($cant_ordenes=='') {
$cant_ordenes='1';
}
if ($encomienda=='') {
echo '<div class="alert alert-warning alert-dismissible fade show" role="alert onload="$( "#crear_documento" ).submit();">
 No haz ingresado el número de encomienda
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

}
if ($transporte=='') {
echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
 No haz seleccionado el medio de transporte
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if ($cliente=='') {
echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
 No haz ingresado el cliente
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';die();
}
$consulta = "SELECT `id` FROM perdidas.`clientes` WHERE status=1 and cliente='$cliente'";
if ($resultado = $con->query($consulta)) {
	$fila = $resultado->fetch_row(); 
		if ($fila[0]=='') {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			 Por favor corrige el nombre del cliente
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>';die();
		}else{
			$cliente=$fila[0];
		}
	/* liberar el conjunto de resultados */
	$resultado->close();
}

if ($cliente!='' and $encomienda!='' and $transporte!='') {
	$query = "INSERT INTO `documentos`(`id`,`fecha`, `hora`, `idcliente`, `cant_ordenes`, `guia`, `idtransporte`, `usuario`, `notificacion`) VALUES ($id,'$fecha','$hora',$cliente,$cant_ordenes,'$encomienda',$transporte,$usuario,'$notificacion')";
	mysqli_query($con, $query);

	?>
	<script>swal("Listo", "Se ha creado la encomienda", "success");
	$("#crear_documento")[0].reset();
	</script>
	<?php 
}
 ?>