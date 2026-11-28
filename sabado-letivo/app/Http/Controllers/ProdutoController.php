<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Feira\Produto;
use App\Domain\Feira\ProdutoPorPeso;
use App\Domain\Feira\ProdutoUnitario;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ProdutoController extends Controller
{
    private function criar(array $dados): Produto
    {
        $categoria = $dados['categoria'] ?? 'geral';
        $estoque = (int) ($dados['estoque'] ?? 0);

        return match ($dados['tipo']) {
            'peso' => new ProdutoPorPeso($dados['nome'], (float) $dados['preco'], $categoria, $estoque),
            'unidade' => new ProdutoUnitario($dados['nome'], (float) $dados['preco'], $categoria, $estoque),
        };
    }

    private function itens(): array
    {
        $fixos = [
            new ProdutoPorPeso('Queijo coalho', 25.5, 'laticinios', 12),
            new ProdutoUnitario('Mel de abelha', 30.0, 'mel', 0),
            new ProdutoUnitario('Rapadura', 4.0, 'doces', 25),
            new ProdutoUnitario('Doce de leite', 15.0, 'doces', 8),
            new ProdutoPorPeso('Nata fresca', 10.0, 'laticinios', 5),
        ];

        $cadastrados = array_map(
            fn (array $dados) => $this->criar($dados),
            session('produtos', [])
        );

        $todos = array_merge($fixos, $cadastrados);

        $indexados = [];
        foreach ($todos as $indice => $produto) {
            $indexados[$indice + 1] = $produto;
        }

        return $indexados;
    }

    public function index()
    {
        return view('produtos.index', [
            'produtos' => $this->itens(),
        ]);
    }

    public function show(int $id)
    {
        $itens = $this->itens();

        if (! isset($itens[$id])) {
            abort(404);
        }

        return view('produtos.show', [
            'id' => $id,
            'produto' => $itens[$id]->paraArray(),
        ]);
    }

    public function categoria(string $categoria)
    {
        $filtrados = array_filter(
            $this->itens(),
            fn (Produto $produto) => $produto->getCategoria() === $categoria
        );

        if (empty($filtrados)) {
            abort(404);
        }

        return view('produtos.index', [
            'produtos' => $filtrados,
        ]);
    }

    public function json()
    {
    $dados = array_map(
        fn (Produto $produto) => $produto->paraArray(),
        $this->itens()
    );

    return response()->json($dados);
    }

    public function showJson(int $id)
    {
        $itens = $this->itens();

        if (! isset($itens[$id])) {
            return response()->json([
                'erro' => "Produto $id não encontrado",
            ], 404);
        }

        return response()->json([
            'id' => $id,
            ...$itens[$id]->paraArray(),
        ], 200);
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'tipo' => 'required|in:peso,unidade',
            'nome' => 'required|min:3',
            'preco' => 'required|numeric',
            'categoria' => 'nullable|string|min:2',
            'estoque' => 'nullable|integer|min:0',
        ]);

        try {
            $produto = $this->criar($dados); 
        } catch (InvalidArgumentException $e) {
            return back()->withErrors(['preco' => $e->getMessage()])->withInput();
        }

        session()->push('produtos', $dados); 
        return redirect()
            ->route('produtos.index')
            ->with('sucesso', "{$produto->getNome()} cadastrado!");
    }
}