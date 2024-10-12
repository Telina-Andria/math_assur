<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SinistreController;

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
Route::get("/home", [IndexController::class, "index"]);


//Authentification
Route::middleware("guest")->group(function () {
    Route::get("/login", [LoginController::class, "create"])->name("login");
    Route::post("/login", [LoginController::class, "store"])->name("login.store");
    Route::get('/register', [RegisterUserController::class, "create"])->name("register");
    Route::post('/register', [RegisterUserController::class, "store"])->name("register.store");
});

// Admin
Route::middleware(["auth", "disableBackBtn"])->group(function () {
    Route::get("/dashboard", [DashboardController::class, "create"])->name("dashboard");
    Route::delete("/logout", [LoginController::class, "delete"])->name("logout");
    Route::resource("client", ClientController::class);
    Route::resource("contrat", ContratController::class)->except(["create", "store"]);
    Route::get('/contrat/create/{client_id}', [ContratController::class, "create"])->name('contrat.create');
    Route::post('/contrat/{client_id}', [ContratController::class, "store"])->name('contrat.store');
    Route::resource('sinistre', SinistreController::class)->except(["create", "store"]);
    Route::get('/sinistre/create/{contrat}', [SinistreController::class, "create"])->name('sinistre.create');
    Route::post('/sinistre/{contrat}', [SinistreController::class, "store"])->name('sinistre.store');
});
