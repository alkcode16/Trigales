aData = {};
	$( "#codigo" ).autocomplete({
      source: function(request, response) {
		$.ajax({
		  url: "./busqueda.php",
		  type: "GET",
		  dataType: "json",
		//   data: {
		// 	term : request.term
		//   },
		  success: function(data) {
			console.log(data);
			// response(data);
			aData = $.map(data, function(value, elemento){
				return{
					id: value.pastel,
					label: value.pastel
				};
			});
			console.log(aData);
			var resultados = $.ui.autocomplete.filter(aData, request.term);
			// response(resultados);
			response(resultados.slice(0, 5));
		  }
		});
	  },
    });
