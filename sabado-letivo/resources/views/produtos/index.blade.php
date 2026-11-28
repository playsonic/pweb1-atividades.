@extends('layouts.app')

@section('titulo', 'Produtos')

@section('conteudo')
    <h1>Produtos da feira</h1>

    <ul>
        @forelse ($produtos as $id => $produto)
            <li>
                <a href="{{ route('produtos.show', $id) }}">{{ $produto->getNome() }}</a>
                ({{ $produto->tipo() }}):
                R$ {{ number_format($produto->getPreco(), 2, ',', '.') }}
                — 2 custam R$ {{ number_format($produto->calcularPreco(2), 2, ',', '.') }}
                @if ($produto->getEstoque() === 0)
                    — <strong>Esgotado</strong>
                @else
                    — Estoque: {{ $produto->getEstoque() }} un.
                @endif
            </li>
        @empty
            <li>Nenhum produto cadastrado.</li>
        @endforelse
    </ul>
@endsection