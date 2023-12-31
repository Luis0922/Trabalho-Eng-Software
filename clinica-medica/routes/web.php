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
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/galeria', function () {
    return view('galeria');
})->name('galeria');

//Route::get('/agendamentos', function () {
//    return view('agendamentos');
//})->name('agendamentos');

Route::prefix('agendamentos')->group(function () {
    Route::get('/', [AgendamentosController::class, 'index'])->name('agendamentos');
});

Route::get('/visualizar-listagens', function () {
    return view('visualizar-listagens');
})->name('visualizar-listagens');

Route::prefix('novoendereco')->group(function () {
    Route::get('/', [NovoEnderecoController::class, 'index'])->name('novoendereco');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    

    
    Route::prefix('cadastro-funcionario')->group(function () {
        Route::get('/', [CadastrarFuncionarioController::class, 'index'])->name('cadastro-funcionario');
    });
    Route::prefix('cadastro-paciente')->group(function () {
        Route::get('/', [CadastrarPacienteController::class, 'index'])->name('cadastro-paciente');
    });

    Route::prefix('cadastro-prontuario')->group(function () {
        Route::get('/', [CadastrarProntuarioController::class, 'index'])->name('cadastro-prontuario');
    });

    Route::prefix('permissoes')->group(function () {
        Route::get('/', [PermissionsController::class, 'index'])->name('permissoes.');
        Route::get('/atualizar_funcao', [PermissionsController::class, 'atualizar_funcao'])
            ->name('permissoes.atualizar_funcao');
        Route::get('/editar_permissoes/{user_id}', [PermissionsController::class, 'editar_permissoes'])
            ->name('permissoes.editar_permissoes');
    });
});



