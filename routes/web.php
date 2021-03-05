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
    
    
    Route::resource('company', CompanyController::class)->names('companies');    
    Route::resource('wallet', WalletController::class)->names('wallets');    
    Route::resource('color', ColorController::class)->names('colors');    
    Route::resource('material', MaterialController::class)->names('materials');    
    Route::resource('municipality', MunicipalityController::class)->names('municipalities');    
    Route::resource('departament', DepartamentController::class)->names('departaments');    
    
    Route::resource('{rol}/ticket', TicketController::class)->names('tickets');    
    Route::resource('{rol}/inventary', InventaryController::class)->names('inventaries');    
    Route::resource('{rol}/asset', AssetController::class)->names('assets');    
    Route::resource('{rol}/client', ClientController::class)->names('clients');    
    Route::resource('{rol}/point', PointController::class)->names('points');    
    Route::resource('{rol}/category', CategoryController::class)->names('categories');
});


Route::resource('company', 'CompanyController');

Route::resource('role', 'RoleController');

Route::resource('permission', 'PermissionController');

Route::resource('point', 'PointController');

Route::resource('inventary', 'InventaryController');

Route::resource('ticket', 'TicketController');

Route::resource('asset', 'AssetController');

Route::resource('wallet', 'WalletController');

Route::resource('color', 'ColorController');

Route::resource('material', 'MaterialController');

Route::resource('client', 'ClientController');

Route::resource('municipality', 'MunicipalityController');

Route::resource('departament', 'DepartamentController');

Route::resource('category', 'CategoryController');
