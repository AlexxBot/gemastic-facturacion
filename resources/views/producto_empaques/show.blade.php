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

        <!-- Button modal create -->
        <button type="button" class="btn btn-primary" data-toggle="modal" id="buttonn" data-target="#modal-create" data-backdrop="static" data-keyboard="false"><!--data-target="#modal"-->
          Agregar Presentacion
        </button>

        </h3>
        <br></br>
        <div class="col-xs-6">
          <div class="row">




            <div class="form-group">
              <!--<label>Ubigeo:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control"  value="{{ $producto->Nombre }}" readonly="">
              </div>
              <!-- /.input group -->
            </div>

            <div class="form-group">
              <!--<label>Ubigeo:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control"  value="{{ $producto->Descripcion }}" readonly="">
              </div>
              <!-- /.input group -->
            </div>

            <div class="form-group">
              <!--<label>Ubigeo:</label>-->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                <input type="text" class="form-control"  value="{{ $producto->Unidad_Medida->Nombre }}" readonly="">
              </div>
              <!-- /.input group -->
            </div>
          </div>
        </div>


        <br></br>
        <br></br>
        <br></br>
        <br></br>



      <!-- /.box-header -->
      <div class="box-body">

      @if($producto_empaques->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ningun producto_empaque derivado registrado <a href="#"
        class="alert-link">Registre Productos</a>
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
            <th>Acciones</th>
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

            <td class="center">
    					<ul class="nav nav-pills">

                  <!-- Button modal edit -->
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $producto_empaque->ID_UnidadMedida }}">
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
<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Producto</h4>
      </div>
      <form role="form" id="form-create" method="post" action="{!! action('Producto_EmpaqueController@nuevo', [$producto->ID]) !!}" autocomplete="off">
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
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="ID_UnidadMedida">
                    <option value="" select >seleccione unidad de medida</opcion>
                    @foreach($unidad_medidas as $unidad_medida)
                      <option value="{!! $unidad_medida->ID !!}" >{{ $unidad_medida->CodigoPeru }} {{ $unidad_medida->Nombre }} </opcion>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio1" placeholder="Precio1">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio2" placeholder="Precio2">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio3" placeholder="Precio3">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Equivalencia" placeholder="Equivalencia">
                </div>
                <!-- /.input group -->
              </div>
            </div>


      </div>
      <div class="modal-footer">
        <button type="button" id="limpiar-create" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar Producto</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($producto_empaques as $producto_empaque)

<!-- Modal edit -->
<div class="modal fade" id="modal-update{{ $producto_empaque->ID_UnidadMedida }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Producto</h4>
      </div>
      <form role="form" id="form{{ $producto_empaque->ID_UnidadMedida }}" method="post" action="{!! action('Producto_EmpaqueController@update', $producto->ID."-".$producto_empaque->ID_UnidadMedida ) !!}" autocomplete="off">
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
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio1" placeholder="Precio1" value="{{ $producto_empaque->Precio1 }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio2" placeholder="Precio2" value="{{ $producto_empaque->Precio2 }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Precio3" placeholder="Precio3" value="{{ $producto_empaque->Precio3 }}">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <!--<label>Ubigeo:</label>-->
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="number" step="any" class="form-control" name="Equivalencia" placeholder="Equivalencia" value="{{ $producto_empaque->Equivalencia}}">
                </div>
                <!-- /.input group -->
              </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" onclick="myFunction({{ $producto_empaque->ID_UnidadMedida }})" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
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

<script>
   $("#limpiar-create").click(function(event) {
	   $("#form-create")[0].reset();
   });
</script>
<script>
  function myFunction(item) {
    var str1 = "#form";
    var res = str1.concat(item);
    $(res)[0].reset();

}
</script>

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
