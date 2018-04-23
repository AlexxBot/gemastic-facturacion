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
  Motivos de movimiento
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
          Agregar motivo de movimiento
        </button>
        <!-- /.Button modal create -->

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

      @if($motivo_movimientos->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ningun motivo de movimientos <a href="#"
        class="alert-link">Registre motivos de movimiento</a>
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
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>

          @foreach($motivo_movimientos as $motivo_movimiento)
          <tr>
            <td>{{ $motivo_movimiento->ID }}</td>
            <td>{{ $motivo_movimiento->Nombre }}</td>
            <td>{{ $motivo_movimiento->Descripcion }}</td>

            <td class="center">
              <ul class="nav nav-pills">

              <button type="button" idMotivo="{{ $motivo_movimiento->ID }}" estadoMotivo="{{ $motivo_movimiento->Estado }}" data-token="{{ csrf_token() }}" @if($motivo_movimiento->Estado == "1") class="btn btn-sm btnActivar btn-success" @else class="btn btn-sm btnActivar btn-danger" @endif>
                <span @if($motivo_movimiento->Estado == "1") class="glyphicon glyphicon-ok" @else class="glyphicon glyphicon-remove" @endif></span>@if($motivo_movimiento->Estado == "1") Activo @else Inactivo @endif</button>

              </ul>
            </td>

            <td class="center">
    					<ul class="nav nav-pills">

                  <!-- Button modal edit -->
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $motivo_movimiento->ID }}">
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
<div class="modal fade  modalReset" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar motivo de movimiento</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form-create" action="/motivo_movimientos" autocomplete="off">
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
                <textarea rows="3" class="form-control" name="Descripcion" placeholder="Ingresar descripcion"></textarea>
              </div>
            </div>

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar motivo de movimiento</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($motivo_movimientos as $motivo_movimiento)

<!-- Modal edit -->
<div class="modal fade modalReset" id="modal-update{{ $motivo_movimiento->ID }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar motivo de movimiento</h4>
      </div>
      <form role="form" class="formReset" method="post" id="form{{ $motivo_movimiento->ID }}" action="{!! action('Motivo_MovimientoController@update', $motivo_movimiento->ID ) !!}" autocomplete="off">
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
                  <input type="text" class="form-control" name="Nombre" placeholder="Ingresar nombre" value="{{ $motivo_movimiento->Nombre }}" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <textarea rows="3" class="form-control" name="Descripcion" placeholder="Ingresar descripcion">{{ $motivo_movimiento->Descripcion }}</textarea>
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
  var idMotivo = $(this).attr("idMotivo");
  var estadoMotivo = $(this).attr("estadoMotivo");
  var token = $(this).attr("data-token");

  $.ajax({
    type: "GET",
    url: "motivo_movimientos/"+idMotivo+"/"+estadoMotivo,
    //data: {"token": token},
    dataType: "json",
    success:function(respuesta){

      var mensaje;
      if (respuesta['Estado'] == 1){

        mensaje = "El motivo movimiento ha sido activado correctamente!";
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").removeClass('btn-danger');
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").addClass('btn-success');
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").empty();
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").attr("estadoMotivo", 1);
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").append("<span class='glyphicon glyphicon-ok'></span> Activo");

      }
      else{

        mensaje = "El motivo movimiento ha sido desactivado correctamente!";
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").removeClass('btn-success');
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").addClass('btn-danger');
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").empty();
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").attr("estadoMotivo", 0);
        $("button.btnActivar[idMotivo='"+ idMotivo +"']").append("<span class='glyphicon glyphicon-remove'></span> Inactivo");

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

@foreach($motivo_movimientos as $motivo_movimiento)
<script>
$('#modal-update{{ $motivo_movimiento->ID }}').on('hidden.bs.modal', function (e) {
  $('#form{{ $motivo_movimiento->ID }}')[0].reset();
});
</script>
@endforeach
<!-- /.Reset forms -->
@stop
