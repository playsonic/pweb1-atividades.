<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo') | Feira Digital</title>
</head>
<body>
    @include('partials.menu')

    <main>
        @yield('conteudo')
    </main>

    <footer>IFCE Campus Boa Viagem</footer>
</body>
</html>