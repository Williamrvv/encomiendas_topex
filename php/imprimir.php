<?php require_once("conn.php");
session_start();
?>
<!doctype html>
<html lang="es">
  <head>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!--fonts-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <title>Encomiendas Topex </title>
  </head>
<SCRIPT language="javascript"> 
  function imprimir() { 
    if ((navigator.appName == "Netscape")) { window.print() ; 
      } 
      else { var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>'; 
      document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, -1); WebBrowser1.outerHTML = ""; 
      } 
    } 
</SCRIPT> 

  <body onload="imprimir();redirect();">
    <div class="container-fluid">
      <img src="../logo.png" style="float: left;width: 150px;">
      <center><h2>Encomiendas Topex Para Retirar</h2></center>
      <table class="table">

        <tbody>
<?php 
$consulta = "SELECT DISTINCT(transportes.nombre) FROM 
            `documentos` 
            LEFT JOIN transportes ON documentos.idtransporte= transportes.id
            WHERE documentos.status='pendiente'";
if ($resultado = $con->query($consulta)) {
    while ($tpt = $resultado->fetch_row()) {
        ?><tr><th colspan="7"  class="table-primary"><br><center><u><?php echo "$tpt[0]"; ?></u></center></th></tr>
          <tr>
            <th scope="col">Documento</th>
            <th scope="col">N° de Guía</th>
            <th scope="col">Cantidad de ordenes</th>
            <th scope="col">Cliente</th>
            <th scope="col">Fecha</th>
            <th scope="col">Recibido</th>
          </tr>
        <?php 
         
        $consulta = "SELECT documentos.id,`guia`,`cant_ordenes`,perdidas.clientes.Cliente, `fecha`
            FROM 
            `documentos` 
            LEFT JOIN transportes ON documentos.idtransporte= transportes.id
            LEFT JOIN perdidas.clientes ON documentos.`idcliente`= perdidas.clientes.id
            WHERE 
            documentos.`status` ='pendiente' and transportes.nombre='$tpt[0]'
            ORDER BY fecha ASC";
        if ($resultado1 = $con->query($consulta)) {
            while ($fila = $resultado1->fetch_row()) {
              echo "<tr>
                <th scope='row'>$fila[0]</th>
                <td>$fila[1]</td>
                <td>$fila[2]</td>
                <td>$fila[3]</td>
                <td>$fila[4]</td>
                <td><i class='far fa-square' style='font-size: 30px;'></i><td>
              </tr>"; 
            }

        }

    }
    /* liberar el conjunto de resultados */
  $resultado->close();
}
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  function redirect(){
      //window.location.href = "../";
    window.close();
  }
</script>
  </body>
</html>