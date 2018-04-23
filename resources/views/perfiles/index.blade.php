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
  Perfiles
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
          Agregar Perfil
        </button>
        <!-- /.Button modal create -->

        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

      @if($perfiles->isEmpty())
      <div class="alert alert-success">
        <button type="button" class="close"
        data-dismiss="alert" aria-hidden="true">x</button>
        No se tiene ningun perfil registrado <a href="#"
        class="alert-link">Registre Perfiles</a>
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
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>

          @foreach($perfiles as $perfil)
          <tr>
            <td>{{ $perfil->ID }}</td>
            <td>{{ $perfil->Nombre }}</td>
            <td>{{ $perfil->Descripcion }}</td>

            <td class="center">
    					<ul class="nav nav-pills">

                  <!-- Button modal edit -->
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $perfil->ID }}">
                  <span class="glyphicon glyphicon-pencil"></span>
                  </button>
                  <!-- Button modal edit -->

                  <!-- Button modal delete -->
                  <button type = "button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete{{ $perfil->ID }}">
                  <span class="glyphicon glyphicon-trash"></span>
                  </button>
                  <!-- Button modal delete -->

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

@stop



<!-- Modal create -->
<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Perfil</h4>
      </div>
      <form role="form" id="form-create" method="post" action="/perfiles" autocomplete="off">
      <div class="modal-body" style="padding:40px 50px;">

          @foreach($errors->all() as $error)
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss='alert' aria-hidden='true'>x</button>
              {{ $error }}
            </div>
          @endforeach
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" name="Nombre" placeholder="Nombre">
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
              <textarea class="form-control" rows="3" placeholder="Descripcion" name ='Descripcion'></textarea>
              <!--<input type="text" class="form-control" name="Descripcion" placeholder="Descripcion">-->
            </div>
          </div>



      </div>
      <div class="modal-footer">
        <button type="button" id="limpiar-create" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar Perfil</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal create -->

@foreach($perfiles as $perfil)

<!-- Modal edit -->
<div class="modal fade" id="modal-update{{ $perfil->ID }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Perfil</h4>
      </div>
      <form role="form" id="form{{ $perfil->ID }}" method="post" action="{!! action('PerfilController@update', $perfil->ID ) !!}" autocomplete="off">
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

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" name="Nombre" placeholder="Nombre" value="{{ $perfil->Nombre }}">
            </div>
            <!-- /.input group -->
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
              <textarea class="form-control" rows="3" placeholder="Descripcion" name ='Descripcion'>{{ $perfil->Descripcion }}</textarea>
            </div>
            <!-- /.input group -->
          </div>

      </div>
      <div class="modal-footer">
        <button type="button"  onclick="myFunction({{ $perfil->ID }})" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
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

<!-- Modal delete -->
<div class="modal modal-danger fade" id="modal-delete{{ $perfil->ID }}" data-backdrop="static">
	<div class="modal-dialog" style="width: 350px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-warning"></i> Eliminar Perfil </h4>
			</div>
			<form method="post" action="{!! action('PerfilController@destroy', $perfil->ID ) !!}">
				{!! csrf_field() !!}
				{!! method_field('DELETE') !!}
				<div class="modal-body">
					<div class="box-body table-responsive">
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12">
									<input type="hidden" id="delete-id" name="delete-id" />
									<input type="hidden" id="delete-title" name="delete-title" />
									<p>Estas seguro que quieres eliminar este perfil ?</p>
									<div class="callout callout-danger">
										<p>Nombre : <span class="delete-title"> {{ $perfil->Nombre }}</span></p>

									</div>
								</div>
							</div>
						</div>
					</div><!-- /.box-body -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
					<button id="btn-delete" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Continuar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.Modal delete -->

@endforeach

@section('js')

<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>


@stop

@section('jsope')

<!-- Responsive -->
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
