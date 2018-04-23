@extends('layout.layout')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>

@section('content')

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          Ingrese los datos del Perfil
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <form action="/perfiles"  role='form' method="post" autocomplete="off">
              @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss='alert' aria-hidden='true'>x</button>
                  {{ $error }}
                </div>
              @endforeach

              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name ='Nombre'>
              </div>
              <div class="form-group">
                <label>Descripcion</label>
                <!--<input type="text" class="form-control" name ='Descripcion'>-->
                <textarea class="form-control" rows="3" placeholder="Enter ..." name ='Descripcion'></textarea>
              </div>



              <div class="container">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-primary" id="myBtn">Nuevo</button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header" style="padding:10px 15px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Agregar Perfil</h4>
                      </div>
                      <div class="modal-body" style="padding:40px 50px;">
                        <form action="/perfiles"  role='form' method="post" autocomplete="off">

                          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                          <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name ='Nombre'>
                          </div>
                          <div class="form-group">
                            <label>Descripcion</label>
                            <!--<input type="text" class="form-control" name ='Descripcion'>-->
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name ='Descripcion'></textarea>
                          </div>
                          <button type="button" class="btn btn-danger" onClick="location.href='{!! action('PerfilController@index') !!}'">Volver</button>
                          <button type="reset" class="btn btn-warning">Limpiar</button>
                          <td style="right:inherit"><button type="submit" class="btn btn-success">Guardar</button>

                        </form>
                      </div>

                    </div>

                  </div>
                </div>
              </div>

              <script>
              $(document).ready(function(){
                  $("#myBtn").click(function(){
                      $("#myModal").modal();
                  });
              });
              </script>




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
