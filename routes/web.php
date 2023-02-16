<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Checkeo;

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
    return view('/home');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pagina_1', function () {
	return view('pagina_1');

}
     )->name('pagina_1');

Route::get('/sinlogin',  function () {return view('sinlogin');})->name('sinlogin');
Route::get('/viaticos',  function () {return view('viaticos');})->name('viaticos');
Route::get('/table',  function () {return view('table');})->name('table');
Route::get('/s_fondo',  function () {return view('s_fondo');})->name('s_fondo');
Route::get('/r_fondo',  function () {return view('r_fondo');})->name('r_fondo');
Route::get('subdireccion',  function () {return view('subdireccion');})->name('subdireccion/'); 
Route::get('exception_notif',  function () {return view('exception_notif');})->name('exception_notif');
Route::get('solicitud_ordenes',  function () {
	
	return view('generarot')
	;}
)->name('solicitud_ordenes');

Route::get('listarordenes',  function () {
	return view('listarordenes')
	;}
)->name('listarordenes');

Route::get('timeline',  function () {
	return view('timeline')
	;}
)->name('timeline');

Route::get('pdf',  function () {
	return view('pdf')
	;}
)->name('pdf');

Route::get('asignarot',  function () {
	return view('asignarot')
	;}
)->name('asignarot');

Route::get('gestioncompra',  function () {
	return view('gestioncompra')
	;}
)->name('gestioncompra');
Route::get('cpp',  function () {
	return view('cpp')
	;}
)->name('cpp');

Route::get('verpdf',  function () {
	return view('verpdf')
	;}
)->name('verpdf');

Route::get('pdfcpp',  function () {
	return view('pdfcpp')
	;}
)->name('pdfcpp');

Route::get('reasignar',  function () {
	return view('reasignar')
	;}
)->name('reasignar');

Route::get('modificarproductos',  function () {
	return view('modificarproductos')
	;}
)->name('modificarproductos');

Route::get('buscarot',  function () {
	return view('buscarot')
	;}
)->name('buscarot');

Route::get('buscarcpp',  function () {
	return view('buscarcpp')
	;}
)->name('buscarcpp');


Route::get('conformidad',  function () {
	return view('conformidad')
	;}
)->name('conformidad');

Route::get('vistamensajes',  function () {
	return view('vistamensajes')
	;}
)->name('vistamensajes');

Route::get('listaquimico',  function () {
	return view('listaquimico')
	;}
)->name('listaquimico');


Route::get('login',  function () {
	return view('login')
	;}
)->name('login');

Route::get('listafirmas',  function () {
	return view('listafirmas')
	;}
)->name('listafirmas');

Route::get('licitacionview',  function () {
	return view('licitacion')
	;}
)->name('licitacionview');

Route::get('visorviaticos',  function () {
	return view('visorviaticos')
	;}
)->name('visorviaticos');

Route::get('generarproductos',  function () {
	return view('generarproductos')
	;}
)->name('generarproductos');

Route::get('generarproveedor',  function () {
	return view('generarproveedor')
	;}
)->name('generarproveedor');

Route::get('generarcuentasigfe',  function () {
	return view('generarcuentasigfe')
	;}
)->name('generarcuentasigfe');

Route::get('liberarcpp',  function () {
	return view('liberarcpp')
	;}
)->name('liberarcpp');

Route::get('subdireccion2/{post}', 'SubdireccionController@show')->name('subdireccion2.index');
Route::post('productoupdate', 'ProductosController@update2');
Route::get('productosconvenios/{id}', 'ProductosController@productosconvenios');

Route::resource('centros', 'CentrosController');
Route::get('centroscostos/{post}', 'IrCentrosCostosController@show')->name('centroscostos.index');
Route::resource('centro_jt', 'Jefaturas_centrosController');
Route::resource('viaticos_jt', 'ViaticosController');
Route::resource('encargados_cc', 'EncargadosController');
Route::resource('fondo_j', 'FondoFijosController');
Route::resource('productos', 'ProductosController');
Route::resource('adjuntos_ot', 'AdjuntoController');
Route::resource('presucentros', 'PresupuestoAnualCCController');  
Route::resource('gastocentros', 'TotalGastadoCCController'); 
Route::resource('presupustoscentros', 'PresupuestoCentroCosto'); 
Route::resource('totalcentros', 'CentrosCCTotalGastado'); 
Route::resource('ordenesdecompra', 'OrdenesdeComprasController');
Route::get('ordenesdecompra2/{id}', 'OrdenesdeComprasController@show2');
Route::resource('encargado_cr', 'EncargadoCRController');
Route::resource('ot_por_asignar', 'OTAsignarController');
Route::resource('firmas', 'FirmasController');
Route::resource('persona', 'PersonaController');
Route::resource('ot_aprobar_persona', 'OT_por_AprobarController');
Route::resource('productos_aba', 'ProductosABAController');
Route::resource('compras', 'ComprasController');
Route::get('comprasdelete/{id}', 'ComprasController@destroy');
Route::resource('productos_base', 'Productos_BaseController');

Route::resource('firmaot', 'FirmasOrdenesController');
Route::get('firmaotsub/{id}', 'FirmasOrdenesController@showsub');
Route::get('firmaotter/{id}', 'FirmasOrdenesController@showter');
Route::resource('encriptar', 'EncriptarLinkController');
Route::resource('detallesotlinetime', 'DetalleOtsController');
Route::resource('adjuntosots_bd', 'AdjuntosOtsController');
Route::get('detallelink/{id}/{id2}','DetalleOtsController@verlink');
Route::get('detallelink2/{id}/{id2}','DetalleOtsController@verlink2');
// Proveedores
Route::resource('proveedores', 'ProveedoresController');
Route::get('proveedores2/{id}', 'ProveedoresController@show2');

//LsitarOrdenes
Route::resource('ordenesdecompra', 'OrdenesdeComprasController');
Route::post('otsincc', 'OrdenesdeComprasController@ot_generadas_sin_cc_amio');
Route::post('otsincc_buscador', 'OrdenesdeComprasController@ot_generadas_por_cc_y_fecha');

Route::post('otsincc_buscadorxid', 'OrdenesdeComprasController@buscadorxid');
Route::resource('historials','HistorialOTsController');
Route::get('listaotcompradores/{id}', 'ComprasController@ot_comprador');
Route::post('actualizarporot/{id}','ProductosController@updateporot');

//poductosOT

Route::get('productos_comprador/{id}','ProductosController@productos_comprador');
Route::get('productos_comprador_etapa/{id}','ProductosController@productoconetapa');
Route::get('productos_comprador_scpp/{id}','ProductosController@producto_compra_sin_cpp');
Route::get('productos_comprador_ccpp/{id}','ProductosController@productos_cpp');
Route::get('cantidadproductos/{id}','ProductosController@cantidad_productos');
Route::post('productosprocesos','ProductosController@productos_procesos');
Route::post('montoscc','ProductosController@totalproductosenviadosarefrendar');
Route::post('productosots','ProductosController@productosots');
Route::post('productoscppbusqueda','ProductosController@buscar_productos_cpp');
Route::post('productosbusquedaot','ProductosController@buscarotproductos');
Route::get('productoscantidad/{id}','ProductosController@cantidadproductosot');
Route::get('productoeliminar/{id}','ProductosController@destroy');



Route::resource('observacion_ot','ObservacionController');
//presupuestos

Route::resource('cierre','CierreProcesosController');
Route::resource('autorizacion','UsuariosAutorizadosController');
Route::post('presupuestoanual','PresupuestosCentrosController@centros_de_costo_presupuesto_anual');
Route::post('centrocostogastado','PresupuestosCentrosController@centros_de_costo_total_gastado');
Route::post('centrocostototalejecutado','PresupuestosCentrosController@centros_de_costo_total_ejecutado_22');
Route::post('centrocostototalsinrefrendar','PresupuestosCentrosController@centros_de_costo_total_gastado_sin_refrendar');
Route::post('sigfe','PresupuestosCentrosController@buscarsigfes');

//etapas

Route::resource('etapas','EtapasController');
Route::resource('detalleetapas','DetallesEtapasController');
Route::get('detalleetapas2/{id}','DetallesEtapasController@show2');

// procesos

Route::resource('procesos','ProcesosController');
Route::get('procesosindex','ProcesosController@index2');
Route::get('procesos2/{id}','ProcesosController@show2');
Route::get('procesos3/{id}','ProcesosController@show3');
Route::get('procesos4/{id}','ProcesosController@show4');
Route::get('procesos5/{id}','ProcesosController@show5');
Route::resource('comprador','CompradorController');
Route::resource('historialtcompra','HistorialTipoCompraController');
Route::post('procesosu','ProcesosController@update2');

// comprador_producto

Route::resource('comprador_productos','CompradorProductosController');


//pdf

Route::resource('pdfs','PDFSController');

//etapasOT
Route::resource('etapasot','EtapasOtsController');
Route::post('etapasot4','EtapasOtsController@update2');
Route::post('etapasot5','EtapasOtsController@update3');
Route::get('etapasot2/{id}','EtapasOtsController@show2');
Route::get('etapasot3/{id}','EtapasOtsController@show3');
Route::post('etapasot6','EtapasOtsController@store1');
//convenios
Route::resource('convenios','ConveniosController');
Route::get('convenios2/{id}','ConveniosController@show2');
Route::resource('convenioscpp','ConvenioscppController');
Route::get('conveniosxcpp/{id}','ConvenioscppController@show2');
Route::get('convenioscpp3/{id}','ConvenioscppController@show3');
Route::get('convenioscpp4/{id}','ConvenioscppController@show4');



//cpp
Route::resource('compromiso','CompromisosController');
Route::post('compromiso2','CompromisosController@store2');
Route::post('compromiso3','CompromisosController@store4');
Route::post('compromiso7','CompromisosController@store7');
Route::get('compromiso4/{id}','CompromisosController@show2');
//adjuntosdocumentos

Route::resource('adjuntosdocu','AdjuntosDocumentosController');
Route::post('adjuntosdocu2','AdjuntosDocumentosController@store2');

//tipos cpp

Route::resource('tiposcpp','TiposCppsController');

//estado cpp
Route::resource('estadocpp','EstadosCppController');

//persona
Route::get('persona2/{id}','PersonaController@show2');

//historial cpp
Route::resource('cpphistorial','CPPHistorialObservacionesController');

//visor de pdf

Route::resource('visorpdf','PdfAdjuntosDocuemntos');
Route::get('visorpdfcpp/{id}','PdfAdjuntosDocuemntos@show2');


Route::resource('visorpdfarchivos','VisorarchivosPdfController');

// estado procesos
Route::resource('estadoproceso','Estadoprocesocomprador');

//reasignarot


//cuentas
Route::resource('cuentassigfes','CuentasSigfesController');

Route::resource('refrendacion','RefrendacionController');
Route::post('refrendacionsin','RefrendacionController@store2');
Route::post('refrendacionesgasto','RefrendacionController@store3');
Route::get('refrendacioncpp/{id}','RefrendacionController@show2');
//presupuestos

Route::resource('nuevoprespuesto','NuevoPresupuestosController');
Route::post('totalcrprespuesto','NuevoPresupuestosController@store2');
//refrendacion


Route::resource('refrendacionescc','RefrendacionporccController');


Route::resource('pagado','PagadosController');
Route::post('pagado2','PagadosController@store2');
Route::resource('sigfe','SigfesController');
Route::resource('refrendacionenvio','Refrendacio_enviosController');

Route::post('restarcc','MantenedoresController@restarcc');
Route::post('actualizarcpp','MantenedoresController@updatecpp');
Route::post('eliminargastos','MantenedoresController@eliminargastos');


Route::resource('gasta','GastosController');

Route::resource('estadoli','EstadosLicitacionController');
Route::resource('c_responsabilidad','CentrosResponsabilidadController');
Route::resource('licitacion','LicitacionController');
Route::resource('notificaciones','NotificacionesController');
Route::get('notificaciones3/{id}','NotificacionesController@show3');
Route::get('notificaciones2/{post}','NotificacionesController@show2')->name('notificaciones2.index');

Route::resource('proasignar','ProAsignarController');
Route::resource('loghistorial','Log_historialController');
Route::resource('tipodocuemntos','TipoDocuemntosController');
Route::resource('firmascpp','FirmascppController');
Route::resource('encargadoq','EncargadoQuimicosController');
Route::resource('recepcionb','RecepcionBodegasController');
Route::resource('facturacion','FacturacionController');
Route::get('facturacionget/{id}','FacturacionController@showfacturacion');


Route::get('lista_editar/{id}','ProductosController@lista_editar_productos');
Route::get('/artisan-link', function () {
    Artisan::call('storage:link');
});

Route::resource('observacionrechazada','ObservacionRechazosController');
Route::resource('documentos','DocumentosController');
Route::resource('logdocumentos','LogEstadoDocumentosController');  
Route::resource('cppconformidad','CppConformidadController'); 
Route::resource('recepcionbo','RecepcionBodegasController'); 

Route::resource('bodegas','BodegaController'); 
Route::post('bodegas2','BodegaController@store2'); 
Route::resource('prorecepciones','ProductosRecepcionController');
Route::resource('docurecep','DocumentosRecepcionController');
Route::resource('prorecep','ProductosRecepcionController');
Route::resource('cpppgoenvio','CppPagoEnvioController');

Route::resource('crearproductos','CrearProductosController');


Route::resource('crearcpp','CrearCppController');



Route::resource('crearadjuntos','AddArchivosCppController');
Route::resource('crearsolicitudes','CrearSolicitudesController');
Route::resource('solicitudes','SolicitudesController');
Route::post('solicitudes2','SolicitudesController@store2');
Route::post('solicitudes3','SolicitudesController@store3');
Route::post('solicitudes4','SolicitudesController@store4');
Route::post('solicitudes5','SolicitudesController@store5');
Route::get('solicitudes5/{id}','SolicitudesController@show2');
Route::get('solicitudes7/{id}','SolicitudesController@show3');
Route::get('solicitudes6/{id}','SolicitudesController@destroy');
Route::resource('firmasolicitudes','FirmaSolicitudesController');
Route::resource('conveniosprogramas','ConveniosProgramasController');

Route::get('conveniosprogramaseliminar/{id}','ConveniosProgramasController@destroy');

Route::resource('historialdecompras2','HistorialdeComprasController');
Route::resource('conveniosproductos','ConveniosProductosController');
Route::resource('cppprogramas','CppProgramaController');
Route::get('cppprogramas2/{id}','CppProgramaController@show2');
Route::get('cppprogramas3/{id}','CppProgramaController@show3');
Route::resource('cpp_anticipos', 'Cpp_AnticipoController');
Route::resource('anticipos','AnticiposController');
Route::resource('rendiciones_fondo', 'RendicionesController');
Route::post('verificarfe', 'ProcesosController@daysWeek');
Route::get('verificarfe2','ProcesosController@prueba');
Route::resource('viaticoscpp','ViaticosCppController');
Route::resource('conformidadbuscar','ConformidadController');
Route::resource('observacionesfact','ObservacionesController');
Route::resource('yeartotal','YearController');
Route::resource('cppliberar','CppLiberarController');


Route::get('/config', function () {
    Artisan::call('config:cache');
});
Route::get('/limpiarcache', function () {
    Artisan::call('cache:clear');
});
Route::get('/storagelink', function () {
    Artisan::call('storage:link');
});


























