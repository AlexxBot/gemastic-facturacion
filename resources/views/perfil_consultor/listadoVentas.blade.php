
@extends('layout.layoutConsultor')

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

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

      @if($ventas->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ninguna venta registrada
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

        <table id="tabla" class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
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
                <form method="get" action="{!! action('VentaController@modificarEstado',[$venta->ID, $venta->Estado]) !!}">
              @if ($venta->Estado=="1")
              <button type="submit" class="btn btn-success btn-sm btnActivar" idUsuario="{{ $venta->ID }}" estadoUsuario="1" disabled="">
                <span class="glyphicon glyphicon-ok"></span> Activo</button>
              @else
              <button type="submit" class="btn btn-danger btn-sm btnActivar" idUsuario="{{ $venta->ID }}" estadoUsuario="0" disabled="">
                <span class="glyphicon glyphicon-remove"></span> Inactivo</button>
              @endif
                </form>
              </ul>
            </td>
            <td>{{ $venta->ID_MotivoAnulacion }}</td>
            <td>{{ $venta->Tipo_Comprobante->Nombre }}</td>
            <td>{{ $venta->ID_Impuesto }}</td>
            <td>{{ $venta->ID_Negocio }}</td>
            <td>{{ $venta->PorcentajeImpuesto }}</td>

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

<!-- FastClick -->
<!--
<script src="/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
-->

<!--<script src={{
URL::asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}></script>

<script src={{
URL::asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}></script>

<script src="/adminlte/js/code/jquery-1.12.4.js"></script>

<script src="/adminlte/js/cdn/jquery.dataTables.min.js"></script>

<script src="/adminlte/js/cdn/dataTables.bootstrap.min.js"></script>

<script src="/adminlte/js/cdn/dataTables.fixedHeader.min.js"></script>

<script src="/adminlte/js/cdn/dataTables.responsive.min.js"></script>

<script src="/adminlte/js/cdn/responsive.bootstrap.min.js"></script>-->
<!-- /.Page Data -->

<!-- Responsive -->
<!--<script type ="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
<script type ="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script type ="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.j"></script>-->
<!-- /.Responsive -->

@stop

@section('jsope')

<!-- Responsive -->
<script>
  $(document).ready(function() {

    $('#tabla').DataTable( {
      "responsive":"true",
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "search":  "Buscar",
        "zeroRecords": "Ningun registro encontrado",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "paginate": {
            "first":      "Primero",
            "previous":   "Anterior",
            "next":       "Siguiente",
            "last":       "Ultimo"
        },
      }
    });

  });
</script>
<!-- /.Responsive -->


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
