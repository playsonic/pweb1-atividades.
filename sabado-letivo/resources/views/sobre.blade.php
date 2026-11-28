@extends('layouts.app')

@section('titulo', 'Sobre')

@section('conteudo')
    <h1>Sobre a Feira Digital</h1>
    <p>
        A <strong>Feira Digital</strong> é uma iniciativa criada para aproximar produtores locais
        dos consumidores, fortalecendo a agricultura familiar e valorizando os produtos regionais.
    </p>

    <h2>O que você encontra por aqui</h2>
    <ul>
        <li><strong>Direto do produtor:</strong> alimentos frescos e artesanais, como queijo coalho, mel de abelha e rapadura, sem intermediários.</li>
        <li><strong>Cardápio da feira:</strong> pratos típicos disponíveis no dia, preparados com ingredientes da região.</li>
        <li><strong>Cadastro de produtores:</strong> expositores interessados em participar podem enviar seus dados pela página de <a href="{{ route('inscricao.create') }}">Inscrição</a>.</li>
    </ul>

    <h2>Realização</h2>
    <p>
        Sistema desenvolvido no âmbito acadêmico do <strong>IFCE — Campus Boa Viagem</strong>.
    </p>
@endsection