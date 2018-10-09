<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Prueba codeigniter</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<form>
	<label for="txtrut">Rut</label>
	<input type="text" id="txtrut" name="txtrut">
	<label for="txtnombre">Nombre</label>
	<input type="text" id="txtnombre"name="txtnombre">
	<button id="btnguardar">Guardar</button>
	<button class="btn btn-primary">Exportar a excel</button>
</form>
<div id="div_contenedor">
	
</div>


<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		cargar_tabla();

		//funcion guardar

		$('#btnguardar').click(function(e){
			e.preventDefault();
			var rut = $('#txtrut').val();
			var nombre = $('#txtnombre').val();
			
			$.ajax({
				url: '<?php base_url();?>ctr_cliente/guardar',
				type: 'POST',
				data: {'rut': rut,'nombre': nombre},
				success: function (data) {
					//alert(""+data);
				},
        		error: function (jqXHR, textStatus, errorThrown) { 
        			
        		},
        		complete : function (xhr, status){
        			//alert(xhr.responseText);
        			cargar_tabla();

        		}
			});
		  
		});
		// fin funcion guardar

		//funcion eliminar
		$('html').on("click",".btn_eliminar",function(e){
			e.preventDefault();
			
			$.ajax({
				url: '<?php base_url();?>ctr_cliente/eliminar',
				type: 'POST',
				data: {'id': this.id},
				success: function (data) {
					//alert(""+data);
				},
        		error: function (jqXHR, textStatus, errorThrown) { 
        			
        		},
        		complete : function (xhr, status){
        			cargar_tabla();
        		}
			});
			
		});
		//fin eliminar

		$('html').on("click",".btnmodificar",function(e){
			e.preventDefault();
			
			$.ajax({
				url: '<?php base_url();?>ctr_cliente/modificar',
				type: 'POST',
				data: {'id': this.id},
				success: function (data) {
					//alert(""+data);
				},
        		error: function (jqXHR, textStatus, errorThrown) { 
        			
        		},
        		complete : function (xhr, status){
        			cargar_tabla();
        		}
			});
			
		});


		//funcion cargar tabla
		function cargar_tabla(){
			$.ajax({
				url: '<?php base_url();?>ctr_cliente/cargar_todo',
				type: 'POST',
				success: function (data) {
					var tabla = ""; 
					$('#div_contenedor').empty();
					tabla = "<table class='table'><thead class='thead'><tr><th>Rut</th><th>Nombre</th></tr></thead>";
					$.each(JSON.parse(data),function(index, obj) {
						//console.log(obj.nombre);
						tabla += "<tr><td>"+obj.rut+"</td><td>"+obj.nombre+"</td><td><button class='btn_eliminar btn btn-danger' id="+obj.id+" >eliminar</button><button class='btnmodificar btn btn-success' id="+obj.id+" >modificar</button></td></tr>";
					});
					tabla += "</table>";
					$('#div_contenedor').append(tabla);
				},
        		error: function (jqXHR, textStatus, errorThrown) { 
        			
        		}
			});
		}
		//fin funcion cargar tabla


	});
</script>
</html>