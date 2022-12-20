<?php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\ProdukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/produk", [ProdukController::class, "index"]);
Route::get("/produk/{id}", [ProdukController::class, "show"]);
Route::post("/produk", [ProdukController::class, "store"]);
Route::put("/produk/{id}", [ProdukController::class, "update"]);
Route::delete("/produk/{id}", [ProdukController::class, "destroy"]);

Route::get("/article", [ArticleController::class, "index"]);
Route::get("/article/{id}", [ArticleController::class, "show"]);
Route::post("/article", [ArticleController::class, "store"]);
Route::post("/article/{id}/edit", [ArticleController::class, "update"]);
Route::post("/article/{id}/delete", [ArticleController::class, "destroy"]);
