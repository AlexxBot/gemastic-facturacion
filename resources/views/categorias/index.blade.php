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

        <!-- Button modal create -->
        <button type="button" class="btn btn-primary" data-toggle="modal" id="buttonn" data-target="#modal-create" data-backdrop="static" data-keyboard="false"><!--data-target="#modal"-->
          Agregar Categoria
        </button>
        <!-- /.Button modal create -->

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

      @if($categorias->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ninguna categoria registrado <a href="#"
        class="alert-link">Registre Categorias</a>
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
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>

          @foreach($categorias as $categoria)
          <tr>
            <td>{{ $categoria->ID }}</td>
            <td>{{ $categoria->CodigoSunat }}</td>
            <td>{{ $categoria->Nombre }}</td>
            <td>{{ $categoria->Descripcion }}</td>

            <td class="center">
    					<ul class="nav nav-pills">

                  <!-- Button modal edit -->
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $categoria->ID }}">
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
<!-- /.row -->



<!-- Modal create -->
<div class="modal fade modalReset" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Categoria</h4>
      </div>
      <form role="form" class="formReset" id="form-create" method="post" action="/categorias" autocomplete="off">
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
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control" name="CodigoSunat" placeholder="CodigoSunat">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                <input type="text" class="form-control" name="Nombre" placeholder="Nombre">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                <textarea class="form-control" rows="3" placeholder="Descripcion" name ='Descripcion'></textarea>
              </div>
            </div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar Categoria</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($categorias as $categoria)

<!-- Modal edit -->
<div class="modal fade modalReset" id="modal-update{{ $categoria->ID }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Categoria</h4>
      </div>
      <form role="form" class="formReset" id="form{{ $categoria->ID }}" method="post" action="{!! action('CategoriaController@update', $categoria->ID ) !!}" autocomplete="off">
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
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control" name="CodigoSunat" placeholder="Codigo Sunat" value="{{ $categoria->CodigoSunat }}">
              </div>
              <!-- /.input group -->
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                <input type="text" class="form-control" name="Nombre" placeholder="Nombre" value="{{ $categoria->Nombre }}">
              </div>
              <!-- /.input group -->
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                <textarea class="form-control" rows="3" placeholder="Descripcion" name ='Descripcion'>{{ $categoria->Descripcion }}</textarea>
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

<!-- Reset forms -->
<script>
$('#modal-create').on('hidden.bs.modal', function (e) {
  $('#form-create')[0].reset();
});
</script>

@foreach($categorias as $categoria)
<script>
$('#modal-update{{ $categoria->ID }}').on('hidden.bs.modal', function (e) {
  $('#form{{ $categoria->ID }}')[0].reset();
});
</script>
@endforeach
<!-- /.Reset forms -->


@stop
