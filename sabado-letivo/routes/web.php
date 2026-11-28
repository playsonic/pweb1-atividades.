<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/titulo', function () {
    return '<h1>Feira Digital</h1><p>Direto do produtor.</p>';
});

Route::get('/produto-json', function () {
    return [
        'nome' => 'Queijo coalho',
        'preco' => 25.50,
        'disponivel' => true,
    ];
});

Route::get('/ola/{nome}', function (string $nome) {
    return "Olá, $nome!";
});

Route::get('/produto/{id}', function (int $id) {
    return "Produto número $id";
})->whereNumber('id');

Route::get('/manutencao', function () {
    return response('Voltamos logo!', 503);
});

Route::redirect('/inicio', '/ola/visitante');

Route::view('/boas-vindas', 'boas-vindas', ['turma' => 'ADS 2026'])
    ->name('boas-vindas');

Route::get('/feira', function () {
    $produtos = ['Queijo coalho', 'Mel de abelha', 'Rapadura'];

    return view('feira', [
        'titulo' => 'Feira Digital',
        'produtos' => $produtos,
    ]);
})->name('feira');

Route::get('/meu-nome', function () {
    return 'Meu nome é Dan Mendes e estudo ADS no IFCE.';
});

Route::get('/cartao', function () {
    return '<h2>Dan Mendes</h2>'
        . '<p>Semestre: 4º semestre</p>'
        . '<ul>'
        . '<li>Programação Back-end</li>'
        . '<li>RPG de Mesa</li>'
        . '<li>Linux e Self-Hosting</li>'
        . '</ul>';
});

Route::get('/perfil-json', function () {
    return [
        'nome' => 'Dan Mendes',
        'semestre' => 4,
        'media' => 8.5,
        'bolsista' => true,
        'disciplinas' => ['Programação Web I', 'Banco de Dados', 'Engenharia de Software'],
        'endereco' => [
            'cidade' => 'Boa Viagem',
            'uf' => 'CE',
        ],
    ];
});

Route::get('/perfil-criado', function () {
    return response()->json([
        'nome' => 'Dan Mendes',
        'semestre' => 4,
        'media' => 8.5,
        'bolsista' => true,
        'disciplinas' => ['Programação Web I', 'Banco de Dados', 'Engenharia de Software'],
        'endereco' => [
            'cidade' => 'Boa Viagem',
            'uf' => 'CE',
        ],
    ], 201);
});

Route::get('/tabuada/{numero}', function (int $numero) {
    $saida = '';
    for ($i = 1; $i <= 10; $i++) {
        $resultado = $numero * $i;
        $saida .= "$numero x $i = $resultado<br>";
    }

    return $saida;
})->whereNumber('numero');

Route::get('/idade/{ano}', function (int $ano) {
    $anoAtual = (int) date('Y');
    $idade = $anoAtual - $ano;

    return "Quem nasceu em $ano tem ou vai fazer $idade anos em $anoAtual.";
})->whereNumber('ano');

Route::get('/boas-vindas-turma/{turma?}', function (string $turma = 'ADS') {
    return "Bem-vinda, turma de $turma!";
});

Route::get('/admin', function () {
    return response('Área restrita', 403);
});

Route::get('/em-breve', function () {
    return response('Página em construção', 503);
});

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