<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UseradminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Users Login
Route::post('/Login', [LoginController::class, 'loginapi']);
Route::post('/Registrar', [LoginController::class, 'registroapi']);


//Usuario
Route::delete('/myusersdelet', [UserController::class, 'eliminarCuentapropia']);

//Administrador
Route::get('/users', [UseradminController::class, 'Usuarios']);
Route::get('/users/{id}', [UseradminController::class, 'Usuarioid']); 
Route::get('/users', [UseradminController::class, 'Usuarios']);