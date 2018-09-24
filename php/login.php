<?php  require_once("conn.php"); 

$usuario=$_POST['user'];
$usuario=sha1($usuario);


$consulta = "SELECT COUNT(`contrasena`) FROM `usuarios` WHERE `contrasena`='$usuario' and status=1";
if ($resultado = $con->query($consulta)) {
	while ($fila = $resultado->fetch_row()) {
		if ($fila[0]=='1') {

			session_start();
			$_SESSION['user']=$usuario;

			?><script type="text/javascript">
			  $btn.classList.add('pending');
    		window.setTimeout(function(){ $btn.classList.add('granted'); }, 1500);
    		window.setTimeout(function(){ location.href ="../"; }, 2500);
			</script><?php 
				  

		}if ($fila[0]=='0') {
			?><script type="text/javascript">
			  $btn.classList.add('pending');
			  window.setTimeout(function(){ $btn.classList.remove("pending");document.getElementById("resp").innerHTML = "<p style='color:red'><b>Usuario no econtrado</b></p>"; $("#form")[0].reset(); }, 1500);
			</script><?php 
		}
	}
	/* liberar el conjunto de resultados */
	$resultado->close();
}
?>


<script type="text/javascript">
$btn.addEventListener("click", signIn);
</script>