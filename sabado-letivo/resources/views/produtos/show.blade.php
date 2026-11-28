@extends('layouts.app')

@section('titulo', $produto['nome'])

@section('conteudo')
    <h1>{{ $produto['nome'] }}</h1>
    <p>Código: {{ $id }}</p>
    <p>R$ {{ number_format($produto['preco'], 2, ',', '.') }}</p>
    <a href="{{ route('produtos.index') }}">Voltar</a>
@endsection