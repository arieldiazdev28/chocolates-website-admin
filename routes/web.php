<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;

// Ruta de acceso al modo administrador
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Ruta de acceso al panel de administración
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

//Rutas para el manejo de sesión del usuario
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->controller(ProductoController::class)->group(function () {
    // Rutas de acceso a la sección de productos
    Route::get('/productos', 'index')->name('productos.index');
    Route::get('/productos/crear', 'create')->name('productos.create');
    Route::get('/productos/{id}', 'show')->name('productos.show');
    Route::post('/productos', 'store')->name('productos.store');
    Route::get('/productos/{id}/editar', 'edit')->name('productos.edit');
    Route::put('/productos/{id}', 'update')->name('productos.update');
    Route::delete('/productos/{id}', 'destroy')->name('productos.destroy');
    Route::get('/productos/buscar', 'search')->name('productos.search');
});

Route::middleware('auth')->controller(PedidoController::class)->group(function () {
    Route::get('/pedidos', 'index')->name('pedidos.index');
    Route::post('/pedidos/{pedido}/estado', 'actualizarEstado')->name('pedidos.actualizarEstado');
});


