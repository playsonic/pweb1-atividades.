<?php

namespace App\Http\Controllers;

class ProdutoController extends Controller
{
    private function produtos(): array
    {
        return [
            1 => ['nome' => 'Queijo coalho', 'preco' => 25.5, 'categoria' => 'laticinios', 'estoque' => 12],
            2 => ['nome' => 'Mel de abelha', 'preco' => 30.0, 'categoria' => 'mel', 'estoque' => 0],
            3 => ['nome' => 'Rapadura', 'preco' => 4.0, 'categoria' => 'doces', 'estoque' => 25],
            4 => ['nome' => 'Doce de leite', 'preco' => 15.0, 'categoria' => 'doces', 'estoque' => 8],
            5 => ['nome' => 'Nata fresca', 'preco' => 10.0, 'categoria' => 'laticinios', 'estoque' => 5],
        ];
    }

    public function index()
    {
        return view('produtos.index', [
            'produtos' => $this->produtos(),
        ]);
    }

    public function show(int $id)
    {
        $produtos = $this->produtos();

        if (! isset($produtos[$id])) {
            abort(404);
        }

        return view('produtos.show', [
            'id' => $id,
            'produto' => $produtos[$id],
        ]);
    }

    public function categoria(string $categoria)
    {
        $filtrados = array_filter(
            $this->produtos(),
            fn ($produto) => $produto['categoria'] === $categoria
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
        return response()->json($this->produtos());
    }

    public function showJson(int $id)
    {
        $produtos = $this->produtos();

        if (! isset($produtos[$id])) {
            return response()->json([
                'erro' => "Produto $id não encontrado",
            ], 404);
        }

        return response()->json([
            'id' => $id,
            ...$produtos[$id],
        ], 200);
    }
}