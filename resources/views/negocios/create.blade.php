@extends('layout.layout')

@section('estilos')

@stop

@section('content')

<!-- SELECT2 EXAMPLE -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Nuevo Negocio</h3>

    <div class="box-tools pull-right">
      <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    --></div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">

        <div class="form-group">
          <label>Razon Social:</label>
          <input type="text" class="form-control" name="RazonSocial">
        </div>

        <div class="form-group">
          <label>Denominacion:</label>
          <input type="text" class="form-control" name="Denominacion">
        </div>

        <div class="form-group">
          <label>Direccion:</label>
          <input type="text" class="form-control" name="Direccion">
        </div>

        <div class="form-group">
          <label>Telefono 1:</label>
          <input type="text" class="form-control" name="Telefono1">
        </div>

        <div class="form-group">
          <label>Telefono 2:</label>
          <input type="text" class="form-control" name="Telefono2">
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-6">
        <div class="form-group">
          <label>Email:</label>
          <input type="email" class="form-control" name="Email" placeholder="Enter email">
        </div>

        <div class="form-group">
          <label>Dir. Pagina Web:</label>
          <input type="url" class="form-control" name="Web" placeholder="Enter url">
        </div>

        <div class="form-group">
          <label>Representante Legal:</label>
          <input type="text" class="form-control" name="RepLegal">
        </div>

        <div class="form-group">
          <label>Estado:</label><br>
          <select class="form-control select2" style="width: 100%;">
            <option selected="selected">Activo</option>
            <option>Inactivo</option>
          </select>
        </div>

        <div class="form-group">
          <label>Ubigeo:</label>
          <input type="text" class="form-control" name="Ubigeo">
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
    the plugin.
  </div>
</div>
<!-- /.box -->




<!-- OTHER OPTION -->
<div class="box-body">
<div class="row">
  <!-- left column -->
  <div class="col-md-6">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Quick Example</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">

            <p class="help-block">Example block-level help text here.</p>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"> Check me out
            </label>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>
</div>

@stop

@section('js')

@stop

@section('jsope')

@stop
