<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$cn=$_POST['cn'];
if ($cn=='') {
?>
	<script type="text/javascript">
swal("Debes escribir el nombre del cliente!");
	</script>
<?php die();
}

$query = "INSERT INTO perdidas.`clientes`(`Cliente`) VALUES ('$cn')";
		mysqli_query($con, $query);
?>
<script type="text/javascript">
swal({
  title: "Listo!",
  text: "Se agregó el cliente nuevo <?php echo $cn ?>!",
  icon: "success",
  button: "Aceptar!",
});
iniconfig();
</script>