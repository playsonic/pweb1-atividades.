@extends('layouts.app')

@section('titulo', 'Cadastrar Produto')

@section('conteudo')
    <h1>Cadastrar produto na feira</h1>

    <form method="POST" action="{{ route('produtos.store') }}">
        @csrf

        <p>
            Tipo:
            <select name="tipo">
                <option value="peso" @selected(old('tipo') === 'peso')>Por kg</option>
                <option value="unidade" @selected(old('tipo') === 'unidade')>Por unidade</option>
            </select>
        </p>
        @error('tipo') <small>{{ $message }}</small> @enderror

        <p>
            Nome:
            <input type="text" name="nome" value="{{ old('nome') }}">
        </p>
        @error('nome') <small>{{ $message }}</small> @enderror

        <p>
            Preço (R$):
            <input type="text" name="preco" value="{{ old('preco') }}">
        </p>
        @error('preco') <small>{{ $message }}</small> @enderror

        <p>
            Categoria:
            <input type="text" name="categoria" value="{{ old('categoria') }}" placeholder="Ex.: laticinios, doces">
        </p>
        @error('categoria') <small>{{ $message }}</small> @enderror

        <p>
            Estoque:
            <input type="number" name="estoque" value="{{ old('estoque', 0) }}" min="0">
        </p>
        @error('estoque') <small>{{ $message }}</small> @enderror

        <p>
            <button type="submit">Cadastrar</button>
            <a href="{{ route('produtos.index') }}">Cancelar</a>
        </p>
    </form>
@endsection