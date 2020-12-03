(function(e){
$("#TableData").DataTable(
{
"language": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
});

    $(".DataTableClase").DataTable(
        {
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

$(document).on('click', '.Eliminar',function (e) {
    var username = $(this).attr("rel");
    //alert(username);
    var modulo = $(this).attr("module");
              swal({
                  title: "¿Estás seguro?",
                  text: "¡No podrás recuperar este registro!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Sí, eliminarlo!",
                  cancelButtonText: "No, cancela plx!",
                  closeOnConfirm: false,
                  closeOnCancel: false
              }, function(isConfirm) {
                  if (isConfirm) {
                    //AJAX
                    $.ajax({
                    type: "POST",
                    url: "frontend/Usuario/Action.php",
                    dataType:"html",
                    cache:false,
                    data: {username: username, modulo: modulo, MM_Delete: "Eliminar"},
                    success: function(response) {
                    if(response == 1){
                        $('#order'+username).fadeOut("slow");
                        swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success");
                    }else{
                        swal("Oops algo salio mal!", "El registro no ha sido eliminado.", "error");
                    }			
                    }
                    });
                    return false;
                  } else {
                      swal("Cancelado", "Tu registro está seguro :)", "error");
                  }
              });
});

$(document).on('click', '.Estado',function (e) {
	//Datos
	var modulo = $(this).attr("module");
	var username = $(this).attr("rel");
	var state = ($(event.target).is(":checked")) ? 1 : 0;
	$.ajax({
	type:"POST",
	url: "frontend/Usuario/Action.php",
	dataType:"html",
	cache: false,
	data: {username: username, state: state, modulo: modulo, MM_Update: "Estado"},
	beforeSend: function(){
	},
	success: function(response){
        if(response == 1)
        {
            //swal("Eliminado!", "Se cambio de estado", "success");
        }
        else{
            swal("Upps!", "Cuenta no cumple los requisitos", "error");	
        }
	}
	});
});

})(jQuery)
