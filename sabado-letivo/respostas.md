# Respostas: sábado letivo (28/11/2026)

Nome: _(seu nome)_
Tema: _(número e nome)_

## R02: Classes do domínio

### Saída do tinker
```
> $p = new App\Domain\Feira\ProdutoPorPeso('Feijão', 12.0, "grão", 12);

= App\Domain\Feira\ProdutoPorPeso {#7509}

> $p->calcularPreco(2.5);

= 30.0

> $p = new App\Domain\Feira\ProdutoPorPeso('Feijão', 0, "grão", 12);

InvalidArgumentException  O preço deve ser maior que zero.
```

a) Saída colada acima.
b) Tabela de classes preenchida no README.md: _(sim/não)_
c) Pelo padrão PSR-4 de autoload gerenciado pelo Composer no Laravel, o PHP dispensa o uso manual de `require` ou `include` porque traduz o endereço lógico da classe diretamente para o caminho físico nas pastas do projeto, mapeando `App\` para `app/`. Dessa forma, o namespace define a estrutura de diretórios (`App\Domain\Feira` corresponde a `app/Domain/Feira/`) e o nome da classe define o nome exato do arquivo (`ProdutoPorPeso` corresponde a `ProdutoPorPeso.php`), de modo que qualquer divergência na escrita, inclusive entre letras maiúsculas e minúsculas, impede o "autoloader" de localizar o código e resulta no erro `Class "..." not found`.


## R03: Rotas rápidas

### Saídas
```
curl -i http://127.0.0.1:8000/status
  curl -i http://127.0.0.1:8000/manutencao
  curl -i http://127.0.0.1:8000/inicio
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Sat, 28 Nov 2026 14:38:31 GMT
Content-Type: application/json
Set-Cookie: XSRF-TOKEN=eyJpdiI6Ik0raytFOEpna2xFQ0M1ckNPTVcrNFE9PSIsInZhbHVlIjoiTzNiY2VtYmxtWFY0U2N1ZTREM2NEZXNtbXZ1aWZlakRkT01aYy90M1FZQWZJZXA5akkvdnYzYXF2ajZZZ3R0dkorMm1UYWdkOFhMZ05neHdwWnVzaEZFYmpRMUtGTUdKY242dXZlRW5XUFZsSkVIT0x3Q3pMWGlHYldNSHd4MjQiLCJtYWMiOiI4N2MwNzBmOTI1MGE3NzkxZTBkZTNiYTg4Y2FmNjJkMjE0YTZiM2FjN2YwZmNhM2UzNWViZDZhZGJiNTU5ZWJhIiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 16:38:31 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IjJKem9tS01DQWF0aUZ5NUZNbmJ1aUE9PSIsInZhbHVlIjoiMEl6Yk9XVCt1bUpnZmxwYWVaK1FIZ2c0NktMaFYrYVRWWmZJRFdGOEs4Zmd2dWRUZzIzT3I1aDQvSmhBTm1Sei9pUXV0S3NZcWxadVVLaGVaUjRvTjAxKzRaYlpxVTFTbGV2Rmd2OHRoOGR1RjZTQ2hiMmdWNk9wT21tclhNaDEiLCJtYWMiOiJlNjRkYzI5OWEzMjRjNGQzM2Q0ZDA4NDFhNjAzOWJkYTljYThlZTRkZDYyNTk3YWIxZjlkZmZhZjJmYmU4ZGQzIiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 16:38:31 GMT; Max-Age=7200; path=/; httponly; samesite=lax

{"status":"ok"}HTTP/1.1 503 Service Unavailable
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Sat, 28 Nov 2026 14:38:31 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6IjVBRTEzUkdOd1FMU1dFTWV0U2daUXc9PSIsInZhbHVlIjoiT3NrdjVleHh6SncrMkQyNEppOHZQc0llWit1WXN6OU5HblB0aGhkam1kUE1qaENnRnYyUVJZMVkzYTJ0UHoyN3dxWnFRMXNnMFdZV0QxRkRUY3BtZERPN2MvcDQ0K24yZE1mb1dwdzRvOGlsVzIzZDFLVGF5UitrWkxlcjR0OU0iLCJtYWMiOiJkYzE3Y2FlODgzZmU1NmFiNjkyZWQxOTFjZWRkNzY1MDMxZWEwZjYxNzRmOWYzMTU1NDg3MTE0NTAyZTM0ZDRjIiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 16:38:31 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IkRaYXBCRHdzeXRkbHNXNDlONnVIOHc9PSIsInZhbHVlIjoiNVRyYU14TjRDQkFRYzRxeFRlYVd5dk1hL054amtNM0hpazh2THF2SjhIUEtTYzJqbW5uNWVtRlRXYVJtb1VjZnRrbGh3ZHVZR3RYU3FCNktxa2FjQ1hsYnVvcDFIRXU2Y1NsVXhnWDNKdXhPSVlGRU9KYXlKWVNpdFVsUzdkd3MiLCJtYWMiOiI5NDIxNTUyYWI4MTY1NjcyYzM2ZTZhMDBkNDVhM2EzOTg4NTcyZTFkZWRmODAzNDM2YjQxZmYxZDdhOTEwNDM0IiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 16:38:31 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Voltamos logo!HTTP/1.1 302 Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Sat, 28 Nov 2026 14:38:31 GMT
Location: /ola/visitante
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6IlBpWHZtMlB3Mm1iMC9GN2h2TzBETEE9PSIsInZhbHVlIjoiVVg4NWwxZnkzaXpvS0VJeW5ZTmMzdXFDbWJMcDlmS0VqaVUwQmV5T2U2UUlWY2dxcHpuYW90eWNIVGNhOW1vdnZBRHFCUk1PSzhqczYzMDd1YVBNYXRWTkttUXRQblBsWGlGclIraDhSRXo3NUdHMCtlZytQK0pWUVc2UHZoZmciLCJtYWMiOiJlN2MxMTViN2ZmNDNmMzVlODFjYTA2ZDE2MTJlNWQyODI3NGQwMWY4NDkxZTc1Y2I5YzRlMjk1ZGMwODZjMDA5IiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 16:38:31 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IlB3aWZkMWRpdS9NWGxDOGU4V1IvVnc9PSIsInZhbHVlIjoiVjBMWS9MMlYzR0tQbnJXa2lNYVp2WWhZVEcwYjhDMktBd2UzRmZidkswdmlCVi9ZOFJtRGp5aUUyU25QOVpFRUZFY25kdWIwb2FYQnBHNXVzbnZzSDBsaHVvRW53dTVFT1JXbzJQRDl5ci9lb3F1N2lhMHRtb3ppazluWFVrNHMiLCJtYWMiOiJmMmI2ZThmZDA4NjNkOTM5ODQ0ZmU4NTc3YWExOTU0MTA1NGI2NjQ2YTA3MDIyZTEzMzVhMTkzYzFiN2JhNDljIiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 16:38:31 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='/ola/visitante'" />

        <title>Redirecting to /ola/visitante</title>
    </head>
    <body>
        Redirecting to <a href="/ola/visitante">/ola/visitante</a>.
    </body>
</html>
```

a) Content-Type do /status: 
* /status (HTTP/1.1 200 OK): como a rota devolve um array PHP, o Laravel serializa a resposta para JSON automaticamente, gerando o cabeçalho destacado: Content-Type: application/json

* /manutencao (HTTP/1.1 503 Service Unavailable): devolve o texto 'Voltamos logo!' com status 503 e Content-Type: text/html; charset=UTF-8.

* /inicio (HTTP/1.1 302 Found): por ser um redirecionamento (Route::redirect), o servidor responde sem conteúdo principal e envia o cabeçalho destacado indicando o destino: Location: [http://127.0.0.1:8000/ola/visitante](http://127.0.0.1:8000/ola/visitante)
b) Ao acessar `/simular/abc`, o servidor retorna o status HTTP **404 Not Found**, e a *closure* nem chega a rodar porque a rota define a restrição `->where('quantidade', '[0-9]+(\.[0-9]+)?')`. O roteador do Laravel valida o segmento `{quantidade}` contra essa expressão regular antes de invocar a função e, como `'abc'` não casa com o padrão numérico exigido, descarta a rota durante a etapa de casamento de URL, evitando inclusive um `TypeError` no parâmetro `float $quantidade`, e encaminha a requisição diretamente para o `Route::fallback`, que devolve o erro 404.
c) Na rota `/simular`, apenas o **Model** (representado por `ProdutoPorPeso`) participou do padrão MVC, sendo acionado diretamente pela camada de roteamento (`routes/web.php`), sem a atuação de um **Controller** intermediando a requisição ou de uma **View** Blade, já que a própria *closure* devolve uma `string` pura no `return`. Nesse contexto, a classe de domínio (`App\Domain\Feira\ProdutoPorPeso`) pertence à camada **Model**, pois, no padrão MVC, o modelo não se restringe a classes Eloquent ou tabelas do banco de dados, englobando toda a lógica de negócio, regras de validação e entidades da aplicação, como o cálculo realizado pelo método `calcularPreco()`.

#### R04: Layout, menu e página inicial

a) resources/views/inicio.blade.php: é a view principal chamada pela rota (view('inicio')), responsável por definir o conteúdo específico da página (@section('titulo') e @section('conteudo')) e declarar que herda a estrutura base com @extends('layouts.app').resources/views/layouts/app.blade.php: é o layout mestre estendido pela página, que fornece a estrutura HTML (<html>, <head>, <body>, <footer>), insere o menu e encaixa o conteúdo dinâmico nos pontos marcados com @yield('titulo') e @yield('conteudo').   resources/views/partials/menu.blade.php: é o fragmento reutilizável da barra de navegação (<nav>), embutido dentro do layout principal por meio da diretiva @include('partials.menu').
b) Usar `route('inicio')` em vez de `href="/"` promove a manutenção centralizada e o desacoplamento da URL, pois vincula os links ao nome lógico definido em `->name('inicio')` no arquivo `routes/web.php`, permitindo alterar o endereço de `/` para `/home` sem precisar editar o `menu.blade.php` ou outras views. Além disso, o helper `route()` previne links quebrados ao validar a existência da rota no momento em que a página é renderizada, disparando uma exceção imediata (`Route [...] not defined`) caso ela tenha sido removida ou renomeada, ao contrário de um caminho estático digitado incorretamente que só revelaria um erro 404 após o clique do usuário, e garante a geração segura de URLs completas considerando automaticamente o domínio, subpastas de hospedagem e parâmetros dinâmicos das demais rotas do sistema, como `route('produtos.show', $id)`.

## R05: A lista pelo controller

a) Isso acontece graças ao polimorfismo da orientação a objetos. O array $produtos percorrido pelo @forelse na view reúne instâncias de duas classes filhas distintas, ProdutoPorPeso e ProdutoUnitario, que herdam da mesma classe mãe abstrata (App\Domain\Feira\Produto) e implementam, cada uma à sua maneira, o contrato do método calcularPreco(float $quantidade). Por meio do polimorfismo, a view não precisa verificar qual é o tipo concreto de cada objeto com estruturas if/else: ela apenas invoca a mesma assinatura $produto->calcularPreco(2) e o PHP decide, em tempo de execução, qual implementação rodar de acordo com a classe real daquela instância, executando o cálculo por quilo (que aceita valores fracionados) quando o objeto é ProdutoPorPeso, ou validando se a quantidade é um número inteiro antes de multiplicar pelo preço unitário quando o objeto é ProdutoUnitario.
b) Na requisição `GET /produtos`, o navegador envia o pedido ao ponto de entrada do Laravel (`public/index.php`), que consulta o arquivo `routes/web.php` e encontra a rota `Route::get('/produtos', [ProdutoController::class, 'index'])`, acionando o método `index()` do `ProdutoController`. É nesse momento que as classes de domínio (`App\Domain\Feira\Produto`, `ProdutoPorPeso` e `ProdutoUnitario`) entram no fluxo, pois o controller chama `$this->itens()` (e `criar()` para os itens da sessão) para instanciar esses objetos, aplicando as validações do construtor e encapsulando as regras de negócio de cada produto. Em seguida, o controller repassa a lista para `view('produtos.index')`, onde o motor Blade monta a página combinando `layouts/app.blade.php` e `partials/menu.blade.php` e interage novamente com os objetos de domínio, invocando métodos como `$produto->getNome()`, `$produto->tipo()`, `$produto->calcularPreco(2)` e `$produto->getEstoque()`, até enviar o HTML final renderizado de volta ao navegador com status `200 OK`.

## R06: Detalhe, abort(404) e fallback

### Saídas
```
(cole aqui o curl.exe -i de /produtos/99 e /qualquer-coisa: primeira linha e Content-Type)
```

a) _(responda aqui)_
b) Saídas coladas acima.

## R07: JSON pelo controller

### Saídas
```
(cole aqui o curl.exe -i de /produtos/json)
```

a) Saída colada acima.
b) _(responda aqui)_

## R08: Formulário de cadastro

a) Testes:
1. Enviar vazio: _(o que apareceu)_
2. Preço `abc`: _(o que apareceu)_
3. Preço `0`: _(o que apareceu)_
4. Cadastro certo: _(o que apareceu)_

b) _(responda aqui)_

c)
```
(cole aqui a primeira linha do curl.exe -i -X POST)
```
_(por que 419?)_

d) _(responda aqui)_

e) _(responda aqui)_

## R10: Testes finais e explicações

### route:list
```
(cole aqui a saída de php artisan route:list --except-vendor)
```

### Caminho de três requisições
1. Closure: _(ex.: GET /simular/2 -> rota (web.php) -> closure -> objeto ProdutoPorPeso -> texto 200)_
2. Controller e view: _(responda aqui)_
3. JSON: _(responda aqui)_

### Perguntas de revisão
1. Qual a diferença entre uma requisição GET e uma POST? Dê um exemplo de cada no seu sistema.
   _(responda aqui)_
2. O que o `declare(strict_types=1);` muda? O que aconteceria ao passar `'12'` (texto) para um parâmetro `float` com ele ligado?
   _(responda aqui)_
3. Por que os atributos das suas classes são `private`? Como a view consegue mostrar o nome do item?
   _(responda aqui)_
4. Qual a diferença entre `{{ $x }}` e `{!! $x !!}` no Blade? Qual é mais seguro e por quê?
   _(responda aqui)_
5. No seu projeto, onde está o Model, a View e o Controller? (Lembre: ainda não usamos banco de dados.)
   _(responda aqui)_
6. O que acontece se uma rota nova for escrita abaixo do `Route::fallback`?
   _(responda aqui)_
7. O que significam os códigos 200, 302, 404, 419 e 503? Em que parte do seu sistema cada um aparece?
   _(responda aqui)_
