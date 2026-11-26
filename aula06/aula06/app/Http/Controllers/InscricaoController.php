<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscricaoController extends Controller
{
    public function create()
    {
        return view('inscricao');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|min:3',
            'email' => 'required|email',
            'produto' => 'required',
            'quantidade' => 'required|integer|min:1',
            'telefone' => 'nullable|digits:11',
        ]);

        return redirect()
            ->route('inscricao.create')
            ->with(
                'sucesso',
                "Inscrição recebida: {$dados['nome']} vai trazer {$dados['quantidade']} de {$dados['produto']}."
            );
    }
}