@extends('layout.layoutConsultor')

@section('estilos')


<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">


<!-- Modal adminlte -->
<style>
  .modal-header {
      background-color: STEELBLUE;
      color:white !important;
      font-size: 40px;
  }

  .example-modal .modal {
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    display: block;
    z-index: 1;
  }

  .example-modal .modal {
    background: transparent !important;

  }
</style>
<!-- /.Modal adminlte -->

@stop

@section('encabezado')
<h1>
  Productos
  <small></small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
  <li class="active">Here</li>
</ol>
@stop

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

      @if($productos->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ningun producto registrado
      </div>
      @else
        @if(session('mensaje'))
          <div class="alert alert-success">
            <button tyoe="button" class="close"
            data-dismiss="alert"
            aria-hidden="true">x</button>
            {{ session('mensaje') }}
          </div>
        @endif

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">
          <thead>
          <tr>
            <th>#</th>
            <th>CodigoSunat</th>
            <th>Unidad Medida</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Categoria</th>
            <th>Fabricante</th>
            <th>Stock</th>
            <th>Estado</th>
            <th>StockMinimo</th>
            <th>Precio1</th>
            <th>Precio2</th>
            <th>Precio3</th>
            <th>Precio Referencial Compra</th>
            <th>Presentaciones</th>
          </tr>
          </thead>
        </table>
      @endif
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->






@stop

@section('js')

<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>


@stop

@section('jsope')


<!-- Responsive -->
<script>


var table = $('.tabla').DataTable({

  "sprocessing": true,
  "sserverSide": true,
  "ajax":"{{route('listarproductos')}}",
  "columns": [
      {"data" : "ID"},
      {"data" : "CodigoSunat"},
      {"data" : "UnidadMedida"},
      {"data" : "Nombre"},
      {"data" : "Descripcion"},
      {"data" : "Categoria"},
      {"data" : "Fabricante"},
      {
				 "defaultContent": '<div class="btn-group"><button class="btn btn-success btn-xs limiteStock"></button></div>'

			},
      {
        "defaultContent": '<button type="submit" disabled="" class="btn btn-xs btnActivar btn-default" idProducto estadoProducto data-token="{{ csrf_token() }}" </button>'

      },
      {"data" : "StockMinimo"},
      {"data" : "Precio1","sTitle":"Precio1", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ), name: 'Precio',visible:true },
      {"data" : "Precio2","sTitle":"Precio2", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ), name: 'Precio',visible:true },
      {"data" : "Precio3","sTitle":"Precio3", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ), name: 'Precio',visible:true },

      {"data" : "PrecioRefCompra","sTitle":"PrecioRefCompra", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ),visible:true },
      {
          "defaultContent": '<button type="button" class="btn btn-success verDerivado" >Ver Presentacion</button>'
      }

  ],
  "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningun dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Ultimo",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }

})
</script>


<script>


$('.tabla').on( 'draw.dt', function () {

  var table = $('.tabla').DataTable();
  //alert( table.data().rows().count());

  //var data = table.row( $(this).parents('tr') ).data();

  var limiteStock = $(".limiteStock");
  var activar = $(".btnActivar");
  //var agregar =$(".verDerivado");

  for(var i = 0; i < limiteStock.length; i ++){


     var data = table.row( $(limiteStock[i]).parents('tr') ).data();

     //alert(data['ID']);

     //$(agregar[i]).attr("onclick","location.href='productos/"+data['ID']+"'");

     //alert(data['StockMinimo']);
     if(data['Stock'] <= data['StockMinimo']){

       $(limiteStock[i]).removeClass('btn-success btn-xs');
       $(limiteStock[i]).addClass("btn-danger btn-xs");
       $(limiteStock[i]).html(data['Stock']);

     }else{

       $(limiteStock[i]).removeClass('btn-success btn-xs');

       $(limiteStock[i]).addClass("btn-success btn-xs");
       $(limiteStock[i]).html(data['Stock']);
     }
     if(data['Estado']==0)
     {

       $(activar[i]).removeClass('btn-default btn-xs');
       $(activar[i]).addClass("btn-danger btn-xs");

       $(activar[i]).empty();
       $(activar[i]).attr("estadoProducto", 0);
       $(activar[i]).append("<span class='glyphicon glyphicon-remove'></span> Inactivo");
     }
     else {

       $(activar[i]).removeClass('btn-default btn-xs');
       $(activar[i]).addClass("btn-success btn-xs");
       $(activar[i]).empty();
       $(activar[i]).attr("estadoProducto", 1);
       $(activar[i]).append("<span class='glyphicon glyphicon-ok'></span> Activo");
     }


   }




})

/*=============================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
=============================================*/

$('.tabla tbody').on( 'click', 'button', function () {

	if(window.matchMedia("(min-width:1300px)").matches){

		var data = table.row( $(this).parents('tr') ).data();

	}else{

		var data = table.row( $(this).parents('tbody tr ul li')).data();

	}

	$(this).attr("idProducto", data['ID']);
  //$(this).attr("estadoProducto", data['Estado']);

  //var data2 = table.row( $(this).parents('tbody tr ul li')).data();

  $(this).attr("data-target","#modal-update"+data['ID']);
  //$(this).attr("onClick","location.href='productos/"+data['ID']+"'");

} );


$(".tabla tbody").on( 'click', 'button.verDerivado', function(){

	var data = table.row( $(this).parents('tbody tr ul li')).data();
  //var data = table2.row( this ).data();//sirve cuando el boton no entra en la fila
  window.location.href = "/consultarpresentaciones/"+data['ID'];
})

/*
$(".tabla tbody").on( 'click', 'button.btnActivar', function(){

	var data = table.row( $(this).parents('tr') ).data();//sirve cuando el boton entra en la fila
  //var data = table2.row( this ).data();//sirve cuando el boton no entra en la fila
	$(this).attr("idProducto",data['ID']);
})
*/
/*
$(".tabla tbody").on( 'click', 'button.modalActualizar', function(){

	var data = table.row( $(this).parents('tr') ).data();//sirve cuando el boton entra en la fila
  //var data = table2.row( this ).data();//sirve cuando el boton no entra en la fila

  //var modal="#modal-update"+data['ID'];

	$(this).attr("data-target","#modal-update"+data['ID']);
})
*/


$(".tabla").on('click', 'button.btnActivar', function(){
  var idProducto = $(this).attr("idProducto");
  var estadoProducto = $(this).attr("estadoProducto");
  alert(idProducto);
  alert(estadoProducto);
  $.ajax({
    type: "GET",
    url: "productos/"+idProducto+"/"+estadoProducto,
    dataType: "json",
    success:function(respuesta){
      var mensaje;

      if (respuesta['Estado'] == 1){
        mensaje = "El Producto ha sido activado correctamente!";
        $("button.btnActivar[idProducto='"+ idProducto +"']").removeClass('btn-danger btn-xs');
        $("button.btnActivar[idProducto='"+ idProducto +"']").addClass('btn-success btn-xs');

        $("button.btnActivar[idProducto='"+ idProducto +"']").empty();

        $("button.btnActivar[idProducto='"+ idProducto +"']").attr('estadoProducto', 1);
        $("button.btnActivar[idProducto='"+ idProducto +"']").append("<span class='glyphicon glyphicon-ok'></span> Activo");
      }
      else{
        mensaje = "El Producto ha sido desactivado correctamente";
        $("button.btnActivar[idProducto='"+ idProducto +"']").removeClass('btn-success btn-xs');
        $("button.btnActivar[idProducto='"+ idProducto +"']").addClass('btn-danger btn-xs');

        $("button.btnActivar[idProducto='"+ idProducto +"']").empty();

        $("button.btnActivar[idProducto='"+ idProducto +"']").attr('estadoProducto', 0);
        $("button.btnActivar[idProducto='"+ idProducto +"']").append("<span class='glyphicon glyphicon-remove'></span> Inactivo");
      }

      swal({
        type: "success",
        title: mensaje,
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false
      }).then(function(result) {
          if (result.value) {
            //
          }
      });

    }
  })
})



</script>



@stop
