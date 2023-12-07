<?php

use App\Http\Controllers\AgendamentosController;
use App\Http\Controllers\CadastrarPacienteController;
use App\Http\Controllers\CadastrarFuncionarioController;
use App\Http\Controllers\CadastrarProntuarioController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\NovoEnderecoController;
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
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/galeria', function () {
        return view('galeria');
    })->name('galeria');

    Route::get('/agendamentos', function () {
        return view('agendamentos');
    })->name('agendamentos');

    Route::prefix('novoendereco')->group(function () {
        Route::get('/', [NovoEnderecoController::class, 'index'])->name('novoendereco');
    });
    Route::prefix('cadastro-funcionario')->group(function () {
        Route::get('/', [CadastrarFuncionarioController::class, 'index'])->name('cadastro-funcionario');
    });
    Route::prefix('cadastro-paciente')->group(function () {
        Route::get('/', [CadastrarPacienteController::class, 'index'])->name('cadastro-paciente');
    });

    Route::prefix('cadastro-prontuario')->group(function () {
        Route::get('/', [CadastrarProntuarioController::class, 'index'])->name('cadastro-prontuario');
    });
    

    Route::get('/cadastro-funcionario', function () {
        return view('cadastro-funcionario');
    })->name('cadastro-funcionario');

    Route::prefix('permissoes')->group(function () {
        Route::get('/', [PermissionsController::class, 'index'])->name('permissoes');
    });
});



