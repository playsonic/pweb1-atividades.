@extends('layouts.app')

@section('titulo', 'Início')

@section('conteudo')
    <h1>{{ $sistema }}</h1>
    <p>{{ $tema }}</p>

    <ul>
        <li><a href="{{ route('produtos.index') }}">Ver produtos disponíveis</a></li>
        <li><a href="{{ route('cardapio') }}">Conferir cardápio do dia</a></li>
        <li><a href="{{ route('inscricao.create') }}">Inscrever-se como produtor</a></li>
    </ul>
@endsection