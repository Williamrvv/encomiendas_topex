var $btn = document.getElementById("submit");
var $form = document.getElementById("form");

$('#submit').click(function(){
var url = "../php/login.php";
  $.ajax({                        
     type: "POST",                 
     url: url,                    
     data: $("#form").serialize(),
     beforeSend: function () {
              //$("#resp").html("<img src='cargando.gif' alt='Cargando la consulta, espera por favor...' width='80' height='80'>   Cargando la consulta, espere por favor...");
          },
     success: function(data)            
     {
       $('#resp').html(data);  
       //alert('seleccionaste '+ind);         
     }
  });
});

$(window).bind('keydown', function(e) {            
  if (e.charCode == 13 || e.keyCode == 13) {
    var url = "../php/login.php";
    $.ajax({                        
       type: "POST",                 
       url: url,                    
       data: $("#form").serialize(),
       beforeSend: function () {
                //$("#resp").html("<img src='cargando.gif' alt='Cargando la consulta, espera por favor...' width='80' height='80'>   Cargando la consulta, espere por favor...");
            },
       success: function(data)            
       {
         $('#resp').html(data);  
         //alert('seleccionaste '+ind);         
       }
    });
  }    
});
