<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbGemasticFacturacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
      {
          //
          Schema::create('negocios',function($table){
            $table->increments('ID');

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('Ruc',15);
            $table->string('RazonSocial',250)->required();//->nullable($value = false);
            $table->string('Denominacion',150)->nullable();
            $table->string('Direccion',150)->required();//->nullable($value = false);
            $table->string('Telefono1',25)->nullable();
            $table->string('Telefono2',25)->nullable();
            $table->string('Email',100)->required();//->nullable($value = false);
            $table->string('Web',100)->nullable();
            $table->string('RepLegal',150)->nullable();
            $table->tinyInteger('Estado')->required();//->nullable($value = false);
            $table->string('Ubigeo',16)->nullable();
          });

          Schema::create('perfiles',function($table){
            $table->increments('ID');

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('Nombre',50)->required();//->nullable($value = false);
            $table->text('Descripcion')->required();//->nullable($value = false);
          });



          Schema::create('clientes',function($table){
            $table->increments('ID');

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('RazonSocial',250)->required();//->nullable($value = false);
            $table->string('TipoDocumento',2)->required();//->nullable($value = false);
            $table->string('NroDocumento',25)->required();//->nullable($value = false);
            $table->string('Denominacion',150)->nullable();
            $table->string('Direccion',150)->nullable();
            $table->string('Telefono',25)->nullable();
            $table->string('Email',100)->nullable();
            $table->tinyInteger('Estado')->required();//->nullable($value = false);
            $table->string('Ubigeo',16)->nullable();
          });

          Schema::create('tipo_comprobantes',function($table){
            $table->string('ID',2)->required();

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('Abreviacion',3)->required();//->nullable($value = false);
            $table->string('Nombre',50)->required();//->nullable($value = false);

            $table->primary('ID');
          });

          Schema::create('numeracion_series',function($table){
            $table->increments('ID');

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('CodigoSerie',4)->required();//->nullable($value = false);
            $table->unsignedBigInteger('NumeroActual')->required();//->nullable($value = false);
            $table->string('ID_TipoComprobante')->required();
            $table->unsignedInteger('ID_Negocio')->required();

            $table->foreign('ID_TipoComprobante')->references('ID')->on('tipo_comprobantes');
            $table->foreign('ID_Negocio')->references('ID')->on('negocios');
          });

          Schema::create('impuestos',function($table){
            $table->string('ID',3)->required();

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('Nombre',100)->required();//->nullable($value = false);
            $table->float('Porcentaje',10,2)->required();//->nullable($value = false);
            $table->float('Fijo',15,4)->nullable();

            $table->primary('ID');
          });

          Schema::create('motivo_anulaciones', function($table){
              $table->string('ID',3)->required();
              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->primary('ID');
              $table->string('Nombre', 150)->required();
              $table->text('Descripcion')->nullable();
          });

          Schema::create('ventas',function($table){
            $table->increments('ID');

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('Serie',4)->required();
            $table->string('Numero',8)->required();
            $table->dateTime('Fecha')->required();
            $table->unsignedInteger('ID_Cliente')->required();
            $table->float('MontoBruto',15,4)->required();
            $table->float('Impuesto',15,4)->required();
            $table->float('Total',15,4)->required();
            $table->float('MontoReal',15,4)->required();
            $table->float('DescuentoFijo',15,4)->nullable();
            $table->float('DescuentoPorcentual',15,4)->nullable();
            $table->tinyInteger('Estado')->required();
            $table->string('ID_MotivoAnulacion',3)->nullable(); //falta tabla
            $table->string('ID_TipoComprobante',2)->required();
            $table->string('ID_Impuesto',3)->required();
            $table->unsignedInteger('ID_Negocio')->required();
            $table->float('PorcentajeImpuesto',10,2)->required();

            $table->foreign('ID_Cliente')->references('ID')->on('clientes');
            $table->foreign('ID_MotivoAnulacion')->references('ID')->on('motivo_anulaciones');
            $table->foreign('ID_TipoComprobante')->references('ID')->on('tipo_comprobantes');
            $table->foreign('ID_Impuesto')->references('ID')->on('impuestos');
            $table->foreign('ID_Negocio')->references('ID')->on('negocios');
          });

          Schema::create('unidad_medidas',function($table){
            $table->increments('ID');

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('CodigoPeru',15)->required();
            $table->string('Nombre',100)->required();
            $table->string('CodigoSunat',15)->required();
            $table->string('NombreSunat',100)->required();
          });

          Schema::create('fabricantes',function($table){
            $table->increments('ID');

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->string('Ruc',15)->nullable();
            $table->string('RazonSocial',250)->required();
            $table->string('Direccion',150)->nullable();
            $table->string('Telefono',25)->nullable();
            $table->string('Web',100)->nullable();
          });

          Schema::create('categorias', function($table){
              $table->increments('ID');

              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->string('CodigoSunat', 50)->nullable();
              $table->string('Nombre', 150)->required();
              $table->text('Descripcion')->nullable();
          });

          Schema::create('productos', function($table){
              $table->increments('ID');

              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->string('CodigoSunat', 50);
              $table->unsignedInteger('ID_UnidadMedida')->required();
              $table->string('Nombre', 150)->required();
              $table->text('Descripcion')->nullable();
              $table->unsignedInteger('ID_Categoria')->required();
              $table->unsignedInteger('ID_Fabricante')->required();
              $table->float('Stock', 15, 4)->required();
              $table->tinyInteger('Estado')->required();
              $table->float('StockMinimo', 15, 4)->required();
              $table->float('Precio1', 15, 4)->required();
              $table->float('Precio2', 15, 4)->nullable();
              $table->float('Precio3', 15, 4)->nullable();
              $table->float('PrecioRefCompra', 15, 4)->nullable();

              $table->foreign('ID_UnidadMedida')->references('ID')->on('unidad_medidas');
              $table->foreign('ID_Categoria')->references('ID')->on('categorias');
              $table->foreign('ID_Fabricante')->references('ID')->on('fabricantes');
          });

          Schema::create('detalle_ventas',function($table){

            $table->dateTime('FechaCreacion')->required();
            $table->dateTime('FechaModificacion')->required();
            $table->unsignedInteger('ID_Usuario')->required();

            $table->unsignedInteger('ID_Venta')->required();
            $table->unsignedInteger('ID_Producto')->required();
            $table->unsignedInteger('ID_UnidadMedida')->required();
            $table->float('Cantidad',10,2)->required();
            $table->float('PrecioUnitario',15,4)->required();
            $table->float('MontoBruto',15,4)->required();
            $table->float('DescuentoFijo',15,4)->nullable();
            $table->float('DescuentoPorcentual',15,4)->nullable();
            $table->float('MontoReal',15,4)->required();
            $table->float('Impuesto',15,4)->required();
            $table->float('Total',15,4)->required();
            $table->tinyInteger('Estado')->required();

            $table->primary(['ID_Venta','ID_Producto','ID_UnidadMedida']);

            $table->foreign('ID_Venta')->references('ID')->on('ventas');
            $table->foreign('ID_Producto')->references('ID')->on('productos');
            $table->foreign('ID_UnidadMedida')->references('ID')->on('unidad_medidas');
          });


          Schema::create('producto_empaques', function($table){
              //$table -> increments('ID');
              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->unsignedInteger('ID_Producto')->required();
              $table->unsignedInteger('ID_UnidadMedida')->required();
              $table->float('Precio1', 15, 4)->required();
              $table->float('Precio2', 15, 4)->nullable();
              $table->float('Precio3', 15, 4)->nullable();
              $table->float('Equivalencia', 15, 4)->required();

              $table->primary(['ID_Producto','ID_UnidadMedida']);
              $table->foreign('ID_Producto')->references('ID')->on('productos');
              $table->foreign('ID_UnidadMedida')->references('ID')->on('unidad_medidas');
          });

          Schema::create('proveedores', function($table){
              $table-> increments('ID');
              $table-> dateTime('FechaCreacion')->required();
              $table-> dateTime('FechaModificacion')->required();
              $table-> unsignedInteger('ID_Usuario')->required();

              $table->string('Ruc', 15)->nullable();//->unique(); //revisar nullable()
              $table->string('RazonSocial', 250)->required();
              $table->string('Direccion', 150)->nullable();
              $table->string('Telefono', 25)->nullable();
              $table->string('Web', 100)->nullable();
              $table->tinyInteger('Estado')->required();
          });

          Schema::create('compras', function($table){
              $table->increments('ID');
              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->string('CompReferencia', 20)->required(); //revisar nullable()
              $table->unsignedInteger('ID_Proveedor')->required();
              $table->dateTime('Fecha')->required();
              $table->float('Monto', 15, 4)->required();
              $table->float('Impuesto', 15, 4)->required();
              $table->float('Total', 15, 4)->required();
              $table->tinyInteger('Estado')->required();
              $table->string('ID_Impuesto')->required();
              $table->float('PorcentajeImpuesto', 10, 2)->required();

              $table->foreign('ID_Proveedor')->references('ID')->on('proveedores');
              $table->foreign('ID_Impuesto')->references('ID')->on('impuestos');
          });

          Schema::create('detalle_compras', function($table){
              //$table -> increments('ID');
              $table-> dateTime('FechaCreacion')->required();
              $table-> dateTime('FechaModificacion')->required();
              $table-> unsignedInteger('ID_Usuario')->required();

              $table->unsignedInteger('ID_Compra')->required();
              $table->unsignedInteger('ID_Producto')->required();
              $table->unsignedInteger('ID_UnidadMedida')->required();
              $table->float('Cantidad', 10, 2)->required();
              $table->float('PrecioUnitario', 15, 4)->required();
              $table->float('Impuesto', 15, 4)->required();
              $table->float('Total', 15, 4)->required();
              $table->tinyInteger('Estado')->required();

              $table->primary(['ID_Compra', 'ID_Producto']);
              $table->foreign('ID_Compra')->references('ID')->on('compras');
              $table->foreign('ID_Producto')->references('ID')->on('productos');
              $table->foreign('ID_UnidadMedida')->references('ID')->on('unidad_medidas');
          });

          Schema::create('almacenes', function($table){
              $table->increments('ID');
              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->string('Nombre', 100)->required();
              $table->string('Direccion', 150)->required();
              $table->string('Telefono1', 25)->nullable();
              $table->string('Telefono2', 25)->nullable();
              $table->tinyInteger('Estado')->required();
          });

          Schema::create('motivo_movimientos', function($table){
              $table->increments('ID');
              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->string('Nombre', 100)->required();
              $table->text('Descripcion')->nullable();
              $table->tinyInteger('Estado')->required();
          });

          Schema::create('movimientos', function($table){
              $table->increments('ID');
              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->dateTime('Fecha')->required();
              $table->unsignedInteger('ID_Motivo')->required();
              $table->text('Descripcion')->required();
              $table->tinyInteger('Estado')->required();
              $table->unsignedInteger('ID_Almacen')->required();

              $table->foreign('ID_Motivo')->references('ID')->on('motivo_movimientos');
              $table->foreign('ID_Almacen')->references('ID')->on('almacenes');
          });

          Schema::create('detalle_movimientos', function($table){
              //$table -> increments('ID');
              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->unsignedInteger('ID_Movimiento')->required();
              $table->unsignedInteger('ID_Producto')->required();
              $table->string('TipoMovimiento', 3)->required();
              $table->float('Cantidad', 15, 4)->required();

              $table->primary(['ID_Movimiento', 'ID_Producto']);
              $table->foreign('ID_Movimiento')->references('ID')->on('movimientos');
              $table->foreign('ID_Producto')->references('ID')->on('productos');
          });

          Schema::create('seguimientos', function($table){
              $table->increments('ID');
              $table->dateTime('FechaCreacion')->required();
              $table->dateTime('FechaModificacion')->required();
              $table->unsignedInteger('ID_Usuario')->required();

              $table->string('RUC', 15)->required();
              $table->string('Serie', 4)->required();
              $table->unsignedBigInteger('NumComprobante')->required();
              $table->tinyInteger('JsonGenerado')->required();
              $table->tinyInteger('CpeEnviado')->required();
              $table->unsignedInteger('CodRespSunat')->nullable();
              $table->text('RespSunat')->nullable();
          });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
          //
          Schema::drop('negocios');
          Schema::drop('perfiles');
          Schema::drop('clientes');
          Schema::drop('tipo_comprobantes');
          Schema::drop('numeracion_series');
          Schema::drop('impuestos');
          Schema::drop('ventas');
          Schema::drop('detalle_ventas');
          Schema::drop('unidad_medidas');
          Schema::drop('fabricantes');
          Schema::drop('categorias');
          Schema::drop('productos');
          Schema::drop('producto_empaques');
          Schema::drop('proveedores');
          Schema::drop('compras');
          Schema::drop('detalle_compras');
          Schema::drop('almacenes');
          Schema::drop('motivo_movimientos');
          Schema::drop('movimientos');
          Schema::drop('detalle_movimientos');
          Schema::drop('seguimientos');
          Schema::drop('motivo_anulaciones');
      }
}
