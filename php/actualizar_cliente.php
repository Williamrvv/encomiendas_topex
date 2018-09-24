<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$clinew=$_POST['clinew'];
$cliold=$_POST['cliold'];
$idcliente=$_POST['idcliente'];

$query = "UPDATE perdidas.`clientes` SET `Cliente`= '$clinew' WHERE `Cliente`='$cliold' AND id=$idcliente";
		mysqli_query($con, $query);
?>

<script type="text/javascript">
swal({
  title: "Listo!",
  text: "Se actualizó el nombre del cliente '<?php echo $cliold ?>' por '<?php echo $clinew ?>'!",
  icon: "success",
  button: "Aceptar!",
});
</script>