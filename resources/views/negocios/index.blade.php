@extends('layout.layout')

@section('estilos')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

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
@stop

@section('encabezado')
<h1>Negocios<small>Optional description</small></h1>
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
          Agregar Negocio 
        </button>
        <!-- /.Button modal create -->
        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      @if($negocios->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ningun negocio <a href="#"
        class="alert-link">Registre Negocio</a>
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
            <th>Ruc</th>
            <th>Razon Social</th>
            <th>Denominacion</th>
            <th>Direccion</th>
            <th>Telefono 1</th>
            <th>Telefono 2</th>
            <th>Email</th>
            <th>Url Pagina Web</th>
            <th>Representante Legal</th>
            <th>Estado</th>
            <th>Ubigeo</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
          @foreach($negocios as $negocio)
          <tr>
            <td>{{ $negocio->ID }}</td>
            <td>{{ $negocio->Ruc }}</td>
            <td>{{ $negocio->RazonSocial }}</td>
            <td>{{ $negocio->Denominacion }}</td>
            <td>{{ $negocio->Direccion }}</td>
            <td>{{ $negocio->Telefono1 }}</td>
            <td>{{ $negocio->Telefono2 }}</td>
            <td>{{ $negocio->Email }}</td>
            <td>{{ $negocio->Web }}</td>
            <td>{{ $negocio->RepLegal }}</td>

            <td class="center">
              <ul class="nav nav-pills">
                <form method="get" action="{!! action('NegocioController@modificarEstado',[$negocio->ID, $negocio->Estado]) !!}">
                  @if ($negocio->Estado=="1")
                  <button type="submit" class="btn btn-success btn-sm btnActivar" idAlmacen="{{ $negocio->ID }}" estadoAlmacen="1">
                    <span class="glyphicon glyphicon-ok"></span> Activo</button>
                  @else
                  <button type="submit" class="btn btn-danger btn-sm btnActivar" idUsuario="{{ $negocio->ID }}" estadoAlmacen="0">
                    <span class="glyphicon glyphicon-remove"></span> Inactivo</button>
                  @endif
                </form>
              </ul>
            </td>

            <td>{{ $negocio->Ubigeo }}</td>

            <td class="center">
    					<ul class="nav nav-pills">
                  <!-- Button modal edit -->
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $negocio->ID }}">
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
        <h4 class="modal-title">Registrar Negocio</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form-create" action="/negocios" autocomplete="off">
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
              <!--<label>Ruc:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="Ruc" placeholder="Ruc" pattern="[a-zA-Z0-9]{11}" required>
              </div>
            </div>

            <div class="form-group">
              <!--<label>Razon Social:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="RazonSocial" placeholder="Razon social" required><!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" -->
              </div>
            </div>

            <div class="form-group">
              <!--<label>Denominacion:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="Denominacion" placeholder="Denominacion" required><!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" -->
              </div>
            </div>

            <div class="form-group">
              <!--<label>Direccion:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="Direccion" placeholder="Direccion" required><!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" -->
              </div>
            </div>

            <div class="form-group">
              <!--<label>Telefono 1:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control" name="Telefono1" placeholder="Ingresar telefono 1" data-inputmask="'mask':'(999) 999-9999'" data-mask>
              </div>
            </div>

            <div class="form-group">
              <!--<label>Telefono 2:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control" name="Telefono2" placeholder="Ingresar telefono 2" data-inputmask="'mask':'(999) 999-9999'" data-mask>
              </div>
            </div>

            <div class="form-group">
              <!--<label>Email:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="email" class="form-control" name="Email" placeholder="Email" required="">
              </div>
            </div>

            <div class="form-group">
              <!--<label>Url Pagina Web:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="url" class="form-control" name="Web" placeholder="Url">
              </div>
            </div>

            <div class="form-group">
              <!--<label>Representante Legal:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="RepLegal" placeholder="Representante Legal"
                pattern="[a-zA-Z0-9]+[-_\.]*">
              </div>
            </div>

            <div class="form-group">
              <!--<label>Ubigeo:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="Ubigeo" placeholder="Ubigeo" pattern="[a-zA-Z0-9]{6}">
              </div>
            </div>

          </div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar negocio</button>

      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($negocios as $negocio)

<!-- Modal edit -->
<div class="modal fade modalReset" id="modal-update{{ $negocio->ID }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiarForm({{ $negocio->ID }});" >
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Negocio</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form{{ $negocio->ID }}"
        action="{!! action('NegocioController@update', $negocio->ID ) !!}" autocomplete="off">
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
            <div class="col-md-6">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Ruc" placeholder="Ruc"
                  value="{{ $negocio->Ruc }}" pattern="[a-zA-Z0-9]{11}" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="RazonSocial" placeholder="Razon Social"
                  value="{{ $negocio->RazonSocial }}" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Denominacion" placeholder="Denominacion"
                  value="{{ $negocio->Denominacion }}">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Direccion" placeholder="Direccion"
                  value="{{ $negocio->Direccion }}" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" name="Telefono1" placeholder="Telefono1"
                  value="{{ $negocio->Telefono1 }}" data-inputmask="'mask':'(999) 999-9999'" data-mask>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" name="Telefono2" placeholder="Telefono2"
                  value="{{ $negocio->Telefono2 }}" data-inputmask="'mask':'(999) 999-9999'" data-mask>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                  <input type="email" class="form-control" name="Email" placeholder="Email"
                  value="{{ $negocio->Email }}" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-link"></i></span>
                  <input type="url" class="form-control" name="Web" placeholder="Url"
                  value="{{ $negocio->Web }}">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="RepLegal" placeholder="Representante Legal"
                  value="{{ $negocio->RepLegal }}">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="Estado">
                    <option value="1" @if($negocio->Estado == "1") selected="" @endif>Activo</option>
                    <option value="0" @if($negocio->Estado == "0") selected="" @endif>Inactivo</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Ubigeo" placeholder="Ubigeo"
                  value="{{ $negocio->Ubigeo }}" pattern="[a-zA-Z0-9]{11}">
                </div>
              </div>

            </div>
            <!-- /.col -->
          </div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
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

@foreach($negocios as $negocio)
<script>
$('#modal-update{{ $negocio->ID }}').on('hidden.bs.modal', function (e) {
  $('#form{{ $negocio->ID }}')[0].reset();
});
</script>
@endforeach
<!-- /.Reset forms -->

@stop
