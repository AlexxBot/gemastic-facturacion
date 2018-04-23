@extends('layout.layout')

@section('estilos')
<!-- Page Data -->

<!-- DataTables -->

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
  Impuestos
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

        <!-- Button modal create -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create"><!-- data-backdrop="static" data-keyboard="false" -->
          Agregar impuesto
        </button>
        <!-- /.Button modal create -->

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

      @if($impuestos->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ningun impuesto <a href="#"
        class="alert-link">Registre Impuesto</a>
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
            <th>ID</th>
            <th>Nombre</th>
            <th>Monto porcentual</th>
            <th>Monto fijo</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>

          @foreach($impuestos as $impuesto)
          <tr>
            <td>{{ $impuesto->ID }}</td>
            <td>{{ $impuesto->Nombre }}</td>
            <td>{{ $impuesto->Porcentaje }}</td>
            <td>{{ $impuesto->Fijo }}</td>

            <td class="center">
    					<ul class="nav nav-pills">

                  <!-- Button modal edit -->
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $impuesto->ID }}">
                  <span class="glyphicon glyphicon-pencil"></span>
                  </button>
                  <!-- Button modal edit -->

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

<!-- Modal create -->
<div class="modal fade  modalReset" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar impuesto</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form-create" action="/impuestos" autocomplete="off">
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
                <input type="text" class="form-control" name="ID" placeholder="Ingresar codigo (ID)" required="" pattern="[A-Za-z0-9]{3}" title="Debe ingresar tres caracteres (puede incluir numeros, letras mayusculas y minusculas)">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="Nombre" placeholder="Ingresar nombre" required="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                <input type="number" step="any" class="form-control" name="Porcentaje" placeholder="Ingresar cantidad porcentual" required="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input type="number" step="any" class="form-control" name="Fijo" placeholder="Ingresar cantidad fija">
              </div>
            </div>

          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar impuesto</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($impuestos as $impuesto)

<!-- Modal edit -->
<div class="modal fade modalReset" id="modal-update{{ $impuesto->ID }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar impuesto</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form{{ $impuesto->ID }}" action="{!! action('ImpuestoController@update', $impuesto->ID ) !!}" autocomplete="off">
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
                  <input type="text" class="form-control" name="Nombre" placeholder="Ingresar nombre" value="{{ $impuesto->Nombre }}" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  <input type="number" step="any" class="form-control" name="Porcentaje" placeholder="Ingresar cantidad porcentual" value="{{ $impuesto->Porcentaje }}" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"></i></span>
                  <input type="text" class="form-control" name="Fijo" placeholder="Ingresar cantidad fija" value="{{ $impuesto->Fijo }}">
                </div>
              </div>

          </div>

      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
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

<!-- Reset forms -->
<script>
$('#modal-create').on('hidden.bs.modal', function (e) {
  $('#form-create')[0].reset();
});
</script>

@foreach($impuestos as $impuesto)
<script>
$('#modal-update{{ $impuesto->ID }}').on('hidden.bs.modal', function (e) {
  $('#form{{ $impuesto->ID }}')[0].reset();
});
</script>
@endforeach
<!-- /.Reset forms -->

@stop
