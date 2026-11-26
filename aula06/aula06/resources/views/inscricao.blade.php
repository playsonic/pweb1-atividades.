@extends('layouts.app')

@section('titulo', 'Inscrição de Produtores')

@section('conteudo')
    <h1>Inscrição de Produtores</h1>

    @if (session('sucesso'))
        <p><strong>{{ session('sucesso') }}</strong></p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('inscricao.store') }}" method="POST">
        @csrf

        <div>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}">
            @error('nome') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="produto">Produto:</label><br>
            <input type="text" id="produto" name="produto" value="{{ old('produto') }}">
            @error('produto') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="quantidade">Quantidade:</label><br>
            <input type="number" id="quantidade" name="quantidade" value="{{ old('quantidade') }}">
            @error('quantidade') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="telefone">Telefone (11 dígitos):</label><br>
            <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}">
            @error('telefone') <small>{{ $message }}</small> @enderror
        </div>

        <br>
        <button type="submit">Enviar inscrição</button>
    </form>
@endsection