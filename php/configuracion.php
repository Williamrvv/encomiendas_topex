<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];

?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-hands-helping"></i> Clientes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-users-cog"></i> Usuarios y mensajeros</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-truck"></i> Encomiendas</a>
  </li>
</ul>
		<hr />
<div class="tab-content" id="pills-tabContent">
<!----------------------------------clientes---------------------------------->
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  	<form class="form-inline" id="cliente">
		  <div class="form-group mb-2">
		    <label for="staticEmail2" class="sr-only">Buscar cliente</label>
		    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Buscar cliente:">
		  </div>
		  <div class="form-group mx-sm-3 mb-2">
		    <label for="inputPassword2" class="sr-only">Cliente</label>
		    <input type="text" class="form-control" placeholder="Nombre de cliente" id="client" name="cliente">
		  </div>
		  <button type="button" class="btn btn-primary mb-2" onclick="buscar_cliente()"><i class="fas fa-search"></i> Buscar</button>
		</form>
		<div id="buscar_cliente"></div>
		<div class="row">
				<div class="col-2"><label for="exampleInputEmail1">Agregar Cliente nuevo:</label></div>
				<div class="col-2"><input type="text" class="form-control" id="clientn" placeholder="Nombre de cliente nuevo"></div>
				<div class="col-2"> <button type="button" class="btn btn-primary mb-2" onclick="agregar();return false;"><i class="fas fa-user-plus"></i> Agregar</button></div>
  	</div>
  	<div id="cnuew"></div>
  </div>
<!-------------------------------------usuarios----------------------------------->
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
<form id="usuarios">
  	<div class="row">
	    <div class="col-sm"><button type="button" class="btn btn-outline-primary"  data-toggle="modal" data-target="#exampleModal" onclick="act_usr()">Actualizar</button></div>
	    <div class="col-sm"><button type="button" class="btn btn-outline-primary"  data-toggle="modal" data-target="#exampleModal" onclick="agr_usr()">Agregar</button></div>
	    <div class="col-sm"><button type="button" class="btn btn-outline-primary" onclick="bor_usr()">Borrar</button></div>
	  </div>
	  <br>
  	<table class="table">
			<thead class="thead-dark">
			  <tr>
			    <th scope="col">Seleccionar</th>
			    <th scope="col">Usuario</th>
			    <th scope="col">Tipo</th>
			  </tr>
			</thead>
			<tbody>
				<?php 
					$consulta = "SELECT `id`,`nombre`, 
											CASE
											    WHEN `tipo` = 'root' THEN 'Administrador'
											    WHEN `tipo` = 'mensajero' THEN 'Mensajero'
											    WHEN `tipo` = 'operario' THEN 'Operario'
											END AS 'tipo'
											FROM usuarios WHERE `status`= 1";
						if ($resultado = $con->query($consulta)) {
						    while ($fila = $resultado->fetch_row()) {
						    ?>
						    	<tr>
						    		<td>
						    			<div class="form-check">
											  <input class="form-check-input" type="radio" name="idu" value="<?php echo $fila[0]; ?>" checked>
											</div>
										</td>
										<td><?php echo $fila[1]; ?></td>
										<td><?php echo $fila[2]; ?></td>
						    	</tr>
						    <?php
						    }
						    /* liberar el conjunto de resultados */
						    $resultado->close();
						}
				?>
			</tbody>
		</table>
  	<div id="usrmod"></div>
  </div>
</form>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
  	<h3>Forzar encomienda recibida</h3>
  		<div class="row">
		  <div class="form-group col-6">
		    <label for="exampleInputEmail1">Número de guía:</label>
		    <input type="text" class="form-control" id="ndoc" aria-describedby="emailHelp" placeholder="N° guía">
		    <small id="emailHelp" class="form-text text-muted">Ingresa el número de guía de la encomienda.</small>
		  </div>
		  <div class="form-group col-6"><br><button class="btn btn-primary" onclick="forzenc($('#ndoc').val());return false;">Buscar</button></div>
		  </div>
		  <div class="row">
		  	<div id="fencomienda"></div>
		  </div>
		<div class="row">
		  <div class="form-group col-6">
		    <label for="exampleInputEmail1">Nuevo transporte de encomienda:</label>
		    <input type="text" class="form-control" id="ntransport" aria-describedby="emailHelp" placeholder="Empresa">
		    <small id="emailHelp" class="form-text text-muted">Ingresa la nueva empresa de transportes.</small>
		  </div>
		  <div class="form-group col-6"><br><button class="btn btn-primary" onclick="newtransp($('#ntransport').val());return false;">agregar</button></div>
		</div>
  </div>
</div>

<!--busacr cliente-->
<script type="text/javascript">
  $('#client').autoComplete({
    minChars: 2,
    source: function(term, suggest){
      term = term.toLowerCase();
      var choices = ['ActionScript'<?php 
          $consulta = "SELECT `Cliente` FROM perdidas.`clientes` WHERE status=1";
          if ($resultado = $con->query($consulta)) {
              while ($fila = $resultado->fetch_row()) {
                echo ",'$fila[0]'";
              }
              /* liberar el conjunto de resultados */
              $resultado->close();
          }
       ?> ];
      var matches = [];
      for (i=0; i<choices.length; i++)
      if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
      suggest(matches);
    }
  });
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal_usr">

<div></div>

    </div>
  </div>
</div>