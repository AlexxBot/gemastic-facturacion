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
<h1>Clientes<small></small></h1>
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
        @if($clientes->isEmpty())
        <div class="alert alert-success">
          <button type="button" class="close"
          data-dismiss="alert" aria-hidden="true">x</button>
          No se tiene ningun cliente registrado
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
              <th>Razon Social</th>
              <th>Tipo Documento</th>
              <th>Nro Documento</th>
              <th>Denominacion</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Estado</th>
              <th>Ubigeo</th>

            </tr>
            </thead>
            <tbody>

            @foreach($clientes as $cliente)
            <tr>
              <td>{{ $cliente->ID }}</td>
              <td>{{ $cliente->RazonSocial }}</td>
              <td>{{ $cliente->TipoDocumento }}</td>
              <td>{{ $cliente->NroDocumento }}</td>
              <td>{{ $cliente->Denominacion }}</td>
              <td>{{ $cliente->Direccion }}</td>
              <td>{{ $cliente->Telefono }}</td>
              <td>{{ $cliente->Email }}</td>
              <td class="center">
                <ul class="nav nav-pills">

                <button type="submit" idCliente="{{ $cliente->ID }}" estadoCliente="{{ $cliente->Estado }}" data-token="{{ csrf_token() }}" disabled="" @if($cliente->Estado == "1") class="btn btn-sm btnActivar btn-success" @else class="btn btn-sm btnActivar btn-danger" @endif>
                  <span @if($cliente->Estado == "1") class="glyphicon glyphicon-ok" @else class="glyphicon glyphicon-remove" @endif></span>@if($cliente->Estado == "1") Activo @else Inactivo @endif</button>

                </ul>
              </td>
              <td>{{ $cliente->Ubigeo}}</td>


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
        <h4 class="modal-title">Registrar Cliente</h4>
      </div>
      <form role="form" class="formReset" id="form-create" method="post" action="/clientes" autocomplete="off">
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
                  <input type="text" class="form-control" name="RazonSocial" placeholder="Razon Social" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="TipoDocumento">
                    <option value="01" selected="selected">DNI</option>
                    <option value="06">RUC</option>
                    <option value="08">PASAPORTE</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" class="form-control" name="NroDocumento" placeholder="Numero Documento" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Denominacion" placeholder="Denominacion">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Direccion:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Direccion" placeholder="Direccion">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Telefono 1:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" name="Telefono" placeholder="Telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Email:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                  <input type="email" class="form-control" name="Email" placeholder="Email">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Ubigeo" placeholder="Ubigeo">
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <!-- /.col -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar Cliente</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($clientes as $cliente)

<!-- Modal edit -->
<div class="modal fade  modalReset" id="modal-update{{ $cliente->ID }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Cliente</h4>
      </div>
      <form role="form" class="formReset" id="form{{ $cliente->ID }}" method="post" action="{!! action('ClienteController@update', $cliente->ID ) !!}" autocomplete="off">
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
                  <input type="text" class="form-control" name="RazonSocial" placeholder="Razon Social" value="{{ $cliente->RazonSocial }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="TipoDocumento">
                    <option value="01" @if($cliente->TipoDocumento == "01") selected @endif>DNI</option>
                    <option value="06" @if($cliente->TipoDocumento == "06") selected @endif>RUC</option>
                    <option value="08" @if($cliente->TipoDocumento == "08") selected @endif>PASAPORTE</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" class="form-control" name="NroDocumento" placeholder="Nro Documento" value="{{ $cliente->NroDocumento }}" required="">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Denominacion" placeholder="Denominacion" value="{{ $cliente->Denominacion }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Direccion" placeholder="Direccion" value="{{ $cliente->Direccion }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" name="Telefono" placeholder="Telefono" value="{{ $cliente->Telefono }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                  <input type="email" class="form-control" name="Email" placeholder="Email" value="{{ $cliente->Email }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Ubigeo" placeholder="Ubigeo" value="{{ $cliente->Ubigeo }}">
                </div>
                <!-- /.input group -->
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
      });
  });
</script>

<script>
$(".tablas").on('click', 'button.btnActivar', function(){
  var idCliente = $(this).attr("idCliente");
  var estadoCliente = $(this).attr("estadoCliente");
  $.ajax({
    type: "GET",
    url: "clientes/"+idCliente+"/"+estadoCliente,
    dataType: "json",
    success:function(respuesta){
      var mensaje;

      if (respuesta['Estado'] == 1){
        mensaje = "El Cliente ha sido activado correctamente!";
        $("button.btnActivar[idCliente='"+ idCliente +"']").removeClass('btn-danger');
        $("button.btnActivar[idCliente='"+ idCliente +"']").addClass('btn-success');

        $("button.btnActivar[idCliente='"+ idCliente +"']").empty();

        $("button.btnActivar[idCliente='"+ idCliente +"']").attr("estadoCliente", 1);
        $("button.btnActivar[idCliente='"+ idCliente +"']").append("<span class='glyphicon glyphicon-ok'></span> Activo");
      }
      else{
        mensaje = "El Cliente ha sido desactivado correctamente";
        $("button.btnActivar[idCliente='"+ idCliente +"']").removeClass('btn-success');
        $("button.btnActivar[idCliente='"+ idCliente +"']").addClass('btn-danger');

        $("button.btnActivar[idCliente='"+ idCliente +"']").empty();

        $("button.btnActivar[idCliente='"+ idCliente +"']").attr("estadoCliente", 0);
        $("button.btnActivar[idCliente='"+ idCliente +"']").append("<span class='glyphicon glyphicon-remove'></span> Inactivo");
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

@foreach($clientes as $cliente)
<script>
$('#modal-update{{ $cliente->ID }}').on('hidden.bs.modal', function (e) {
  $('#form{{ $cliente->ID }}')[0].reset();
});
</script>
@endforeach
<!-- /.Reset forms -->



@stop
