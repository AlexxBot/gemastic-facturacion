@extends('layout.layout')

@section('content')

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          Modifique los datos del Perfil
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <form action="/perfiles/{{ $perfil->ID }}"  role='form' method="post" autocomplete="off">
              @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss='alert' aria-hidden='true'>x</button>
                  {{ $error }}
                </div>
              @endforeach
              {{ csrf_field() }}
  						{{ method_field('PUT') }}
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">

              <div class="form-group">
  							<label>Nombre</label>
  							<input type="text" value="{{$perfil->Nombre}}" class="form-control" name ='Nombre'>
  						</div>
  						<div class="form-group">
  							<label>Descripcion</label>
                <textarea  class="form-control" rows="3" name ='Descripcion'><?php echo $perfil->Descripcion ?></textarea>
  						</div>

              <button type="submit" class="btn btn-success">Guardar</button>
              <button type="reset" class="btn btn-warning">Limpiar</button>
              <button type="button" class="btn btn-danger" onClick="location.href='{!! action('PerfilController@index') !!}'">Volver</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop
