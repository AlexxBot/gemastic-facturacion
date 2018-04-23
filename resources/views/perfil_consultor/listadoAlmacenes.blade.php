@extends('layout.layoutConsultor')

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

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        @if($almacenes->isEmpty())
        <div class="alert alert-success">
          <button type="button" class="close"
          data-dismiss="alert" aria-hidden="true">x</button>
          No se tiene ningun almacen
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
                  <button type="button" idAlmacen="{{ $almacen->ID }}" disabled="" estadoAlmacen="{{ $almacen->Estado }}" data-token="{{ csrf_token() }}" @if($almacen->Estado == "1") class="btn btn-sm btnActivar btn-success" @else class="btn btn-sm btnActivar btn-danger" @endif>
                    <span @if($almacen->Estado == "1") class="glyphicon glyphicon-ok" @else class="glyphicon glyphicon-remove" @endif></span>@if($almacen->Estado == "1") Activo @else Inactivo @endif</button>
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


@stop
