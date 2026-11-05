<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ComentarioController;

Route::get('/', [MainController::class, 'index'])->name('index');

//Rutas de Noticia
Route::get('/noticia', [NoticiaController::class, 'gestion'])->name('noticia.index');
Route::get('/noticia/buscar', [NoticiaController::class, 'search'])->name('noticia.search');
Route::get('/noticia/crear', [NoticiaController::class, 'create'])->name('noticia.create');
Route::get('/noticia/editar/{noticia:etiqueta}', [NoticiaController::class, 'edit'])->name('noticia.edit');
Route::post('/noticia', [NoticiaController::class, 'store'])->name('noticia.store');


Route::put('/noticia/{noticia:etiqueta}', [NoticiaController::class, 'update'])->name('noticia.update');
Route::get('/noticia/{noticia:etiqueta}', [NoticiaController::class, 'show'])->name('noticia.show');
Route::delete('/noticia/{noticia:etiqueta}', [NoticiaController::class, 'destroy'])->name('noticia.destroy');

// Rutas de Comentarios
Route::post('/noticia/{noticia:etiqueta}/comentario', [ComentarioController::class, 'store'])->name('comentario.store');
Route::put('/comentario/{comentario}', [ComentarioController::class, 'update'])->name('comentario.update');
Route::delete('/comentario/{comentario}', [ComentarioController::class, 'destroy'])->name('comentario.destroy');

