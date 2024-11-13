<?php

use App\Http\Controllers\ContaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\InvestidorController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/company', [EmpresaController::class, 'index'])->name('company');
    Route::get('/company/create', [EmpresaController::class, 'create'])->name('company.create');
    Route::post('/company/store', [EmpresaController::class, 'store'])->name('company.store');
    Route::get('/company/{id}', [EmpresaController::class, 'show'])->name('company.show');
    Route::post('/company/withdraw', [EmpresaController::class, 'withdraw'])->name('company.withdraw');


    Route::get('/extract', [ContaController::class, 'index'])->name('extract');
    Route::post('/extract/deposit', [ContaController::class, 'deposit'])->name('extract.deposit');
    Route::post('/extract/withdraw', [ContaController::class, 'withdraw'])->name('extract.withdraw');

    Route::get('/investor',[InvestidorController::class,'index'])->name('investor');
    Route::get('/investor/{id}',[InvestidorController::class,'show'])->name('investor.show');
    Route::post('/investor/invest',[InvestidorController::class,'invest'])->name('investor.invest');
});


require __DIR__.'/auth.php';
