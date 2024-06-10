<?php

use Illuminate\Support\Facades\Route;

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

Route::get("/admin", [\App\Http\Controllers\AdminController::class, "index"]);

# rutas para tipos de cursos
/**
 * 1. GET Ruta para cargar la interfaz de busqueda
 * 2. GET Realizar la busqueda
 * 3. GET Muestre el formulario para crear un nuevo tipo de curso
 * 4. POST Guardar en la BD un nuevo tipo de curso
 * 5. GET Para cargar los datos de un tipo de curso a editar
 * 6. PUT/PATCH Para actualizar los datos de un tipo de curso en la BD
 * 7. DELETE Para eliminar un tipo de curso
 *
 * Controladores de tipo Resource
 */

// va a crear 6 rutas
Route::get("/admin/programa/buscar", [\App\Http\Controllers\programaController::class, "search"])
    ->name("programa.search");
Route::resource("/admin/programa", \App\Http\Controllers\programaController::class)
    ->except("show");

// rutas para estudiante
Route::get('/admin/estudiante/search', [\App\Http\Controllers\estudianteController::class, 'search'])->name('estudiante.search');
Route::resource('/admin/estudiante', \App\Http\Controllers\estudianteController::class)->except('show');

// rutas para usuario
Route::get('/admin/usuario/search', [\App\Http\Controllers\UsuarioController::class, 'search'])->name('usuario.search');
Route::resource('/admin/usuario', \App\Http\Controllers\UsuarioController::class)->except('show');

//ruta del docente
Route::get('/admin/docente/search', [\App\Http\Controllers\docenteController::class, 'search'])->name('docente.search');
Route::resource('/admin/docente', \App\Http\Controllers\docenteController::class)->except('show');