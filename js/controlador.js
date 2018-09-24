/*menú lateral---------------------*/
function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
	document.getElementById("main").style.marginLeft = "250px";
	document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
	document.getElementById("main").style.marginLeft= "0";
	document.body.style.backgroundColor = "white";
}


function comprueba(cliente){
  var parametros = {
          "client" : cliente,
  };
  $.ajax({
          data:  parametros, 
          url:   'php/comprobar_cliente.php', 
          type:  'post', 
          success:  function (response) {
            $("#Help").html(response);
          }
  });
}
/*-------------------acciona el boton del menú configuración---------------------------*/
function iniconfig(){
	var url = "php/configuracion.php"; 
	$.ajax({                        
	   type: "POST",                 
	   url: url,                    
	   data: $("#menuu").serialize(),
	   beforeSend: function () {
	    	closeNav();
	        $("#cuerpo").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor..."); 
	    },
	   success: function(data)            
	   {
	    	$('#cuerpo').html(data);
	    	most_lista();
	   },
	   error: function (xhr, ajaxOptions, thrownError) {
        $("#cuerpo").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
        closeNav();
      }
	});
}

/*-------------------acciona el boton del menú encomiendas---------------------------*/
function inicmensajero(){
	var url = "php/encomiendas.php"; 
	$.ajax({                        
	   type: "POST",                 
	   url: url,                    
	   data: $("#menuu").serialize(),
	   beforeSend: function () {
	    	closeNav();
	        $("#cuerpo").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor..."); 
	    },
	   success: function(data)            
	   {
	    	$('#cuerpo').html(data);
	    	most_lista();
	   },
	   error: function (xhr, ajaxOptions, thrownError) {
        $("#cuerpo").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
        closeNav();
      }
	});
}


/*-------------------acciona el boton del menú inicio---------------------------*/
function inic(){
	var url = "php/inicio.php"; 
	$.ajax({                        
		type: "POST",                 
		url: url,                    
		data: $("#menuu").serialize(),
		beforeSend: function () {
			closeNav();  
			$("#cuerpo").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor..."); 
		},
		success: function(data)            
		{
			$('#cuerpo').html(data);
			/*--------------funcion crear----------------------*/
			$('#crear').click(function inic(){
				crear_document();
			});
		},
	   error: function (xhr, ajaxOptions, thrownError) {
        $("#cuerpo").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
        closeNav();
      }
	});
}
/*-----------------------Funcion para crear un documento de encomienda--------------------------------*/
function crear_document(){
	var url = "php/agregar.php"; 
	$.ajax({                        
	   type: "POST",                 
	   url: url,                    
	   data: $("#crear_documento").serialize(),
	   beforeSend: function () {
	        $("#resp").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor..."); 
	    },
	   success: function(data)            
	   {
	    	$('#resp').html(data);
	   },
	   error: function (xhr, ajaxOptions, thrownError) {
        $("#resp").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
      }
	});
}
/*-------------------Mostrar Lista de encomiendas pendientes---------------------------*/
function most_lista(){
	var url = "php/lista_encomiendas.php"; 
	$.ajax({                        
		type: "POST",                 
		url: url,                    
		data: $("#recibir").serialize(),
		beforeSend: function () {
			//$("#lista").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor..."); 
		},
		success: function(data)            
		{
			$('#lista').html(data);
			closeNav();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			$("#lista").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
			closeNav();
		}
	});
}
/*-------------------FIN Mostrar Lista de encomiendas pendientes---------------------------*/
/*-------------------Mostrar Lista de encomiendas recibidas---------------------------*/
function ver_rec(){
	var url = "php/lista_recibidas.php"; 
	$.ajax({                        
		type: "POST",                 
		url: url,                    
		data: $("#lista_recibido").serialize(),
		beforeSend: function () {
			$("#lista_rec").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor..."); 
		},
		success: function(data)            
		{
			$('#lista_rec').html(data);
			closeNav();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			$("#lista_rec").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
			closeNav();
		}
	});
}
/*--------------------buscar encomienda------------------*/
function buscar(buscar){
	var parametros={
		"buscar" : buscar
	}
	var url = "php/buscar_enc.php"; 
	$.ajax({                        
		type: "POST",                 
		url: url,                    
		data: parametros,
		beforeSend: function () {
			$("#lista_rec").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor..."); 
		},
		success: function(data)            
		{
			$('#lista_rec').html(data);
			closeNav();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			$("#lista_rec").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
			closeNav();
		}
	});
}


/*-------------------función muestra el MODAL de cada encomienda pendiente con info---------------------------*/
function lista_temp(iddoc,optica,guia){
	var parametros = {
	        "iddoc" : iddoc,
	        "optica" : optica,
	        "guia" : guia
	};
	$.ajax({
	        data:  parametros, //datos que se envian a traves de ajax
	        url:   'php/lista_ordenes.php', //archivo que recibe la peticion
	        type:  'post', //método de envio
	        beforeSend: function () {
	                $("#tramitar").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor...");
	        },
	        success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
	                $("#tramitar").html(response);
	                agregar_orden();
	                $('#n_orden').keyup(function (e) {
					  if(e.keyCode == 13) {
	                agregar_orden();
					  }
					});
	        },
	        error: function (xhr, ajaxOptions, thrownError) {
		$("#tramitar").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
	}
	});
}

/*-------------------Agregar orden en lista temporal---------------------------*/
function agregar_orden(){
var url = "php/agregar_ordenes.php"; 
$.ajax({                        
	type: "POST",                 
	url: url,                    
	data: $("#ingresar_ordn").serialize(),
	success: function(data)            
	{
		$('#listorder').html(data);
	},
	error: function (xhr, ajaxOptions, thrownError) {
		$("#listorder").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
	}
});
}

/*-------------------Borrar orden de lista temporal---------------------------*/
function borrar_orden(borrar){
	var parametros = {
		"borrar" : borrar
	};
	$.ajax({
            data:  parametros, //datos que se envian a traves de ajax
            url:   'php/borrar_orden.php', //archivo que recibe la peticion
            type:  'post', //método de envio
            beforeSend: function () {
            	$("#borrar").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor...");
            },
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            	$("#borrar").html(response);
            },
			error: function (xhr, ajaxOptions, thrownError) {
				$("#listorder").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
			}
          });
}

/*---------------------------Cambiar de status el documento---------------------------*/
function encom_recib(iddocum,numguia){
        var parametro = {
                "iddocum" : iddocum,
                "numguia"    : numguia
        };
        $.ajax({
                data:  parametro, //datos que se envian a traves de ajax
                url:   'php/cambiar_status.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#cambiar_status").html("Cambiando de Status la encomienda...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#cambiar_status").html(response);
                        
                        $('#modal').modal('toggle');
                        setTimeout ("most_lista();", 500); 
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  $("#tramitar").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
                }
        });
}
/*----------------------------------Obtener info de encomienda recibida en modal----------------------------------------------*/
function info_encomienda_recibida(documentoid,clientenomb,statusenc,nguia){
    var parametros = {
            "documentoid" : documentoid,
            "clientenomb" : clientenomb,
            "statusenc"   : statusenc,
            "nguia"       : nguia
    };
    $.ajax({
            data:  parametros, //datos que se envian a traves de ajax
            url:   'php/info_encomienda_recibida.php', //archivo que recibe la peticion
            type:  'post', //método de envio
            beforeSend: function () {
                    $("#info").html("<img src='cargando.gif' alt='Cargando...' width='100' height='100'>   Cargando, espere por favor...");
            },
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#info").html(response);
            }
    });
}


/*------------------------------------------------configuación------------------------------------------------------------------*/
/*----------------------------------buscar cliente----------------------------------------------*/
function buscar_cliente(){
var url = "php/clientes.php"; 
$.ajax({                        
	type: "POST",                 
	url: url,                    
	data: $("#cliente").serialize(),
	success: function(data)            
	{
		$('#buscar_cliente').html(data);
	},
	error: function (xhr, ajaxOptions, thrownError) {
		$("#buscar_cliente").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
	}
});
}

/*---------------------------Actualizar cliente---------------------------*/
function actualizarc(){
	swal({
	  title: "Se va a actualizar el nombre del cliente",
	  text: "Tenga en cuenta que esta lista también afecta a los clientes de perdidas!",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	actual_cliente();
	  } else {
	    //swal("Your imaginary file is safe!");
	  }
	});
}
function actual_cliente(){

    $.ajax({
            data:  $("#actual_cliente").serialize(),
            url:   'php/actualizar_cliente.php', //archivo que recibe la peticion
            type:  'post', //método de envio
            beforeSend: function () {
                    $("#clientnew").html("Actuializando cliente, espere por favor...");
            },
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#clientnew").html(response);
            },
	error: function (xhr, ajaxOptions, thrownError) {
		$("#clientnew").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
	}
    });
}

/*-------------------agregar cliente nuevo---------------------------*/
function agregar(){
	swal({
	  title: "Seguro que desea agregar el cliente nuevo",
	  text: "Tenga en cuenta que esta lista también afecta a los clientes de perdidas!",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	clinew($('#clientn').val());
	  } else {
	    //swal("Your imaginary file is safe!");
	  }
	});
}
function clinew(cn){
	var parametros = {
		"cn" : cn
	};
	$.ajax({
    data:  parametros, //datos que se envian a traves de ajax
    url:   'php/cliente_nuevo.php', //archivo que recibe la peticion
    type:  'post', //método de envio
    beforeSend: function () {
    	$("#cnuew").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor...");
    },
    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
    	$("#cnuew").html(response);
    },
    error: function (xhr, ajaxOptions, thrownError) {
    	$("#cnuew").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
    }
});
}

/*----------------------agregar usuario nuevo-------------------------------------*/
function agr_usr(){
    $.ajax({
        data:  $("#usuarios").serialize(),
        url:   'php/usuario_nuevo.php', //archivo que recibe la peticion
        type:  'post', //método de envio
        beforeSend: function () {
                $("#modal_usr").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor...");
        },
        success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                $("#modal_usr").html(response);
        },
		error: function (xhr, ajaxOptions, thrownError) {
			$("#modal_usr").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
		}
    });
}

function unu(usrn, usrc, usrt){
        var parametros = {
                "usrn" : usrn,
                "usrt" : usrt,
                "usrc" : usrc
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/agregar_usuario.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#usrmod").html("<img src='cargando.gif' alt='Cargando...' width='100' height='100'>  Creando cliente, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#usrmod").html(response);
                },
				error: function (xhr, ajaxOptions, thrownError) {
					$("#usrmod").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
				}
        });
}


/*----------------------Desactivar usuario-------------------------------------*/
function bor_usr(){
	swal({
	  title: "Desea borrar el usuario?",
	  text: "Una vez borrado no se podrá revertir!",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	borrar();
	    swal("Listo! Usuario borrado", {
	      icon: "success",
	    });
	  } else {
	    //swal("Your imaginary file is safe!");
	  }
	});
}

function borrar(){
    $.ajax({
        data:  $("#usuarios").serialize(),
        url:   'php/borrar_usuario.php', //archivo que recibe la peticion
        type:  'post', //método de envio
        beforeSend: function () {
                $("#usrmod").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor...");
        },
        success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                $("#usrmod").html(response);
        },
		error: function (xhr, ajaxOptions, thrownError) {
			$("#usrmod").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
		}
    });
}

/*----------------------Actualizar usuario-------------------------------------*/
function act_usr(){
    $.ajax({
        data:  $("#usuarios").serialize(),
        url:   'php/actualizar_usuario.php', //archivo que recibe la peticion
        type:  'post', //método de envio
        beforeSend: function () {
                $("#modal_usr").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor...");
        },
        success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                $("#modal_usr").html(response);
        },
		error: function (xhr, ajaxOptions, thrownError) {
			$("#modal_usr").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
		}
    });
}

function act_usr2(){
    $.ajax({
        data:  $("#actualizarusr").serialize(),
        url:   'php/act_usr.php', //archivo que recibe la peticion
        type:  'post', //método de envio
        beforeSend: function () {
                $("#usrmod").html("<img src='cargando.gif' alt='Cargando, espera por favor...' width='100' height='100'>   Cargando, espere por favor...");
        },
        success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                $("#usrmod").html(response);
        },
		error: function (xhr, ajaxOptions, thrownError) {
			$("#usrmod").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
		}
    });
}

/*---------------------------forzar una encomienda recibida------------------------------*/
function forzenc(ndoc){
        var parametros = {
                "ndoc" : ndoc
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/forzar_encomienda.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#fencomienda").html("<img src='cargando.gif' alt='Cargando...' width='100' height='100'> cargando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#fencomienda").html(response);
                },
				error: function (xhr, ajaxOptions, thrownError) {
					$("#fencomienda").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
				}
        });
}
function btnfe(bfe,motivoforz,iddo){
        var parametros = {
            "bfe" : bfe,
            "motivoforz" : motivoforz,
            "iddo" : iddo
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/forzar_encomienda2.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#forzada").html("<img src='cargando.gif' alt='Cargando...' width='100' height='100'>  Forzando encomienda, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#forzada").html(response);
                },
				error: function (xhr, ajaxOptions, thrownError) {
					$("#forzada").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
				}
        });
}

/*---------------------------Agrtegar nuevo transporte------------------------------*/
function newtransp(ntransport){
        var parametros = {
                "ntransport" : ntransport
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/nuevo_transporte.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#fencomienda").html("<img src='cargando.gif' alt='Cargando...' width='100' height='100'>  Creando empresa de tarsnporte, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#fencomienda").html(response);
                },
				error: function (xhr, ajaxOptions, thrownError) {
					$("#fencomienda").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
				}
        });
}