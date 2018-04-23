@extends('layout.layout')

@section('estilos')

<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

<!--<script src={{
URL::asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}></script>
<script src={{
URL::asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}></script>-->

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
<h1>Usuarios<small>Optional description</small></h1>
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
            Agregar Usuario
          </button>
          <!-- /.Button modal create -->
        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        @if($usuarios->isEmpty())
        <div class="alert alert-success">
          <button type="button" class="close"
          data-dismiss="alert" aria-hidden="true">x</button>
          No se tiene ningun usuario registrado <a href="#"
          class="alert-link">Registre usuarios</a>
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
              <th>Nombres</th>
              <th>Usuario</th>
              <th>Estado</th>
              <th>Perfil</th>
              <th>Url Imagen</th>
              <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($usuarios as $usuario)
            <tr>
              <td >{{ $usuario->id }}</td>
              <td>{{ $usuario->name }}</td>
              <td>{{ $usuario->email }}</td>

              <td class="center">
                <ul class="nav nav-pills">

                <button type="button" idUsuario="{{ $usuario->id }}" estadoUsuario="{{ $usuario->Estado }}" data-token="{{ csrf_token() }}" @if($usuario->Estado == "1") class="btn btn-sm btnActivar btn-success" @else class="btn btn-sm btnActivar btn-danger" @endif>
                  <span @if($usuario->Estado == "1") class="glyphicon glyphicon-ok" @else class="glyphicon glyphicon-remove" @endif></span>@if($usuario->Estado == "1") Activo @else Inactivo @endif</button>

                </ul>
              </td>

              <td>{{ $usuario->perfil->Nombre }}</td>
              <td>{{ $usuario->UrlImagen }}</td>

              <td class="center">
      					<ul class="nav nav-pills">

                    <!-- Button modal edit -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $usuario->id }}">
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
<div class="modal fade modalReset" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar usuario</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form-create" action="/usuarios" autocomplete="off">
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
                <input type="text" class="form-control" name="name" placeholder="Ingresar nombres" required="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Ingresar email" required="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Ingresar password" required=""
                pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?=.*[A-Z])(?=.*[a-z]).*$" title="Debe contener como minimo una letra mayuscula, minuscula, un digito y un caracter especial, y con una longitud mayor o igual a 8 caracteres"><!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" -->
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <select class="form-control select2" style="width: 100%;" name="Id_Perfil" required="">
                  <option value="" selected="">Seleccionar un perfil</option>
                  @foreach($perfiles as $perfil)
                  <option value="{{ $perfil->ID }}">{{ $perfil->Nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="UrlImagen" placeholder="Ingresar Url imagen">
              </div>
            </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar usuario</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($usuarios as $usuario)

<!-- Modal edit -->
<div class="modal fade modalReset" id="modal-update{{ $usuario->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Usuario</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form{{ $usuario->id }}" action="{!! action('UsuarioController@update', $usuario->id ) !!}" autocomplete="off">
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
              <input type="text" class="form-control" name="name" placeholder="Ingresar nombres" value="{{ $usuario->name }}" required="">
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
              <input type="email" class="form-control" name="email" placeholder="Ingresar email" value="{{ $usuario->email }}" required="">
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Cambiar password"
              pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?=.*[A-Z])(?=.*[a-z]).*$" title="Debe contener como minimo una letra mayuscula, minuscula, un digito y un caracter especial, y con una longitud mayor o igual a 8 caracteres">
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
              <select class="form-control select2" style="width: 100%;" name="Id_Perfil">
                @foreach($perfiles as $perfil)
                <option value="{{ $perfil->ID }}" @if($usuario->Id_Perfil == $perfil->ID) selected="" @endif>{{ $perfil->Nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
              <input type="text" class="form-control" name="UrlImagen" placeholder="Ingresar Url imagen" value="{{ $usuario->UrlImagen }}">
            </div>
          </div>

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

<script>
$(".tablas").on('click', 'button.btnActivar', function() {
  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");
  var token = $(this).attr("data-token");

  $.ajax({
    type: "GET",
    url: "usuarios/"+idUsuario+"/"+estadoUsuario,
    //data: {"token": token},
    dataType: "json",
    success:function(respuesta){

      var mensaje;
      if (respuesta['Estado'] == 1){

        mensaje = "El usuario ha sido activado correctamente!";
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").removeClass('btn-danger');
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").addClass('btn-success');
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").empty();
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").attr("estadoUsuario", 1);
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").append("<span class='glyphicon glyphicon-ok'></span> Activo");

      }
      else{

        mensaje = "El usuario ha sido desactivado correctamente!";
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").removeClass('btn-success');
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").addClass('btn-danger');
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").empty();
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").attr("estadoUsuario", 0);
        $("button.btnActivar[idUsuario='"+ idUsuario +"']").append("<span class='glyphicon glyphicon-remove'></span> Inactivo");

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

@foreach($usuarios as $usuario)
<script>
$('#modal-update{{ $usuario->id }}').on('hidden.bs.modal', function (e) {
  $('#form{{ $usuario->id }}')[0].reset();
});
</script>
@endforeach
<!-- /.Reset forms -->

@stop
