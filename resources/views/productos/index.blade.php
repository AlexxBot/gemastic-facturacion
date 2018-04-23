@extends('layout.layout')

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

        <!-- Button modal create -->
        <button type="button" class="btn btn-primary" data-toggle="modal" id="buttonn" data-target="#modal-create" data-backdrop="static" data-keyboard="false"><!--data-target="#modal"-->
          Agregar Producto
        </button>
        <!-- /.Button modal create -->

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

      @if($productos->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ningun producto registrado <a href="#"
        class="alert-link">Registre Productos</a>
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
            <th>Acciones</th>
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




<!-- Modal create -->
<div class="modal fade modalReset" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Producto</h4>
      </div>
      <form role="form"  class="formReset" id="form-create" method="post" action="/productos" autocomplete="off">
      <div class="modal-body" style="padding:40px 50px;">

          @foreach($errors->all() as $error)
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss='alert' aria-hidden='true'>x</button>
              {{ $error }}
            </div>
          @endforeach
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="row">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="CodigoSunat" placeholder="Codigo Sunat">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="ID_UnidadMedida">
                    <option value="" select >seleccione unidad de medida</opcion>
                    @foreach($unidad_medidas as $unidad_medida)
                      <option value="{!! $unidad_medida->ID !!}" >{{ $unidad_medida->CodigoPeru }} {{ $unidad_medida->Nombre }} </opcion>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Nombre" placeholder="Nombre">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Descripcion" placeholder="Descripcion">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="ID_Categoria">
                    <option value="" select >seleccionar categoria</opcion>
                    @foreach($categorias as $categoria)
                      <option value="{!! $categoria->ID !!}" >{{ $categoria->CodigoSunat }} {{ $categoria->Nombre }} </opcion>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="ID_Fabricante">
                    <option value="" select >seleccionar fabricante</opcion>
                    @foreach($fabricantes as $fabricante)
                      <option value="{!! $fabricante->ID !!}" >{{ $fabricante->RazonSocial }}</opcion>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <!--<label>Direccion:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Stock" placeholder="Stock">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="StockMinimo" placeholder="StockMinimo">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio1" placeholder="Precio1">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio2" placeholder="Precio2">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio3" placeholder="Precio3">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="PrecioRefCompra" placeholder="Precio Referencial Compra">
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <!-- /.col -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar Producto</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($productos as $producto)

<!-- Modal edit -->
<div class="modal fade modalReset" id="modal-update{{ $producto->ID }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Producto</h4>
      </div>
      <form role="form" class="formReset" id="form{{ $producto->ID }}" method="post" action="{!! action('ProductoController@update', $producto->ID ) !!}" autocomplete="off">
      <div class="modal-body" style="padding:40px 50px;">

          @foreach($errors->all() as $error)
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss='alert' aria-hidden='true'>x</button>
              {{ $error }}
            </div>
          @endforeach
          {!! csrf_field() !!}
          {!! method_field('PUT') !!}
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="row">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="CodigoSunat" placeholder="Codigo Sunat" value="{{ $producto->CodigoSunat }}">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="ID_UnidadMedida">
                    <option value="" select >seleccionar unidad de medida</opcion>
                    @foreach($unidad_medidas as $unidad_medida)
                      <option value="{!! $unidad_medida->ID !!}" @if($unidad_medida->ID==$producto->ID_UnidadMedida) selected @endif>{{ $unidad_medida->CodigoPeru }} {{ $unidad_medida->Nombre }} </opcion>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Nombre" placeholder="Nombre" value="{{ $producto->Nombre }}">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Descripcion" placeholder="Descripcion" value="{{ $producto->Descripcion }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="ID_Categoria">
                    <option value="" select >seleccionar categoria</opcion>
                    @foreach($categorias as $categoria)
                      <option value="{!! $categoria->ID !!}" @if($categoria->ID==$producto->ID_Categoria) selected @endif>{{ $categoria->CodigoSunat }} {{ $categoria->Nombre }}</opcion>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="ID_Fabricante">
                    <option value="" select >seleccionar fabricante</opcion>
                    @foreach($fabricantes as $fabricante)
                      <option value="{!! $fabricante->ID !!}" >{{ $fabricante->RazonSocial }}</opcion>
                      <option value="{!! $fabricante->ID !!}" @if($fabricante->ID==$producto->ID_Fabricante) selected @endif>{{ $fabricante->RazonSocial }}</opcion>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <!--<label>Direccion:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Stock" placeholder="Stock" value="{{ $producto->Stock }}">
                </div>
                <!-- /.input group -->
              </div>

            <!-- /.col -->

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="StockMinimo" placeholder="StockMinimo" value="{{ $producto->StockMinimo }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio1" placeholder="Precio1" value="{{ $producto->Precio1}}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio2" placeholder="Precio2" value="{{ $producto->Precio2 }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio3" placeholder="Precio3" value="{{ $producto->Precio3 }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="PrecioRefCompra" placeholder="Precio Referencial Compra" value="{{ $producto->PrecioRefCompra}}">
                </div>
                <!-- /.input group -->
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar cambios</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal edit -->


@endforeach

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
  "ajax":"{{route('productoslistado.index')}}",
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
        "defaultContent": '<button type="submit" class="btn btn-xs btnActivar btn-default" idProducto estadoProducto data-token="{{ csrf_token() }}" </button>'

      },
      {"data" : "StockMinimo"},
      {"data" : "Precio1","sTitle":"Precio1", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ), name: 'Precio',visible:true },
      {"data" : "Precio2","sTitle":"Precio2", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ), name: 'Precio',visible:true },
      {"data" : "Precio3","sTitle":"Precio3", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ), name: 'Precio',visible:true },

      {"data" : "PrecioRefCompra","sTitle":"PrecioRefCompra", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ),visible:true },
      {
          "defaultContent": '<button type="button" class="btn btn-warning modalActualizar" data-toggle="modal" data-target ><span class="glyphicon glyphicon-pencil"></span></button>'

      },
      {
          "defaultContent": '<button type="button" class="btn btn-success agregarDerivado" >Agregar Presentacion</button>'
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
  //var agregar =$(".agregarDerivado");

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


$(".tabla tbody").on( 'click', 'button.agregarDerivado', function(){

	var data = table.row( $(this).parents('tbody tr ul li')).data();
  //var data = table2.row( this ).data();//sirve cuando el boton no entra en la fila
  window.location.href = "productos/"+data['ID'];
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
  //alert(idProducto);
  //alert(estadoProducto);
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

<!-- Reset forms -->
<script>
$('#modal-create').on('hidden.bs.modal', function (e) {
  $('#form-create')[0].reset();
});
</script>

@foreach($productos as $producto)
<script>
$('#modal-update{{ $producto->ID }}').on('hidden.bs.modal', function (e) {
  $('#form{{ $producto->ID }}')[0].reset();
});
</script>
@endforeach
<!-- /.Reset forms -->


@stop
