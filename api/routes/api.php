<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Esta rota cria automaticamente os caminhos:
| GET    /api/products          (Listar todos)
| POST   /api/products          (Salvar novo)
| GET    /api/products/{id}     (Ver um específico)
| PUT    /api/products/{id}     (Atualizar)
| DELETE /api/products/{id}     (Excluir)
*/

Route::apiResource('products', ProductController::class);