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
  Categorias
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

      @if($categorias->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ninguna categoria registrado
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
            <th>Codigo Sunat</th>
            <th>Nombre</th>
            <th>Descripcion</th>

          </tr>
          </thead>
          <tbody>

          @foreach($categorias as $categoria)
          <tr>
            <td>{{ $categoria->ID }}</td>
            <td>{{ $categoria->CodigoSunat }}</td>
            <td>{{ $categoria->Nombre }}</td>
            <td>{{ $categoria->Descripcion }}</td>


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

<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>


@stop

@section('jsope')

<!-- Responsive -->
<script>
  $(document).ready(function() {
    $('#tabla').DataTable(
      {
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
      }
    );
  } );
</script>



@stop
