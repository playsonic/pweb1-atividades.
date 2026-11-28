<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\ProdutoController;
use App\Domain\Feira\ProdutoPorPeso;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio', [
        'sistema' => 'Feira Digital',
        'tema' => 'Tema 01: venda de produtos da feira',
    ]);
})->name('inicio');

Route::get('/feira', function () {
    $produtos = ['Queijo coalho', 'Mel de abelha', 'Rapadura'];

    return view('feira', [
        'titulo' => 'Feira Digital',
        'produtos' => $produtos,
    ]);
})->name('feira');

Route::redirect('/loja', '/feira');
Route::permanentRedirect('/produtos-antigos', '/produtos');

Route::get('/cardapio', [CardapioController::class, 'index'])
    ->name('cardapio');

Route::get('/sobre', [PaginaController::class, 'sobre'])
    ->name('sobre');

Route::get('/contato', function () {
    return '<h1>Contato da Feira Digital</h1><p>feira@ifce.edu.br</p>';
})->name('contato');

Route::get('/produtos', [ProdutoController::class, 'index'])
    ->name('produtos.index');

Route::get('/produtos/json', [ProdutoController::class, 'json'])
    ->name('produtos.json');

Route::get('/produtos/categoria/{categoria}', [ProdutoController::class, 'categoria'])
    ->whereAlpha('categoria')
    ->name('produtos.categoria');

Route::get('/produtos/{id}/json', [ProdutoController::class, 'showJson'])
    ->whereNumber('id')
    ->name('produtos.show-json');

Route::get('/produtos/{id}', [ProdutoController::class, 'show'])
    ->whereNumber('id')
    ->name('produtos.show');

Route::get('/inscricao', [InscricaoController::class, 'create'])
    ->name('inscricao.create');

Route::post('/inscricao', [InscricaoController::class, 'store'])
    ->name('inscricao.store');

Route::fallback(function () {
    return response()->view('nao-encontrada', [], 404);
});

Route::get('/simular/{quantidade}', function (float $quantidade) {
    $feijao = new ProdutoPorPeso('Feijão', 12.0, 'grão', 12);
    $total = number_format($feijao->calcularPreco($quantidade), 2, ',', '.');

    return "$quantidade kg de {$feijao->getNome()} custam R$ $total";
})->where('quantidade', '[0-9]+(\.[0-9]+)?');

Route::get('/status', fn () => ['status' => 'ok']);
Route::get('/manutencao', fn () => response('Voltamos logo!', 503));
Route::redirect('/inicio', '/ola/visitante');
Route::get('/produtos/criar', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');