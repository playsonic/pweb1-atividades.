@extends('layouts.app')

@section('titulo', $produto['nome'])

@section('conteudo')
    <h1>{{ $produto['nome'] }}</h1>
    <p>Código: {{ $id }}</p>
    <p>Categoria: {{ $produto['categoria'] }}</p>
    <p>Preço: R$ {{ number_format($produto['preco'], 2, ',', '.') }}</p>
    <p>
        Estoque:
        @if ($produto['estoque'] === 0)
            Esgotado
        @else
            {{ $produto['estoque'] }} unidades
        @endif
    </p>
    <a href="{{ route('produtos.index') }}">Voltar</a>
@endsection
