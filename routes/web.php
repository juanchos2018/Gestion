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

use Illuminate\Http\Request; 

//Auth OK
Route::get('/', 'Auth\LoginController@FrmLogin')->middleware('guest');
Route::post('login', 'Auth\LoginController@Login');

//start middleware
Route::middleware('Administrador')->group(function(){

Route::get('logout', 'Auth\LoginController@Logout');
Route::get('dashboard', 'DashboardController@Index');
Route::get('reportes', 'DashboardController@Reportes');

//Usuario OK
Route::prefix('usuario')->group(function () {
    Route::get('/listar', 'UsuarioController@Listar');
    Route::get('/agregar', 'UsuarioController@FrmAgregar');
    Route::get('/editar/{UsuarioId}', 'UsuarioController@FrmEditar');
    Route::post('/agregar', 'UsuarioController@ActAgregar');
    Route::post('/editar', 'UsuarioController@ActEditar');
});

//Rol OK
Route::prefix('rol')->group(function () {
    Route::get('/listar', 'RolController@Listar');
    Route::get('/agregar', 'RolController@FrmAgregar');
    Route::get('/editar/{RolId}', 'RolController@FrmEditar');
    Route::post('/agregar', 'RolController@ActAgregar');
    Route::post('/editar', 'RolController@ActEditar');
});

//Miembro Proyecto OK
Route::prefix('miembro-proyecto')->group(function () {
    Route::get('/listar/p{ProyectoId}', 'MiembroProyectoController@Listar');
    Route::get('/editar/{MiembroProyectoId}/p{ProyectoId}', 'MiembroProyectoController@FrmEditar');
    Route::get('/eliminar/{MiembroProyectoId}/p{ProyectoId}', 'MiembroProyectoController@ActEliminar');
    Route::post('/agregar', 'MiembroProyectoController@ActAgregar');
    Route::post('/editar', 'MiembroProyectoController@ActEditar');
});

//Metodologia OK
Route::prefix('metodologia')->group(function () {
    Route::get('/listar', 'MetodologiaController@Listar');
    Route::get('/ver/{MetodologiaId}', 'MetodologiaController@Ver');
    Route::get('/agregar', 'MetodologiaController@FrmAgregar');
    Route::get('/editar/{MetodologiaId}', 'MetodologiaController@FrmEditar');
    Route::get('/eliminar/{MetodologiaId}', 'MetodologiaController@ActEliminar');
    Route::post('/agregar', 'MetodologiaController@ActAgregar');
    Route::post('/editar', 'MetodologiaController@ActEditar');
});

//Fase OK
Route::prefix('fase')->group(function () {
    Route::get('/editar/{FaseId}', 'FaseController@FrmEditar');
    Route::get('/eliminar/{FaseId}', 'FaseController@ActEliminar');
    Route::post('/agregar', 'FaseController@ActAgregar');
    Route::post('/editar', 'FaseController@ActEditar');
});

//Elemento de Configuracion OK
Route::prefix('elemento-configuracion')->group(function () {
    Route::get('/listar', 'ElementoConfiguracionController@Listar');
    Route::get('/agregar', 'ElementoConfiguracionController@FrmAgregar');
    Route::get('/editar/{ElementoConfiguracionId}', 'ElementoConfiguracionController@FrmEditar');
    Route::get('/eliminar/{ElementoConfiguracionId}', 'ElementoConfiguracionController@ActEliminar');
    Route::post('/agregar', 'ElementoConfiguracionController@ActAgregar');
    Route::post('/editar', 'ElementoConfiguracionController@ActEditar');
});

//Plantilla Elemento de Configuracion OK
Route::prefix('plantilla-elemento-configuracion')->group(function () {
    Route::post('/agregar', 'PlantillaElementoConfiguracionController@ActAgregar');
    Route::get('/eliminar/{PlantillaElementoConfiguracionId}', 'PlantillaElementoConfiguracionController@ActEliminar');
});


//Proyecto
Route::get('/proyecto/listar', 'ProyectoController@Listar')->name('proyecto.listar');
Route::get('/proyecto/p{ProyectoId}', 'ProyectoController@Ver')->name('proyecto.ver');
Route::get('/proyecto/agregar', 'ProyectoController@FrmAgregar');
Route::post('/proyecto/agregar', 'ProyectoController@ActAgregar');


//Plantilla Fase
Route::get('/metodologia-fase/listar/{MetodologiaId}', 'CronogramaFaseController@ListarPorMetodologiaId')->name('metodologia_fase.listar');


///SOLICITUD DE CAMBIO
Route::get('SolicitudCambio/listar', 'SolicitudCambioController@FrmListar')->name('SolicitudCambio.listar');
//NUEVO
Route::get('SolicitudCambio/create', 'SolicitudCambioController@FrmAgregar')->name('SolicitudCambio.create');
Route::post('SolicitudCambio/store', 'SolicitudCambioController@ActAgregarSolicitud')->name('SolicitudCambio.store');
//EDITAR
Route::get('SolicitudCambio/edit/{SolicitudId}', 'SolicitudCambioController@FrmEditar')->name('SolicitudCambio.edit');
Route::post('SolicitudCambio/update', 'SolicitudCambioController@ActEditarSolicitud')->name('SolicitudCambio.update');
//VER
Route::get('SolicitudCambio/informe/{SolicitudId}', 'SolicitudCambioController@FrmInformeCambio')->name('SolicitudCambio.informe');
//ELIMINAR
Route::get('SolicitudCambio/{SolicitudId}', 'SolicitudCambioController@delete')->name('SolicitudCambio.delete');


Route::post('SolicitudCambio/ViewESC', 'SolicitudCambioController@ViewESC')->name('SolicitudCambio.ViewESC');
Route::post('SolicitudCambio/AgregarDetalleInforme', 'SolicitudCambioController@AccAgregarDetalleInforme')->name('detalleinforme.AgregarDetalleInforme');
Route::post('SolicitudCambio/EliminarDetalleInforme', 'SolicitudCambioController@AccEliminarDetalleInforme')->name('detalleinforme.EliminarDetalleInforme');
Route::post('SolicitudCambio/TiempoSolicitud', 'SolicitudCambioController@ActTiempoSolicitud')->name('SolicitudCambio.TiempoSolicitud');

Route::post('SolicitudCambio/createinforme', 'SolicitudCambioController@ActAgregarInformeCambio')->name('SolicitudCambio.createinforme');
Route::post('SolicitudCambio/respondersolicitud', 'SolicitudCambioController@ActResponderSolicitud')->name('SolicitudCambio.respondersolicitud');


//////ORDEN DE CAMBIO
Route::get('OrdenCambio/listar', 'OrdenCambioController@FrmListar')->name('OrdenCambio.listar');
Route::get('OrdenCambio/create', 'OrdenCambioController@FrmAgregar')->name('OrdenCambio.create');
Route::post('OrdenCambio/createorden', 'OrdenCambioController@ActGuardarOrdenCambio')->name('OrdenCambio.createorden');
Route::get('OrdenCambio/edit/{Id}', 'OrdenCambioController@FrmEditar')->name('OrdenCambio.edit');
Route::post('OrdenCambio/editorden', 'OrdenCambioController@ActEditarOrdenCambio')->name('OrdenCambio.editorden');
///DETALLE ORDEN DE CAMBIO

Route::post('OrdenCambio/FasePorProyecto', 'OrdenCambioController@ActFasePorProyecto')->name('OrdenCambio.FasePorProyecto');
Route::post('OrdenCambio/ECSPorFase', 'OrdenCambioController@ActECSPorFase')->name('OrdenCambio.ECSPorFase');
Route::post('OrdenCambio/MiembrosPorProyeto', 'OrdenCambioController@ActMiembrosPorProyeto')->name('OrdenCambio.MiembrosPorProyeto');

Route::post('OrdenCambio/AgregarDetalleOrden', 'OrdenCambioController@ActAgregarDetalleOrden')->name('OrdenCambio.AgregarDetalleOrden');
Route::post('OrdenCambio/EliminarDetalleOrden', 'OrdenCambioController@ActEliminarDetalleOrden')->name('OrdenCambio.EliminarDetalleOrden');

Route::post('/version/agregar', 'VersionECSController@ActAgregar');
Route::get('/version/ver/{Id}', 'VersionECSController@FrmVer');
Route::post('/tarea/agregar', 'TareaECSController@Agregar');//Act
Route::post('/tarea/editar/{Id}', 'TareaECSController@ActEditar');
Route::get('mis-tareas/listar','TareaECSController@FrmListarPorMiembro');

});
//end middleware
?>