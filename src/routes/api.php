<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\ProdutoPrecoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Apenas endpoints REST
*/

// Sincronização
Route::post('/sincronizar/produtos', [SyncController::class, 'syncProdutos']);
Route::post('/sincronizar/precos', [SyncController::class, 'syncPrecos']);

// Consulta paginada
Route::get('/produtos-precos', [ProdutoPrecoController::class, 'index']);