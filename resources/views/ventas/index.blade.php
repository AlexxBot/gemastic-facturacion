
@extends(Auth::user()['Id_Perfil'] == 1 ? 'layout.layout' : 'layout.layoutVendedor')

@section('estilos')
<!-- Page Data -->

<!-- DataTables -->

<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

<!--<script src={{
URL::asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}></script>

<script src={{
URL::asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}></script>-->

<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<!--<link rel="stylesheet" href="/adminlte/css/skins/_all-skins.min.css">-->


<!--<link rel="stylesheet" type="text/css" href="/adminlte/css/maxcdn/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/adminlte/css/cdn/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/adminlte/css/cdn/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/adminlte/css/cdn/responsive.bootstrap.min.css">-->
<!-- /.Page Data -->

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
  Ventas
  <small>Optional description</small>
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

        <button type="button" class="btn btn-primary" onClick="location.href='ventas/create'"><!-- data-backdrop="static" data-keyboard="false" -->
          Agregar Venta
        </button>
        <!-- /.Button modal create -->

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

      @if($ventas->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ninguna venta registrada <a href="#"
        class="alert-link">Registre Ventas</a>
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

        <table id="tabla" class="table table-bordered table-striped dt-responsive tabla" style="width:100%">
          <thead>
          <tr>
            <th>#</th>
            <th>Serie</th>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Monto Bruto</th>
            <th>Impuesto</th>
            <th>Total</th>
            <th>Monto Real</th>
            <th>Descuento Fijo</th>
            <th>Descuent Porcentual</th>
            <th>Estado</th>
            <th>Motivo de Anulacion</th>
            <th>Tipo de Comprobante</th>
            <th>Impuesto</th>
            <th>Negocio</th>
            <th>Porcentaje de Impuesto</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>

          @foreach($ventas as $venta)
          <tr>
            <td>{{ $venta->ID }}</td>
            <td>{{ $venta->Serie }}</td>
            <td>{{ $venta->Numero }}</td>
            <td>{{ $venta->Fecha }}</td>
            <td>{{ $venta->Cliente->RazonSocial }}</td>
            <td>{{ $venta->MontoBruto }}</td>
            <td>{{ $venta->Impuesto }}</td>
            <td>{{ $venta->Total }}</td>
            <td>{{ $venta->MontoReal }}</td>
            <td>{{ $venta->DescuentoFijo }}</td>
            <td>{{ $venta->DescuentoPorcentual }}</td>
            <td class="center">
              <ul class="nav nav-pills">

              <button type="button" idVenta="{{ $venta->ID }}" estadoVenta="{{ $venta->Estado }}" data-token="{{ csrf_token() }}" @if($venta->Estado == "1") class="btn btn-sm btnActivar btn-success" @else class="btn btn-sm btnActivar btn-danger" @endif>
                <span @if($venta->Estado == "1") class="glyphicon glyphicon-ok" @else class="glyphicon glyphicon-remove" @endif></span>@if($venta->Estado == "1") Activo @else Anulado @endif</button>

              </ul>
            </td>
            <td>{{ $venta->ID_MotivoAnulacion }}</td>
            <td>{{ $venta->Tipo_Comprobante->Nombre }}</td>
            <td>{{ $venta->ID_Impuesto }}</td>
            <td>{{ $venta->ID_Negocio }}</td>
            <td>{{ $venta->PorcentajeImpuesto }}</td>

            <td class="center">
    					<ul class="nav nav-pills">

                  <!-- Button modal edit -->
                  <button type="button" class="btn btn-warning" onClick="location.href='{!! action('VentaController@edit' , $venta->ID) !!}'">
                  <span class="glyphicon glyphicon-pencil"></span>
                  </button>

    					</ul>
    				</td>
          </tr>
          @endforeach

          </tbody>
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

<!-- Page Data -->
<!-- jQuery 3 -->
<!--<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>ya esta dentro del layout-->
<!-- Bootstrap 3.3.7 -->
<!--<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>ya esta dentro del layout-->
<!-- DataTables -->
<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>


@stop

@section('jsope')

<!-- Responsive -->
<script>
  $(document).ready(function() {

    $('.tabla').DataTable( {
      "sprocessing": true,
      "sserverSide": true,
      "responsive":"true",
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
    });

  });
</script>
<!-- /.Responsive -->

<!-- Delete sweetalert -->
<script>
$(".tabla").on('click', 'button.btnActivar', function(){
  var idVenta = $(this).attr("idVenta");
  var estadoVenta = $(this).attr("estadoVenta");


  $.ajax({
    type: "GET",
    url: "ventas/"+idVenta+"/"+estadoVenta,
    dataType: "json",
    success:function(respuesta){
      var mensaje;

      if (respuesta['Estado'] == 1){
        mensaje = "La Venta ha sido activado correctamente!";
        $("button.btnActivar[idVenta='"+ idVenta +"']").removeClass('btn-danger');
        $("button.btnActivar[idVenta='"+ idVenta +"']").addClass('btn-success');

        $("button.btnActivar[idVenta='"+ idVenta +"']").empty();

        $("button.btnActivar[idVenta='"+ idVenta +"']").attr("estadoVenta", 1);
        $("button.btnActivar[idVenta='"+ idVenta +"']").append("<span class='glyphicon glyphicon-ok'></span> Activo");
      }
      else{
        mensaje = "La Venta ha sido desactivado correctamente";
        $("button.btnActivar[idVenta='"+ idVenta +"']").removeClass('btn-success');
        $("button.btnActivar[idVenta='"+ idVenta +"']").addClass('btn-danger');

        $("button.btnActivar[idVenta='"+ idVenta +"']").empty();

        $("button.btnActivar[idVenta='"+ idVenta +"']").attr("estadoVenta", 0);
        $("button.btnActivar[idVenta='"+ idVenta +"']").append("<span class='glyphicon glyphicon-remove'></span> Anulado");
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
<!-- /.Delete sweetalert -->



<!--
<script>

/*=============================================
BOTON EDITAR VENTA
=============================================*/

$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");
	console.log("idVenta", idVenta);

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})



$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: 'Â¿EstÃ¡ seguro de borrar la venta?',
        text: "Â¡Si no lo estÃ¡ puede cancelar la accÃ­Ã³n!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result) {
        if (result.value) {

            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })

})
</script>
-->

<!--<script>
$('.modalReset').on('hidden.bs.modal', function (e) {
  // do something when this modal window is closed...
  $('.formReset')[0].reset();
});
</script>-->
<!-- /.Reset forms -->

<!-- If validation isnt correct -->
<!--
@if(Session::has('errors'))
<script type="text/javascript">
$(window).on('load',function(){
    $('#modal').modal('show');
});
</script>
@endif
-->
<!-- ./If validation isnt correct -->

<!-- Modal Create -->
<!--
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
-->
<!-- /.Modal Create -->

<!--<script type="text/javascript">
$(document).ready(function() {
  $('#btn-delete-trig').click(function(){
    $('#modal-delete').modal('show');
  });
});
</script>-->

@stop
