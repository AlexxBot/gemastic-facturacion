<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
/*Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');*/

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['administrador']], function () {

    //Route::resource('perfiles','PerfilController');

    //Route::resource('negocios','NegocioController');

    //Route::get('negocios/{id}/{estado}','NegocioController@modificarEstado');

    //yo Route::resource('clientes','ClienteController');

    Route::resource('categorias','CategoriaController');

    Route::resource('unidad_medidas','Unidad_MedidaController');

    Route::resource('fabricantes','FabricanteController');

    Route::resource('productos','ProductoController');

    Route::post('producto_empaques/{id}', 'Producto_EmpaqueController@nuevo');
    //Route::put('producto_empaques/{id}', 'Producto_EmpaqueController@update');
    //Route::delete('producto_empaques/{id}', 'Producto_EmpaqueController@destroy');

    Route::resource('producto_empaques','Producto_EmpaqueController');

    /*Route::get('/api', 'VentaController@productos')->name('api.index');
    Route::get('/listadoproductos', 'ProductoController@listado_productos')->name('listado.index');
    Route::post('agregarproducto/{id}', 'ProductoController@agregar_producto')/*->name('api_recuperar.index')*//*;
    Route::get('listarproductos', 'ProductoController@listar_productos')/*->name('api_recuperar.index')*//*;*/
    /*Route::post('/agregarproducto',function(){
      if(Request::ajax()){
        return var_dump(Response::json(Request::all()));
      }
    });*/

    //yo Route::resource('ventas','VentaController');

    //yo Route::resource('detalle_ventas','Detalle_VentaController');

    //Route::put('producto_empaques/{id}', 'Producto_EmpaqueController@update');
    //Route::delete('producto_empaques/{id}', 'Producto_EmpaqueController@destroy');

    Route::resource('almacenes','AlmacenController');

    Route::get('almacenes/{id}/{estado}','AlmacenController@modificarEstado');

    Route::resource('impuestos','ImpuestoController');
    Route::post('impuestos/{id}', 'ImpuestoController@recuperar_impuesto')/*->name('api_recuperar.index')*/;

    Route::resource('tipo_comprobantes','Tipo_ComprobanteController');

    Route::resource('numeracion_series','Numeracion_SerieController');

    Route::resource('motivo_movimientos','Motivo_MovimientoController');

    Route::get('motivo_movimientos/{id}/{estado}','Motivo_MovimientoController@modificarEstado');



    Route::resource('usuarios','UsuarioController');

    Route::get('usuarios/{id}/{estado}','UsuarioController@modificarEstado');

    Route::get('clientes/{id}/{estado}','ClienteController@modificarEstado');

    Route::get('/productoslistado', 'ProductoController@productoslistado')->name('productoslistado.index');

    Route::get('productos/{id}/{estado}','ProductoController@modificarEstado');



});

Route::group(['middleware' => ['vendedor']], function () {

    Route::resource('clientes','ClienteController');



    Route::get('numeracion_series/{idcomprobante}/{idnegocio}','NumeracionSerieController@obtenerNumeracionSerie');

    Route::get('/api', 'VentaController@productos')->name('api.index');
    Route::get('/listadoproductos', 'ProductoController@listado_productos')->name('listado.index');
    Route::post('agregarproducto/{id}', 'ProductoController@agregar_producto')/*->name('api_recuperar.index')*/;
    Route::get('listarproductos', 'ProductoController@listar_productos')/*->name('api_recuperar.index')*/;

    Route::post('ventas/create','VentaController@store');

    Route::resource('ventas','VentaController');



    Route::get('ventas/{id}/{estado}','VentaController@modificarEstado');

    Route::resource('detalle_ventas','Detalle_VentaController');

});

Route::group(['middleware' => ['consultor']], function () {

    Route::get('consultarventas','ConsultorController@consultarVentas');
    Route::get('consultarproductos','ConsultorController@consultarProductos');
    Route::get('consultarclientes','ConsultorController@consultarClientes');
    Route::get('consultarcategorias','ConsultorController@consultarCategorias');
    Route::get('consultaralmacenes','ConsultorController@consultarAlmacenes');
    Route::get('/consultarpresentaciones/{id}','ConsultorController@consultarPresentacionesProducto');
    Route::get('/listarproductos', 'ProductoController@productoslistado')->name('listarproductos');
});
