<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Exports\articuloExport; 
use App\Http\Controllers\ExportController;
use App\Http\Controllers\articuloController;
use App\Http\Controllers\salidaController;
use App\Http\Controllers\personaController;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get("/admin", [\App\Http\Controllers\AdminController::class, "index"]);

    // va a crear 6 rutas
    Route::get("/admin/programa/buscar", [\App\Http\Controllers\programaController::class, "search"])->name("programa.search");
    Route::get('/admin/programas/pdf', [\App\Http\Controllers\programaController::class, 'pdf'])->name('programa.pdf');
    Route::resource("/admin/programa", \App\Http\Controllers\programaController::class)->except("show");
    

    // rutas para curso
    Route::get('/admin/estudiante/search', [\App\Http\Controllers\estudianteController::class, 'search'])->name('estudiante.search');
    Route::get('/admin/estudiantes/pdf', [\App\Http\Controllers\estudianteController::class, 'pdf'])->name('estudiante.pdf');
    Route::resource('/admin/estudiante', \App\Http\Controllers\estudianteController::class)->except('show');
    

    // rutas para usuario
    Route::get('/admin/usuario/search', [\App\Http\Controllers\UsuarioController::class, 'search'])->name('usuario.search');
    Route::get('/admin/usuarios/pdf', [\App\Http\Controllers\usuarioController::class, 'pdf'])->name('usuario.pdf');
    Route::resource('/admin/usuario', \App\Http\Controllers\UsuarioController::class)->except('show');

    Route::get('/admin/docente/search', [\App\Http\Controllers\docenteController::class, 'search'])->name('docente.search');
    Route::get('/admin/docentes/pdf', [\App\Http\Controllers\docenteController::class, 'pdf'])->name('docente.pdf');
    Route::resource('/admin/docente', \App\Http\Controllers\docenteController::class)->except('show');

    Route::get('/admin/categoria/search', [\App\Http\Controllers\categoriaController::class, 'search'])->name('categoria.search');
    Route::get('/admin/categorias/pdf', [\App\Http\Controllers\categoriaController::class, 'pdf'])->name('categoria.pdf');
    Route::resource('/admin/categoria', \App\Http\Controllers\categoriaController::class)->except('show');

    Route::get('/admin/articulo/search', [\App\Http\Controllers\articuloController::class, 'search'])->name('articulo.search');
    Route::get('/admin/articulos/pdf', [\App\Http\Controllers\articuloController::class, 'pdf'])->name('articulo.pdf');
    //Route::get('/admin/articulo/excel', [UserController::class, 'excel'])->name('articulo.excel');
    Route::get('exportar-articulo', [articuloController::class, 'exportToExcel'])->name('exportar.articulo');

    Route::resource('/admin/articulo', \App\Http\Controllers\articuloController::class)->except('show');


    Route::get('/admin/proveedor/search', [\App\Http\Controllers\proveedorController::class, 'search'])->name('proveedor.search');
    Route::get('/admin/proveedors/pdf', [\App\Http\Controllers\proveedorController::class, 'pdf'])->name('proveedor.pdf');
    Route::resource('/admin/proveedor', \App\Http\Controllers\proveedorController::class)->except('show');

    Route::get('/admin/entrada/search', [\App\Http\Controllers\entradaController::class, 'search'])->name('entrada.search');
    Route::get('/admin/entradas/pdf', [\App\Http\Controllers\entradaController::class, 'pdf'])->name('entrada.pdf');
    Route::post('/entrada', [entradaController::class, 'sumar'])->name('entrada.sumar');
    Route::resource('/admin/entrada', \App\Http\Controllers\entradaController::class)->except('show');

    
    Route::get('/admin/salida/search', [\App\Http\Controllers\salidaController::class, 'search'])->name('salida.search');
    Route::get('/admin/salidas/pdf', [\App\Http\Controllers\salidaController::class, 'pdf'])->name('salida.pdf');   

    Route::get('export', [\App\Http\Controllers\salidaController::class, 'export'])->name('export');

    Route::get('/export-excel', [\App\Http\Controllers\salidaController::class, 'exportToExcel'])->name('salida.efechas');



    Route::get('/buscar-persona', [\App\Http\Controllers\salidaController::class, 'buscarpersona']);
    Route::post('/buscar-persona', 'salidaController@buscarPersona');



    

    Route::get('/admin/salida', [salidaController::class, 'rfechas'])->name('admin.salida.rfechas');

    Route::get('/admin/salida/rfechas', [\App\Http\Controllers\salidaController::class, 'rfechas'])->name('salida.rfechas');


    // Route::get('salida/exportar-pdf2', 'SalidaController@generarPDF')->name('salida.exportar.pdf2');


    
    // Route::post('../salida/getNombreYApellido', [salidaController::class, 'getNombreYApellido']);
    // Route::post('/salida/getNombreYApellido', 'salidaController@getNombreYApellido');



    Route::get('/filtrar',[salidaController::class, 'filtrar']);

    // Route::post('/buscar-nombre-por-dni', 'personaController@buscarPorDNI');


    Route::resource('/admin/salida', \App\Http\Controllers\salidaController::class)->except('show');

    Route::get('/admin/persona/search', [\App\Http\Controllers\personaController::class, 'search'])->name('persona.search');
    Route::get('/admin/personas/pdf', [\App\Http\Controllers\personaController::class, 'pdf'])->name('persona.pdf');
    Route::resource('/admin/persona', \App\Http\Controllers\personaController::class)->except('show');

    Route::get('/admin/personal/search', [\App\Http\Controllers\personalController::class, 'search'])->name('personal.search');
    Route::get('/admin/personals/pdf', [\App\Http\Controllers\personalController::class, 'pdf'])->name('personal.pdf');
    Route::resource('/admin/personal', \App\Http\Controllers\personalController::class)->except('show');

    Route::get('/admin/especialidad/search', [\App\Http\Controllers\especialidadController::class, 'search'])->name('especialidad.search');
    Route::get('/admin/especialidads/pdf', [\App\Http\Controllers\especialidadController::class, 'pdf'])->name('especialidad.pdf');
    Route::resource('/admin/especialidad', \App\Http\Controllers\especialidadController::class)->except('show');

    Route::get('/admin/oficina/search', [\App\Http\Controllers\oficinaController::class, 'search'])->name('oficina.search');
    Route::get('/admin/oficinas/pdf', [\App\Http\Controllers\oficinaController::class, 'pdf'])->name('oficina.pdf');
    Route::resource('/admin/oficina', \App\Http\Controllers\oficinaController::class)->except('show');
});
