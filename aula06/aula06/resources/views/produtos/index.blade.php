@extends('layouts.app')

@section('titulo', 'Produtos')

@section('conteudo')
    <h1>Produtos</h1>
    <ul>
        @foreach ($produtos as $id => $produto)
            <li>
                <a href="{{ route('produtos.show', $id) }}">{{ $produto['nome'] }}</a>:
                R$ {{ number_format($produto['preco'], 2, ',', '.') }}
                @if ($produto['estoque'] === 0)
                    — <strong>Esgotado</strong>
                @else
                    — Estoque: {{ $produto['estoque'] }} un.
                @endif
            </li>
        @endforeach
    </ul>
@endsection