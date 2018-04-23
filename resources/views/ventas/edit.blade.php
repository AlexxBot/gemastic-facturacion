@extends(Auth::user()['Id_Perfil'] == 1 ? 'layout.layout' : 'layout.layoutVendedor')

@section('estilos')
<!-- Page Data -->

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
  input[type=number]::-webkit-outer-spin-button,
  input[type=number]::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
  }

  input[type=number] {
      -moz-appearance:textfield;
  }
</style>
<!-- /.Modal adminlte -->

@stop

@section('encabezado')
<h1>
  Ventas
  <small>Optional description</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
  <li class="active">Here</li>
</ol>
@stop

@section('content')
<div class="row">
  <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-6 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta"  >
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <div class="box-body">


              <div class="box">

                <!--=====================================
                ENTRADA DEL TIPO COMPROBANTE
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-shopping-cart"></i></span>

                    <select class="form-control" id="seleccionarTipoComprobante" name="seleccionarTipoComprobante" required>
                      <option value="">Seleccionar tipo comprobante</option>
                      @foreach($tipo_comprobantes as $tipo_comprobante)
                        <option value="{!! $tipo_comprobante->ID !!}" @if($venta->ID_TipoComprobante == $tipo_comprobante->ID) selected="" @endif>{{ $tipo_comprobante->Nombre }}</option>
                      @endforeach
                    </select>

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" data-token="{{ csrf_token() }}" required>

                      <option value="">Seleccionar cliente</option>
                      @foreach($clientes as $cliente)
                        <option value="{!! $cliente->ID !!}" @if($venta->ID_Cliente == $cliente->ID) selected="" @endif>{{ $cliente->RazonSocial }}</option>
                      @endforeach

                    </select>
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

                  </div>



                </div>

                <!--=====================================
                ENTRADA DEL IMPUESTO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control seleccionarImpuesto" id="seleccionarImpuesto" name="seleccionarImpuesto" required>



                      <option value="">Seleccionar Impuesto</option>
                      @foreach($impuestos as $impuesto)
                        <option id="{!! $impuesto->ID !!}" value="{!! $impuesto->ID !!}" @if($venta->ID_Impuesto == $impuesto->ID) selected="" @endif>{{ $impuesto->Nombre }}</option>
                      @endforeach

                    </select>

                  </div>



                </div>
                <!--=====================================
                ENTRADA DEL PRECIO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control seleccionarPrecio" id="seleccionarPrecio" name="seleccionarPrecio" required>

                        <option value="Precio1" selected >Precio1</opcion>
                        <option value="Precio2" >Precio2</opcion>
                        <option value="Precio3"  >Precio3</opcion>

                    </select>

                  </div>



                </div>

                <!--=====================================
                ENTRADA DEL SERIE
                ======================================-->



                <input type="hidden" class="form-control" id="nuevaSerie" name="nuevaSerie" value="{!! $venta->Serie !!}" readonly>

                <!--=====================================
                ENTRADA DEL NUMERO
                ======================================-->



                <input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="{!! $venta->Numero !!}" readonly>


                <div class="row" >
                    <div class="col-xs-4" style="padding-right:0px">
                        <label >Descripcion</label>
                    </div>

                    <div class="col-xs-2" style="padding-right:0px">
                        <label >Cantidad</label>
                    </div>

                     <div class="col-xs-2" style="padding-right:0px">
                           <label >Desc %</label>
                     </div>

                     <div class="col-xs-2" style="padding-left:0px">
                         <label >Desc fijo</label>
                     </div>

                     <div class="col-xs-2" style="padding-left:0px">
                        <label >Total </label>
                     </div>
                </div>


                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevoProducto">



                @if(!empty($detalle_ventas))

                @foreach($detalle_ventas as $detalle_venta)



                  <div class="row" style="padding:5px 15px">

    			          <!-- Descripcion del producto -->

        	          <div class="col-xs-4" style="padding-right:0px">

        	            <div class="input-group">

        	              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="{!! $detalle_venta->ID !!}"><i class="fa fa-times"></i></button></span>

        	              <input type="text" class="form-control nuevaDescripcionProducto" idProducto="{!! $detalle_venta->ID !!}" name="agregarProducto" value="{!! $detalle_venta->Nombre !!} {!! $detalle_venta->UnidadMedida !!}" readonly required>

        	            </div>

        	          </div>


        	          <!-- Cantidad del producto -->

        	          <div class="col-xs-2 ingresoCantidad" style="padding-right:0px">

          	             <input type="number" step="any" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0" value="{!! $detalle_venta->Cantidad !!}" stock="{!! $detalle_venta->Stock !!}" nuevoStock="{!! $detalle_venta->Stock !!}" required>

        	          </div>

                    <!-- Descuento del producto -->

                    <div class="col-xs-2 ingresoDescuentoPorcentual" style="padding-right:0px">

                        <input type="number" step="any" class="form-control nuevoDescuentoLinealPorcentual" descuentoPorcentual="0" name="nuevoDescuentoLinealPorcentual" min="0" max="100" value="{!! $detalle_venta->DescuentoPorcentual !!}" >

                    </div>

                    <div class="col-xs-2 ingresoDescuentoFijo" style="padding-left:0px">

                        <input type="number" step="any" class="form-control nuevoDescuentoLinealFijo" descuentoLineal="0" name="nuevoDescuentoLinealFijo" min="0" value="{!! $detalle_venta->DescuentoFijo !!}" >

                    </div>


      	            <!-- Precio del producto -->

        	          <div class="col-xs-2 ingresoPrecio" style="padding-left:0px">

        	            <div class="input-group">

                        <input type="hidden" class="form-control nuevoImpuestoLineal" name="nuevoImpuestoLineal" value="{!! $detalle_venta->Impuesto !!}" required>

        	              <input type="text" step="any" class="form-control nuevoPrecioProducto" precioReal="{!! $detalle_venta->PrecioUnitario !!}" name="nuevoPrecioProducto" value="{!! $detalle_venta->Total !!}" readonly required>

        	            </div>

                    </div>

                  </div>
                @endforeach
                @endif

                </div>







                <input type="hidden" id="listaProductos" name="listaProductos">


                <!-- -->

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col-xs-12 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>% IGV</th>
                          <th>Total</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 40%">

                            <div class="input-group">

                              <input type="number" class="form-control input-lg"  id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" value="{!! $venta->PorcentajeImpuesto !!}" readonly required>

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                            </div>


                          </td>

                           <td style="width: 60%">

                            <div class="input-group">

                              <span class="input-group-addon">S/.</i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta"  value="{!! $venta->Total !!}" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">


                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>


                  <!--=====================================
                  ENTRADA PARA EL DESCUENTO
                  ======================================-->

                  <div class="col-xs-12 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Descuento %</th>
                          <th>Descuento Fijo</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 40%">

                            <div class="input-group">

                              <input type="number" class="form-control input-lg"  id="nuevoDescuentoPorcentual" name="nuevoDescuentoPorcentual" min="0" placeholder="0" value="{!! $venta->DescuentoPorcentual !!}" required>



                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                            </div>

                          </td>

                           <td style="width: 60%">

                            <div class="input-group">

                              <span class="input-group-addon">S/.</i></span>

                              <input type="text" class="form-control input-lg" id="nuevoDescuentoFijo" name="nuevoDescuentoFijo" total="" placeholder="00000" value="{!! $venta->DescuentoFijo !!}" required>

                              <input type="hidden" name="totalVenta" id="totalVenta">


                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>



                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">

                  <div class="col-xs-4" style="padding-right:0px">

                     <div class="input-group">

                      <input type="text" class="form-control" id="nuevoMetodoPago" value="Pago" readonly>


                    </div>

                  </div>
                  <div class="col-xs-4">

            			 	<div class="input-group">

            			 		<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

            			 		<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>

            			 	</div>

            			 </div>

            			 <div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">

            			 	<div class="input-group">

            			 		<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

            			 		<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>

            			 	</div>

            			 </div>


                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                  </div>

                <br>
                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor" value="{{ Auth::user()['email'] }}" readonly>

                    <input type="hidden" name="idVendedor" value="1">

                  </div>

                </div>

              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>


        </div>

      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-6 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped  tablaVentas" width="100%" >
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th >Nombre</th>
                  <th >Unidad de Medida</th>
                  <th >Stock</th>
                  <th ></th>
                  <!--<th ></th>-->
                  <th ></th>
                  <th ></th>
                  <th >Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>


</div>
<!-- /.row -->

@stop



<!-- Modal create -->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" id="form-create" method="post" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Cliente</h4>
      </div>

      <div class="modal-body" style="padding:40px 50px;">

          @foreach($errors->all() as $error)
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss='alert' aria-hidden='true'>x</button>
              {{ $error }}
            </div>
          @endforeach
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="RazonSocial" placeholder="Razon Social">
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
                  <input type="number" class="form-control" name="NroDocumento" placeholder="Numero Documento">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Denominacion" placeholder="Denominacion">
                </div>

              </div>

              <div class="form-group">

                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Direccion" placeholder="Direccion">
                </div>

              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" name="Telefono" placeholder="Telefono">
                </div>

              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group">

                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                  <input type="email" class="form-control" name="Email" placeholder="Email">
                </div>

              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-control select2" style="width: 100%;" name="Estado">
                    <option value="1" selected="selected">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
              </div>

              <div class="form-group">

                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                  <input type="text" class="form-control" name="Ubigeo" placeholder="Ubigeo">
                </div>

              </div>
            </div>

          </div>

      </div>

      <div class="modal-footer">
        <button type="button" id="limpiar-create" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Guardar Cliente</button>
      </div>
      </form>
    </div>

  </div>

</div>



@section('js')


<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

@stop

@section('jsope')

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
$("#limpiar-create").click(function(event) {
  $("#form-create")[0].reset();
});
/*=============================================
CARGAR LA TABLA DINÃMICA
=============================================*/

var table2 = $('.tablaVentas').DataTable({

  "sprocessing": true,
  "sserverSide": true,

	"ajax":"{{route('api.index')}}",
  //"ajax":{url: "/listadoproductos"},

  "columns": [
      {"data" : "ID"},
      {"data" : "Nombre"},
      {"data" : "UnidadMedida"},
      {"data" : "Stock", render: $.fn.dataTable.render.number( ',', '.', 4, '' ) },
      /*{
        "sTitle":"Stock",
			 "defaultContent": '<div class="btn-group"><button class="btn btn-success limiteStock"></button></div>'

      },*/
      {"data" : "Precio1","sTitle":"Precio1", render: $.fn.dataTable.render.number( ',','.', 2, 'S/' ), name: 'Precio',visible:true },
      {"data" : "Precio2",visible:false },
      {"data" : "Precio3",visible:false },
      {
        "defaultContent": '<div class="btn-group"><button class="btn btn-primary agregarProducto recuperarBoton" idProducto data-token="{{ csrf_token() }}">Agregar</button></div>'
      }

  ],
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

})

/*=============================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES  ok
=============================================*/
$(".tablaVentas tbody").on( 'click', 'button.agregarProducto', function () {

	var data = table2.row( $(this).parents('tr') ).data();//sirve cuando el boton entra en la fila
  //var data = table2.row( this ).data();//sirve cuando el boton no entra en la fila
	$(this).attr("idProducto",data['ID']);
})
/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

/*=============================================
SELECCIONAR IMPUESTO
=============================================*/

$(".formularioVenta").on("change", "select.seleccionarImpuesto", function(){

	var id = $(this).val();
  var token = $(this).data("token");
  $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/impuestos/"+id,
      dataType:"json",
      type: "POST",
      contentType: false,
      processData: false,
      success: function(response) {
          var impuesto=response["Porcentaje"];
          $('#nuevoImpuestoVenta').val(impuesto);
      },
      error:function(response,status,error){/*alert(error);*/}
  });

  // SUMAR TOTAL DE PRECIOS


  //sumarTotalPrecios()

  // AGREGAR IMPUESTO

  agregarImpuesto()
  //agregarDescuentoPorcentual()
  //agregarDescuentoFijo()

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  //listarProductos()

  // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

  //$(".nuevoPrecioProducto").number(true, 2);
})


/*=============================================
SELECCIONAR PRECIO
=============================================*/

$(".formularioVenta").on("change", "select.seleccionarPrecio", function(){

	var precio = $(this).val();
  if(precio=="Precio1"){

    $('.tablaVentas').DataTable({
      //"ajax":{url: "/api"},
    	"destroy": true,
      "columns": [
          {"data" : "ID"},
          {"data" : "Nombre"},
          {"data" : "UnidadMedida"},
          {"data" : "Stock",render: $.fn.dataTable.render.number( ',', '.', 4, '' )},
          {"data" : "Precio1","sTitle":"Precio1", render: $.fn.dataTable.render.number( ',', '.', 2, 'S/' ), name: 'Precio',visible:true },
          {"data" : "Precio2",visible:false },
          {"data" : "Precio3",visible:false },
          {
            "defaultContent": '<div class="btn-group"><button class="btn btn-primary agregarProducto recuperarBoton" idProducto data-token="{{ csrf_token() }}">Agregar</button></div>'
          }

      ]
    })
  };
  if(precio=="Precio2"){

    $('.tablaVentas').DataTable({
      //"ajax":{url: "/api"},
    	"destroy": true,
      "columns": [
          {"data" : "ID"},
          {"data" : "Nombre"},
          {"data" : "UnidadMedida"},
          {"data" : "Stock",render: $.fn.dataTable.render.number( ',', '.', 4, '' )},
          {"data" : "Precio1",visible:false },
          {"data" : "Precio2","sTitle":"Precio2", render: $.fn.dataTable.render.number( ',', '.', 2, 'S/' ), name: 'Precio',visible:true },
          {"data" : "Precio3",visible:false },
          {
            "defaultContent": '<div class="btn-group"><button class="btn btn-primary agregarProducto recuperarBoton" idProducto data-token="{{ csrf_token() }}">Agregar</button></div>'
          }

      ]
    })
  };
  if(precio=="Precio3"){

    $('.tablaVentas').DataTable({
      //"ajax":{url: "/api"},
    	"destroy": true,
      "columns": [
          {"data" : "ID"},
          {"data" : "Nombre"},
          {"data" : "UnidadMedida"},
          {"data" : "Stock",render: $.fn.dataTable.render.number( ',', '.', 4, '' )},


          {"data" : "Precio1",visible:false },
          {"data" : "Precio2",visible:false },
          {"data" : "Precio3","sTitle":"Precio3", render: $.fn.dataTable.render.number( ',', '.', 2, 'S/' ), name: 'Precio',visible:true },
          {
            "defaultContent": '<div class="btn-group"><button class="btn btn-primary agregarProducto recuperarBoton" idProducto data-token="{{ csrf_token() }}">Agregar</button></div>'
          }

      ]
    })
  };

})


/*=============================================
FUNCIÃ“N PARA CARGAR LAS IMÃGENES CON EL PAGINADOR Y EL FILTRO
=============================================*/

/*
function cargarStock(){

  var data = table.row( $(this).parents('tr') ).data();

	 var limiteStock = $(".limiteStock");

	 for(var i = 0; i < limiteStock.length; i ++){

	    var data = table2.row( $(limiteStock[i]).parents('tr') ).data();

	    if(data['Stock'] < 10){

	    	$(limiteStock[i]).addClass("btn-danger");
	    	$(limiteStock[i]).html(data['Stock']);

	    }else{

	    	$(limiteStock[i]).addClass("btn-success");
	    	$(limiteStock[i]).html(data['Stock']);
	    }

  	}


}

$('.tablaVentas').on( 'draw.dt', function () {

  cargarStock();

})
*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");
  //alert(idProducto);
  var token = $(this).data("token");
  var combo_precio=$('select[id=seleccionarPrecio]').val();

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");
     $.ajax({
        type: "POST",
     	  url: "/agregarproducto/"+idProducto,
        data: {
          "_token": token,
        },
      	dataType:"json",
      	success:function(producto){
            var id=producto["ID"];
      	    var descripcion = producto["Nombre"];
            var unidadmedida = producto["UnidadMedida"];
          	var stock = producto["Stock"];


            if(combo_precio=="Precio1")
            {
          	   var precio = producto["Precio1"];
            };
            if(combo_precio=="Precio2")
            {
          	   var precio = producto["Precio2"];
            };
            if(combo_precio=="Precio3")
            {
          	   var precio = producto["Precio3"];
            };

            var impuesto = precio*$("#nuevoImpuestoVenta").val()/100;

            var preciofinal=precio+impuesto;


          	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			          '<!-- Descripcion del producto -->'+

    	          '<div class="col-xs-4" style="padding-right:0px">'+

    	            '<div class="input-group">'+

    	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

    	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+' '+unidadmedida+'" readonly required>'+

    	            '</div>'+

    	          '</div>'+


    	          '<!-- Cantidad del producto -->'+

    	          '<div class="col-xs-2 ingresoCantidad" style="padding-right:0px">'+

      	             '<input type="number" step="any" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

    	          '</div>'+

                '<!-- Descuento del producto -->'+

                '<div class="col-xs-2 ingresoDescuentoPorcentual" style="padding-right:0px">'+

                    '<input type="number" step="any" class="form-control nuevoDescuentoLinealPorcentual" descuentoPorcentual="0" name="nuevoDescuentoLinealPorcentual" min="0" max="100" value="0" >'+

                '</div>' +

                '<div class="col-xs-2 ingresoDescuentoFijo" style="padding-left:0px">'+

                    '<input type="number" step="any" class="form-control nuevoDescuentoLinealFijo" descuentoLineal="0" name="nuevoDescuentoLinealFijo" min="0" value="0" >'+

                '</div>' +


  	            '<!-- Precio del producto -->'+

    	          '<div class="col-xs-2 ingresoPrecio" style="padding-left:0px">'+

    	            '<div class="input-group">'+

                    '<input type="hidden" class="form-control nuevoImpuestoLineal" name="nuevoImpuestoLineal" value="'+impuesto+'" required>'+

    	              '<input type="text" step="any" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+preciofinal+'" readonly required>'+

    	            '</div>'+

                '</div>'+

	        '</div>')

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios()

	        // AGREGAR IMPUESTO

	        agregarImpuesto()
          //agregarDescuentoPorcentual()
          //agregarDescuentoFijo()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON
	        listarProductos()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);


      	}

     })

});


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÃ“N
=============================================*/

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto")==null){

		idQuitarProducto = [];

	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		//$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO

        agregarImpuesto()
        //agregarDescuentoPorcentual()
        //agregarDescuentoFijo()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()
	}

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÃ“N PARA DISPOSITIVOS
=============================================*/

$(".btnAgregarProducto").click(function(){

	$.ajax({

		    url:"/listarproductos",
        type: "GET",
      	dataType:"json",
      	success:function(respuesta){

          $(".nuevoProducto").append(

          '<div class="row" style="padding:5px 15px">'+

          '<!-- Descripcion del producto -->'+

          '<div class="col-xs-4" style="padding-right:0px">'+

            '<div class="input-group">'+

              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

              '<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>'+

                '<option>Seleccione el producto</option>'+

              '</select>'+

            '</div>'+

          '</div>'+

          '<!-- Cantidad del producto -->'+

          '<div class="col-xs-2 ingresoCantidad" style="padding-right:0px">'+

             '<input type="number" step="any" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0" value="1" stock nuevoStock required>'+

          '</div>' +

          '<!-- Descuento del producto -->'+

          '<div class="col-xs-2 ingresoDescuentoPorcentual" style="padding-right:0px">'+

              '<input type="number" step="any" class="form-control nuevoDescuentoLinealPorcentual" descuentoPorcentual="0" name="nuevoDescuentoLinealPorcentual" min="0" max="100" value="0" >'+

          '</div>' +

          '<div class="col-xs-2 ingresoDescuentoFijo" style="padding-left:0px">'+

              '<input type="number" step="any" class="form-control nuevoDescuentoLinealFijo" descuentoLineal="0" name="nuevoDescuentoLinealFijo" min="0" value="0" >'+

          '</div>' +

          '<!-- Precio del producto -->'+

          '<div class="col-xs-2 ingresoPrecio" style="padding-left:0px">'+

            '<div class="input-group">'+

              '<input type="hidden" class="form-control nuevoImpuestoLineal" name="nuevoImpuestoLineal"  value="" required>'+

              '<input type="text" step="any" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" value="" readonly required>'+

            '</div>'+

          '</div>'+

        '</div>');


	        // AGREGAR LOS PRODUCTOS AL SELECT

          respuesta.forEach(funcionForEach);

          function funcionForEach(item, index){

            $(".nuevaDescripcionProducto").append(

                '<option idProducto="'+item.id+'" value="'+item.ID+'">'+item.Nombre+' '+item.UnidadMedida+'</option>'
            )


	         }
	         // SUMAR TOTAL DE PRECIOS

    		     sumarTotalPrecios()

    		       // AGREGAR IMPUESTO

	        agregarImpuesto()
          //agregarDescuentoPorcentual()
          //agregarDescuentoFijo()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);

      	}


	})

})



/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var idProducto = $(this).val();

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
  var nuevoImpuestoLineal = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevoImpuestoLineal");

	var combo_precio=$('select[id=seleccionarPrecio]').val();
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       type: "POST",
        url: "/agregarproducto/"+idProducto,
       //method: "POST",
       data: {},
       dataType:"json",
       contentType: false,
       processData: false,
       success:function(producto){
         //alert(producto);

      	    $(nuevaDescripcionProducto).attr("idProducto", producto["ID"]);
      	    $(nuevaCantidadProducto).attr("stock", producto["Stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(producto["Stock"])-1);
            var precio=0;
            if(combo_precio=="Precio1")
            {
        	    //$(nuevoPrecioProducto).val(producto["Precio1"]);
        	    //$(nuevoPrecioProducto).attr("precioReal", producto["Precio1"]);
              precio= producto["Precio1"];
            };
            if(combo_precio=="Precio2")
            {
        	    //$(nuevoPrecioProducto).val(producto["Precio2"]);
        	    //$(nuevoPrecioProducto).attr("precioReal", producto["Precio2"]);
              precio= producto["Precio2"];
            };
            if(combo_precio=="Precio3")
            {
        	    //$(nuevoPrecioProducto).val(producto["Precio2"]);
        	    //$(nuevoPrecioProducto).attr("precioReal", producto["Precio2"]);
              precio= producto["Precio3"];
            };

            $(nuevoPrecioProducto).attr("precioReal", precio);

            var impuesto = precio*$("#nuevoImpuestoVenta").val()/100;

            $(nuevoImpuestoLineal).attr("impuesto", impuesto);

            var preciofinal=precio+impuesto;

            $(nuevoPrecioProducto).val(preciofinal);



  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})


/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){


	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  var descuentoPorcentual = $(this).parent().parent().children(".ingresoDescuentoPorcentual").children(".nuevoDescuentoLinealPorcentual");
  var descuentoFijo = $(this).parent().parent().children(".ingresoDescuentoFijo").children(".nuevoDescuentoLinealFijo");

  //var descuento=descuentoPorcentual.val()*subtotal/100;

  var impuesto = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoImpuestoLineal");

  var subtotal=precio.attr("precioReal")*$(this).val();

  var descuento=descuentoPorcentual.val()*subtotal/100;

  var subtotal=precio.attr("precioReal")*$(this).val()-descuento;

  var impuestosuma = $("#nuevoImpuestoVenta").val()*subtotal/100;

	var precioFinal =subtotal+impuestosuma;
  //var equivalencia = precio.attr("equivalencia");

  impuesto.val(impuestosuma);
  descuentoFijo.val(descuento);
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - Number($(this).val());

	$(this).attr("nuevoStock", nuevoStock);
  //recuperar la equivalencia y el stock
  //alert( nuevoStock);


	if(Number($(this).val()) > Number($(this).attr("stock"))){

		$(this).val(1);

		swal({
	      title: "La cantidad supera el Stock",
	      text: "Solo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "Cerrar!"
	    });

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO

    agregarImpuesto()
    //agregarDescuentoPorcentual()
    //agregarDescuentoFijo()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})

/*=============================================
MODIFICAR Descuento Porcentual
=============================================*/

$(".formularioVenta").on("change", "input.nuevoDescuentoLinealPorcentual", function(){


	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  var descuento = $(this).parent().parent().children(".ingresoDescuentoFijo").children(".nuevoDescuentoLinealFijo");
  var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto").val();

  var impuesto = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoImpuestoLineal");

  var subtotal=precio.attr("precioReal")*cantidad;

  var descuentoFijo=$(this).val()*subtotal/100;

	var preciosinimpuesto= subtotal-descuentoFijo;

  var impuestosuma = preciosinimpuesto * $("#nuevoImpuestoVenta").val() /100;

  var precioFinal = preciosinimpuesto+impuestosuma;

  //var equivalencia = precio.attr("equivalencia");

	precio.val(precioFinal);
  descuento.val(descuentoFijo);
  impuesto.val(impuestosuma);
	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO

    agregarImpuesto()
    //agregarDescuentoPorcentual()
    //agregarDescuentoFijo()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})



/*=============================================
MODIFICAR Descuento Fijo
=============================================*/

$(".formularioVenta").on("change", "input.nuevoDescuentoLinealFijo", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  var descuento = $(this).parent().parent().children(".ingresoDescuentoPorcentual").children(".nuevoDescuentoLinealPorcentual");
  var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto").val();

  var impuesto = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoImpuestoLineal").attr("impuesto");

  var subtotal=precio.attr("precioReal")*cantidad;

  var descuentoPorcentual=$(this).val()*100/subtotal;

	var preciosinimpuesto= subtotal-$(this).val();

  var impuestosuma = preciosinimpuesto * $("#nuevoImpuestoVenta").val() /100;

  var precioFinal = preciosinimpuesto+impuestosuma;


	precio.val(precioFinal);
  descuento.val(descuentoPorcentual);
	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO

    agregarImpuesto()
    //agregarDescuentoPorcentual()
    //agregarDescuentoFijo()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));

	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}

/*=============================================
FUNCIÃ“N AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

	var impuesto = $("#nuevoImpuestoVenta").val();

	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
  //alert(totalConImpuesto);

	$("#nuevoTotalVenta").val(totalConImpuesto);

  $("#nuevoTotalVenta").attr("total",totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);


	$("#nuevoPrecioNeto").val(precioTotal);



}


/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function(){

	agregarImpuesto()

});


$("select.nuevoImpuestoVenta").change(function(){

	agregarImpuesto()

});

/*=============================================
FUNCIÃ“N AGREGAR DESCUENTO
=============================================*/

function agregarDescuentoFijo(){

	var descuentoPorcentual = $("#nuevoDescuentoPorcentual").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");
	var descuentoFijo =  Number(precioTotal * descuentoPorcentual/100);

	var totalConImpuesto = Number(precioTotal-descuentoFijo);

  $("#nuevoDescuentoFijo").val(descuentoFijo);

	$("#nuevoTotalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);
  sumarTotalPrecios()

	// AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoDescuentoPorcentual").change(function(){

	agregarDescuentoFijo();

});


/*=============================================
FUNCIÃ“N AGREGAR DESCUENTO
=============================================*/

function agregarDescuentoPorcentual(){

	var descuentoFijo = $("#nuevoDescuentoFijo").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");

	var totalConImpuesto = Number(precioTotal-descuentoFijo);

  var descuentoPorcentual =  Number((precioTotal-totalConImpuesto)*100/precioTotal);

  $("#nuevoDescuentoPorcentual").val(descuentoPorcentual);

	$("#nuevoTotalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);
  sumarTotalPrecios()

	// AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoDescuentoFijo").change(function(){

	agregarDescuentoPorcentual();

});


/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

//$("#nuevoTotalVenta").number(true, 2);


/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){


	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

  var descuentoPorcentual = $(".nuevoDescuentoLinealPorcentual");
  var descuentoFijo = $(".nuevoDescuentoLinealFijo");

  var impuestolineal = $(".nuevoImpuestoLineal");


	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"),
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
                "descuento_porcentual" : $(descuentoPorcentual[i]).val(),
                "descuento_fijo" : $(descuentoFijo[i]).val(),
                "impuesto_lineal" : $(impuestolineal[i]).val(),
							  "total" : $(precio[i]).val()})

	}

	$("#listaProductos").val(JSON.stringify(listaProductos));

}


/*=============================================
BOTON EDITAR VENTA
=============================================*/

$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");
	console.log("idVenta", idVenta);

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})


/*=============================================
BORRAR VENTA
=============================================*/

$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: '¿Esta seguro de borrar la venta?',
        text: "Si no lo esta¡ puede cancelar la accion!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result) {
        if (result.value) {

            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })

})






</script>


@stop
