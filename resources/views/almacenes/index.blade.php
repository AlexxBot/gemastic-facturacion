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
<h1>Almacenes<small>Optional description</small>
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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
            Agregar Almacen
          </button>
          <!-- /.Button modal create -->

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        @if($almacenes->isEmpty())
        <div class="alert alert-success">
          <button type="button" class="close"
          data-dismiss="alert" aria-hidden="true">x</button>
          No se tiene ningun almacen <a href="#"
          class="alert-link">Registre Almacen</a>
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
              <th>Nombre</th>
              <th>Direccion</th>
              <th>Telefono 1</th>
              <th>Telefono 2</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($almacenes as $almacen)
            <tr>
              <td>{{ $almacen->ID }}</td>
              <td>{{ $almacen->Nombre }}</td>
              <td>{{ $almacen->Direccion }}</td>
              <td>{{ $almacen->Telefono1 }}</td>
              <td>{{ $almacen->Telefono2 }}</td>

              <td class="center">
                <ul class="nav nav-pills">
                  <button type="button" idAlmacen="{{ $almacen->ID }}" estadoAlmacen="{{ $almacen->Estado }}" data-token="{{ csrf_token() }}" @if($almacen->Estado == "1") class="btn btn-sm btnActivar btn-success" @else class="btn btn-sm btnActivar btn-danger" @endif>
                    <span @if($almacen->Estado == "1") class="glyphicon glyphicon-ok" @else class="glyphicon glyphicon-remove" @endif></span>@if($almacen->Estado == "1") Activo @else Inactivo @endif</button>
                </ul>
              </td>

              <td class="center">
      					<ul class="nav nav-pills">

                    <!-- Button modal edit -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $almacen->ID }}">
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
        <h4 class="modal-title">Registrar Almacen</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form-create" action="/almacenes" autocomplete="off">
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
                <input type="text" class="form-control" name="Nombre" placeholder="Ingresar nombre" required="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="Direccion" placeholder="Ingresar direccion" required="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control" name="Telefono1" placeholder="Ingresar telefono 1" data-inputmask="'mask':'(999) 999-9999'" data-mask>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control" name="Telefono2" placeholder="Ingresar telefono 2" data-inputmask="'mask':'(999) 999-9999'" data-mask>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar almacen</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($almacenes as $almacen)

<!-- Modal edit -->
<div class="modal fade modalReset" id="modal-update{{ $almacen->ID }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Almacen</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form{{ $almacen->ID }}" action="{!! action('AlmacenController@update', $almacen->ID ) !!}" autocomplete="off">
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
                <input type="text" class="form-control" name="Nombre" placeholder="Ingresar nombre" value="{{ $almacen->Nombre }}" required="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control" name="Direccion" placeholder="Ingresar direccion" value="{{ $almacen->Direccion }}" required="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control" name="Telefono1" placeholder="Ingrese telefono1" value="{{ $almacen->Telefono1 }}" data-inputmask="'mask':'(999) 999-9999'" data-mask>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control" name="Telefono2" placeholder="Ingrese telefono2" value="{{ $almacen->Telefono2 }}" data-inputmask="'mask':'(999) 999-9999'" data-mask>
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

<script>
$(".tablas").on('click', 'button.btnActivar', function() {
  var idAlmacen = $(this).attr("idAlmacen");
  var estadoAlmacen = $(this).attr("estadoAlmacen");
  var token = $(this).attr("data-token");

  $.ajax({
    type: "GET",
    url: "almacenes/"+idAlmacen+"/"+estadoAlmacen,
    //data: {"token": token},
    dataType: "json",
    success:function(respuesta){

      var mensaje;
      if (respuesta['Estado'] == 1){

        mensaje = "El almacen ha sido activado correctamente!";
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").removeClass('btn-danger');
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").addClass('btn-success');
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").empty();
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").attr("estadoAlmacen", 1);
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").append("<span class='glyphicon glyphicon-ok'></span> Activo");

      }
      else{

        mensaje = "El almacen ha sido desactivado correctamente!";
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").removeClass('btn-success');
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").addClass('btn-danger');
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").empty();
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").attr("estadoAlmacen", 0);
        $("button.btnActivar[idAlmacen='"+ idAlmacen +"']").append("<span class='glyphicon glyphicon-remove'></span> Inactivo");

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

@foreach($almacenes as $almacen)
<script>
$('#modal-update{{ $almacen->ID }}').on('hidden.bs.modal', function (e) {
  $('#form{{ $almacen->ID }}')[0].reset();
});
</script>
@endforeach
<!-- /.Reset forms -->

@stop
