<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\InventaryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WalletController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard'); */


Route::group(['middleware' => ['auth:sanctum','verified']], function() {
    
    Route::get('/dashboard', function() {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::get('/company', [CompanyController::class, 'index'])->name('companie');
    Route::get('/company/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/company', [CompanyController::class, 'store'])->name('companies.store');
    Route::resource('{role}/company', CompanyController::class)->except(['index','create','store'])->names('companies');    
    Route::resource('wallet', WalletController::class)->names('wallets');    
    Route::resource('color', ColorController::class)->names('colors');    
    Route::resource('material', MaterialController::class)->names('materials');    
    Route::resource('municipality', MunicipalityController::class)->names('municipalities');    
    Route::resource('departament', DepartamentController::class)->names('departaments');    
    
    Route::resource('{role}/ticket', TicketController::class)->names('tickets');    
    Route::resource('{role}/inventary', InventaryController::class)->names('inventaries');    
    Route::resource('{role}/asset', AssetController::class)->names('assets');    
    Route::resource('{role}/client', ClientController::class)->names('clients');    
    Route::resource('{role}/point', PointController::class)->names('points');    
    Route::resource('{role}/category', CategoryController::class)->names('categories');
});
