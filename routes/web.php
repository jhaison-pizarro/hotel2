<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;  
use App\Http\Controllers\LoginController;  
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\TipoHabitacionesController;
use App\Http\Controllers\HabitacionesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\reservarclController;
/*
/*
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

Route::get('/', [AdminController::class , 'index'])->name('admin');
Route::get('session', [AdminController::class , 'session'])->name('admin.session');
Route::get('paneladmin', [AdminController::class , 'paneladmin'])->name('admin.paneladmin');
Route::get('session_cli', [AdminController::class , 'session_cli'])->name('admin.session_cli');

Route::post('login',[LoginController::class , 'login'])->name('login');
Route::get('register',[LoginController::class , 'register'])->name('register');
Route::get('salir',[LoginController::class , 'salir'])->name('salir');
Route::post('save_registre',[LoginController::class , 'save_registre'])->name('save_registre');

Route::post('login_cli',[LoginController::class , 'login_web'])->name('login_cli');

//Usuarios
Route::get('usuarios', [UsuariosController::class, 'usuarios'])->name('usuarios');
Route::get('usuarios_tabla', [UsuariosController::class, 'usuarios_tabla'])->name('usuarios_tabla');
Route::post('save_usuarios', [UsuariosController::class, 'save_usuarios'])->name('save_usuarios');
Route::post('edit_usuario', [UsuariosController::class, 'edit_usuario'])->name('edit_usuario');
Route::post('update_usuario', [UsuariosController::class, 'update_usuario'])->name('update_usuario');
Route::post('delete_usuarios', [UsuariosController::class, 'delete_usuarios'])->name('delete_usuarios');

//ROLES


Route::get('roles', [RolesController::class, 'roles'])->name('roles');
Route::get('table_roles', [RolesController::class, 'table_roles'])->name('table_roles');
Route::post('save_roles', [RolesController::class, 'save_roles'])->name('save_roles');
Route::post('edit_rol', [RolesController::class, 'edit_rol'])->name('edit_rol');
Route::post('update_rol', [RolesController::class, 'update_rol'])->name('update_rol');
Route::post('/delete_rol', [RolesController::class, 'delete_rol'])->name('delete_rol');

//Empresa 

Route::get('/business', [EmpresaController::class, 'index'])->name('index');
Route::post('/save-empresa', [EmpresaController::class, 'save_empresa'])->name('save_empresa');

//categorias

Route::get('/categorias_index', [CategoriaController::class, 'categorias_index'])->name('categorias_index');
Route::get('categorias_table', [CategoriaController::class, 'categorias_table'])->name('categorias_table');
Route::post('/save_categoria', [CategoriaController::class, 'save_categoria'])->name('save_categoria');
Route::post('/edit_categoria', [CategoriaController::class, 'edit_categoria'])->name('edit_categoria');
Route::post('/update_categoria', [CategoriaController::class, 'update_categoria'])->name('update_categoria');
Route::post('/delete_categoria', [CategoriaController::class, 'delete_categoria'])->name('delete_categoria');



//Productos

Route::get('/productos_index', [ProductoController::class, 'productos_index'])->name('productos_index');
Route::post('/save_producto', [ProductoController::class, 'save_producto'])->name('save_producto');
Route::get('/productos_table', [ProductoController::class, 'productos_table'])->name('productos_table');
Route::post('/edit_producto', [ProductoController::class, 'edit_producto'])->name('edit_producto');
Route::post('/edit_save_producto', [ProductoController::class, 'update_producto'])->name('edit_save_producto');
Route::post('/delete_producto', [ProductoController::class, 'delete_producto'])->name('delete_producto');


//Niveles

Route::get('/niveles', [NivelesController::class, 'index'])->name('niveles');
Route::get('/niveles_table', [NivelesController::class, 'niveles_table'])->name('niveles_table');
Route::post('/save_nivel', [NivelesController::class, 'save_nivel'])->name('save_nivel');
Route::post('/edit_nivel', [NivelesController::class, 'edit_nivel'])->name('edit_nivel');
Route::post('/update_nivel', [NivelesController::class, 'update_nivel'])->name('update_nivel');
Route::post('/delete_nivel', [NivelesController::class, 'delete_nivel'])->name('delete_nivel');





//Recepción
Route::get('/recepcion', [RecepcionController::class, 'index'])->name('recepcion');
Route::post('/habitaciones_niveles', [RecepcionController::class, 'habitaciones_niveles'])->name('habitaciones_niveles');
Route::get('/reservar_disponible/{id}', [RecepcionController::class, 'reservar_disponible'])->name('reservar_disponible');
Route::get('buscardni', [RecepcionController::class, 'buscardni'])->name('buscardni');
Route::post('save_resepcion', [RecepcionController::class, 'save_resepcion'])->name('save_resepcion');

Route::get('/factura/{id}', [RecepcionController::class, 'factura'])->name('factura');






//Tipo_Habitaciones 

Route::get('habitaciones_indexs', [TipoHabitacionesController::class, 'index'])->name('habitaciones_indexs');
Route::get('/tipo_habitaciones_table', [TipoHabitacionesController::class, 'tipo_habitaciones_table'])->name('tipo_habitaciones_table');
Route::post('/save_tipo_habitacion', [TipoHabitacionesController::class, 'save_tipo_habitacion'])->name('save_tipo_habitacion');
route::post('/edit_tipo_habitacion', [TipoHabitacionesController::class, 'edit_tipo_habitacion'])->name('edit_tipo_habitacion');
route::post('/update_tipo_habitacion', [TipoHabitacionesController::class, 'update_tipo_habitacion'])->name('update_tipo_habitacion');
route::post('/delete_tipo_habitacion', [TipoHabitacionesController::class, 'delete_tipo_habitacion'])->name('delete_tipo_habitacion');


//HABITACIONES
route::get('/habitaciones', [HabitacionesController::class, 'habitaciones'])->name('habitaciones');
route::get('/habitaciones_table', [HabitacionesController::class, 'habitaciones_table'])->name('habitaciones_table');
route::post('/save_habitaciones', [HabitacionesController::class, 'save_habitaciones'])->name('save_habitaciones');
route::post('/limpieza', [HabitacionesController::class, 'limpieza'])->name('limpieza');



//CLIENTES
route::get('/clientes_index', [ClientesController::class, 'clientes_index'])->name('clientes_index');
route::post('/save_cliente', [ClientesController::class, 'save_cliente'])->name('save_cliente');
route::get('/clientes_table', [ClientesController::class, 'clientes_table'])->name('clientes_table');
route::post('/edit_cliente', [ClientesController::class, 'edit_cliente'])->name('edit_cliente');
route::post('/save_edit_clientes', [ClientesController::class, 'save_edit_clientes'])->name('save_edit_clientes');
route::post('/delete_cliente', [ClientesController::class, 'delete_cliente'])->name('delete_cliente');

route::post('/btn_reniec_cli', [ClientesController::class, 'btn_reniec_cli'])->name('btn_reniec_cli');


//ventas

route::get('/index_ventas', [VentaController::class, 'index'])->name('index_ventas');
route::get('/index_v/{id}', [VentaController::class, 'index_v'])->name('index_v');
route::get('buscarproducto', [VentaController::class, 'buscarproducto'])->name('buscarproducto');
route::post('vender_save', [VentaController::class, 'vender_save'])->name('vender_save');

//Controlar stock
route::post('verstock', [StockController::class, 'verstock'])->name('verstock');
route::post('verstock', [StockController::class, 'verstock'])->name('verstock');
route::post('notifi_stock', [StockController::class, 'notifi_stock'])->name('notifi_stock');

//Verificacion de salidas


route::get('verifi_salidas', [SalidaController::class, 'index'])->name('verifi_salidas');
route::get('salidas_v/{id}', [SalidaController::class, 'salidas_v'])->name('salidas_v');
route::post('mora', [SalidaController::class, 'mora'])->name('mora');


//reportes



Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::post('/reportes_diario', [ReporteController::class, 'diario'])->name('reportes.diario');
Route::post('/buscar_detalles', [ReporteController::class, 'buscar_detalles'])->name('buscar_detalles');
Route::post('/reportes_mensual', [ReporteController::class,'mensual'])->name('reportes.mensual');
Route::get('/report_pdf/{fecha_final}', [ReporteController::class,'report_pdf'])->name('report_pdf');


//CALENDARIO

Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');
Route::post('/save_event', [CalendarioController::class, 'save_event'])->name('calendario.save_event');
Route::post('/delete_event', [CalendarioController::class, 'delete_event'])->name('calendario.remove_event');


//CAJA

Route::get('/apertura.caja', [CajaController::class, 'index'])->name('apertura.index');
Route::post('/save_apertura', [CajaController::class, 'save'])->name('apertura.save');
Route::get('/cajas_table', [CajaController::class, 'cajas_table'])->name('cajas_table');
Route::post('/cerrar_caja', [CajaController::class, 'cerrar_caja'])->name('caja.cerrar');


Route::get('/pagina_index', [PaginaController::class, 'pagina_index'])->name('pagina_index');


Route::post('/reservar_cli', [reservarclController::class, 'reservar_cli'])->name('reservar_cli');