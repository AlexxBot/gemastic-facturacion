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
  Productos Presentaciones
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
        <br></br>

        <div class="col-md-3">
          <div class="form-group">
            <!--<label>Ubigeo:</label>-->
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
              <input type="text" class="form-control"  value="{{ $producto->Nombre }}" readonly="">
            </div>
            <!-- /.input group -->
          </div>
        </div>

          <div class="form-group">
            <!--<label>Ubigeo:</label>-->
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
              <input type="text" class="form-control"  value="{{ $producto->Descripcion }}" readonly="">
            </div>
            <!-- /.input group -->
          </div>




      <!-- /.box-header -->
      <div class="box-body">

      @if($producto_empaques->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ningun producto_empaque derivado registrado
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
            <th>Unidad Medida</th>
            <th>Precio1</th>
            <th>Precio2</th>
            <th>Precio3</th>
            <th>Equivalencia</th>

          </tr>
          </thead>
          <tbody>

          @foreach($producto_empaques as $producto_empaque)
          <tr>
            <td>{{ $producto_empaque->Unidad_Medida->Nombre }}</td>
            <td>{{ $producto_empaque->Precio1 }}</td>
            <td>{{ $producto_empaque->Precio2 }}</td>
            <td>{{ $producto_empaque->Precio3 }}</td>
            <td>{{ $producto_empaque->Equivalencia}}</td>


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
      }
    );
  } );
</script>


@stop
