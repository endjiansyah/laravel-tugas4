<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
    return view('article.index');
})->name("index");

Route::prefix("article")->get('/', function () {
    return view('article.list');
})->name("article.index");

Route::prefix("article")->get('/create', function () {
    return view('article.create');
})->name("article.create");

Route::get('/detail/{id}', function ($id) {
    return view('article.detail', ["id" => $id]);
})->name("article.detail");

Route::prefix("article")->get('/edit/{id}', function ($id) {
    return view('article.edit', ["id" => $id]);
})->name("article.edit");

// ---------------------
Route::prefix("produk")
    ->name("produk.")
    ->controller(produkController::class)
    ->group(function () {
        Route::get("/", "index")->name('index');
        Route::get("/edit/{produk}", "edit")->name("edit")->middleware(['withAuth']);
        Route::get("/create", "create")->name("create")->middleware(['withAuth']);

        Route::post("/store", "store")->name("store")->middleware(['withAuth']);
        Route::put("/update/{produk}", "update")->name("update")->middleware(['withAuth']);
        Route::delete("/destroy/{produk}", "destroy")->name("destroy")->middleware(['withAuth']);
    });
// Route::resource('produk', ProdukController::class)->except(['show']);
// ----------------
Route::prefix("article")
    ->name("article.")
    ->controller(articleController::class)
    ->group(function () {
        // Route::get("/", "list")->name('index');
        // Route::get("/detail/{article}", "detail")->name("detail");
        // Route::get("/edit/{article}", "edit")->name("edit")->middleware(['withAuth']);
        // Route::get("/create", "create")->name("create")->middleware(['withAuth']);

        // Route::post("/store", "store")->name("store")->middleware(['withAuth']);
        // Route::put("/update/{article}", "update")->name("update")->middleware(['withAuth']);
        Route::delete("/destroy/{article}", "destroy")->name("destroy")->middleware(['withAuth']);
    });
// ----------------
Route::any('/login', [AuthController::class, 'login'])->name('login')->middleware(['noAuth']);
Route::any('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['withAuth']);
