	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

	<script type="text/javascript">	
		var gerencias = [{'id_gerencia':'1','gerencia':'GERENCIA DE GESTION INTERNA'},
						[{'id_gerencia':'2','gerencia':'GERENCIA DE OPERECIONES'},
						[{'id_gerencia':'3','gerencia':'GERENCIA GENERAL'},
						[{'id_gerencia':'4','gerencia':'PRESIDENCIA'}];

		var coordinaciones = [{'id_coordinaciones':'GERENCIA DE GESTION INTERNA','id_gerencia':'1','coordinacion':'GERENCIA DE GESTION INTERNA'},
		{'id_coordinaciones':'PLANIFICACION Y PRESUPUESTO','id_gerencia':'1','coordinacion':'PLANIFICACION Y PRESUPUESTO'},
		{'id_coordinaciones':'SERVICIOS GENERALES','id_gerencia':'1','coordinacion':'SERVICIOS GENERALES'},
		{'id_coordinaciones':'RECURSOS HUMANOS','id_gerencia':'1','coordinacion':'RECURSOS HUMANOS'},
		{'id_coordinaciones':'ADMIN Y FINANZAS','id_gerencia':'1','coordinacion':'ADMIN Y FINANZAS'},
		{'id_coordinaciones':'TECNOLOGIA','id_gerencia':'1','coordinacion':'TECNOLOGIA'},
		{'id_coordinaciones':'GERENCIA DE OPERECIONES','id_gerencia':'2','coordinacion':'GERENCIA DE OPERECIONES'},
		{'id_coordinaciones':'ING. Y TRANSMISIONES','id_gerencia':'2','coordinacion':'ING. Y TRANSMISIONES'},
		{'id_coordinaciones':'INFORMACION Y OPINION','id_gerencia':'2','coordinacion':'INFORMACION Y OPINION'},
		{'id_coordinaciones':'IMAGEN Y PROMOCIONES','id_gerencia':'2','coordinacion':'IMAGEN Y PROMOCIONES'},
		{'id_coordinaciones':'PRODUCCION','id_gerencia':'2','coordinacion':'PRODUCCION'},
		{'id_coordinaciones':'PRODUCCIONES','id_gerencia':'2','coordinacion':'PRODUCCIONES'},
		{'id_coordinaciones':'PROGRAMACION','id_gerencia':'2','coordinacion':'PROGRAMACION'},
		{'id_coordinaciones':'GERENCIA GENERAL','id_gerencia':'3','coordinacion':'GERENCIA GENERAL'},
		{'id_coordinaciones':'RELACIONES INSTITUCIONALES','id_gerencia':'3','coordinacion':'RELACIONES INSTITUCIONALES'},
		{'id_coordinaciones':'PRESIDENCIA','id_gerencia':'4','coordinacion':'PRESIDENCIA'}];

		
	$(document).ready(function() {
		var sgerencias = '<option value=""></option>';
		$(gerencias).each(function(i){
			sgerencias += '<option value="'+this.id_gerencia+'">'+this.gerencia+'</option>';
		});
		$('#gerencias').html(sgerencias);
		$('#gerencias').change(function(){ // evento que al ser modificado el select gerencias es llamado
			var gerencia = $('#gerencias').val(); //obtenemos la gerencia seleccionada
			var pcoordinaciones = $.grep(coordinaciones,function(n,i){return (n.id_gerencia == gerencia); }); //filtramos por gerencia
			var scoordinaciones = '<option value=""></option>';
			$(pcoordinaciones).each(function(i){ //recorremos cada uno de las coordinaciones previamente filtrados
				scoordinaciones += '<option value="'+this.id_coordinaciones+'">'+this.coordinacion+'</option>'; //vamos  creando el select
			});


			$('#gerencias').html(scoordinaciones); //el html generado se asigna al select de coordinaciones
			
		});
		
	});
	</script>
