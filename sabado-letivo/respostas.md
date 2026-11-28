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

#### R06: Detalhe, abort(404) e fallback

### Saídas
```
HTTP/1.1 404 Not Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
date: Sat, 28 Nov 2026 15:38:41 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6ImRnKzhQenV1QnU3UkNIajRhSncwd3c9PSIsInZhbHVlIjoia0hNOEhjU1l2ZEtQbjRTaGRnM0Vid2VlQVZmSWhQWExRSk1oTG1vR3BTcHZkd1JMN295UWVydDR1OEFMVkRjOVVLTGhnS1ZaT0JQTVRIUlE4U2lkaW5zMTI2RUpOVkJtUEJjY2hublpCUjJIV09IRzJZWXp1RDB6Q3F5N0lEblgiLCJtYWMiOiIyZTNkMzY4MDQ3NGI3MTFjMmM2NjcwNTMxNTEwZmFkNTU0NDZmNjkzZmRlOTA1OGM1MjNmNzJkYTBmOWE2YTMxIiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 17:38:41 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IktxNzl3UDJQT1hhY2NBR3g2dzI5THc9PSIsInZhbHVlIjoiKzE0UEVLMUVWOXFzNTFEaktVeG5taG1Vb2c4Z3BJTzdXdEQ5c1RUc3F6ZmZ4VDBPMXRNRjZKcnM5ZW51bzl5dWU2ZS9waVdNRHhlbU5PRmlwQklKK252dk5wYlNhVit5ZGhvM0pwMG8wTHVlQlZmaE9nc0VTcFdWU0pwMjdleE0iLCJtYWMiOiIyZDU5ZTA4ZDg5Mjc1Y2JmOGU2NDgwM2QwNjU4NjBiYTY5NmRlZDBiZmZiYmRkYzE0YzZmZjE5N2FiOGJhY2RlIiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 17:38:41 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-300 { --text-opacity: 1; color: #e2e8f0; color: rgba(226,232,240,var(--text-opacity)) }}
        </style>

        <style>
            body {
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }
        </style>
    </head>
    <body class="antialiased bg-white text-black">
        <div class="relative flex items-top justify-center min-h-screen bg-white text-black sm:items-center sm:pt-0" role="main">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <h1 class="px-4 text-lg text-black border-r border-gray-400">
                        404                    </h1>

                    <div class="ml-4 text-lg text-black">
                        Not Found                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
HTTP/1.1 404 Not Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Sat, 28 Nov 2026 15:38:41 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6ImNvVUJja2pld3VaM1BwVy9JcXEyY2c9PSIsInZhbHVlIjoiTUhERkprZE1odFdZQjdidHZnK05ib2c1WEp2TUI2azlYTlh3M2Qzb0JMZHFjWXlXSWVMeXhTOFduVHIwOTJFRVpXVm5Xa2JFZjAwZE1kZkgrMk1xVDYwcVQyY0VYdVJsMHltelpJMTlGUFI1TEw0OGt4dzVya25BMVIxN04rWloiLCJtYWMiOiI5MDI0NWVkYTg1ZThkM2JlMTc4Njg3YzY4OGM2NWE4OWFmYzg3YjU4ZWVlNWU1OTJmN2M1MDYyYjczYzc0NzM2IiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 17:38:41 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6InAvOWhSdkJVUHpvSDRIQXJpd0VRWHc9PSIsInZhbHVlIjoiVC9FWXFhYUZHM3UwM1dHMENBM0VrOUIrbnRRZnFxaGpvRzNFNmJtMlUxdEFTd25wbmpiMENPbm9qMTNYNFdob2dFUjRZU2xEQjkxcEJYUTRkUTZxbjBCaHNLTlh1VytmcEJQcnI2K0JCb1h5b05JYUNkSmtkbjBpOG92aFZITW0iLCJtYWMiOiI0NDMzZjc4NzRmZjJlZTIxYzBjZmM4NjAyYmE0MTg3ZjAxOGUzNDlkMDg3M2M2YWJmOTBhODJlZmE0N2JjZDA0IiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 17:38:41 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página não encontrada | Feira Digital</title>
</head>
<body>
    <nav>
    <a href="http://127.0.0.1:8000">Início</a> |
    <a href="http://127.0.0.1:8000/produtos">Produtos</a> |
    <a href="http://127.0.0.1:8000/cardapio">Cardápio</a> |
    <a href="http://127.0.0.1:8000/sobre">Sobre</a> |
    <a href="http://127.0.0.1:8000/contato">Contato</a> |
    <a href="http://127.0.0.1:8000/inscricao">Inscrição</a>
</nav>
<hr>
    <main>
            <h1>Essa página não existe na Feira</h1>
    <p>Use o menu acima para voltar.</p>
    </main>

    <footer>IFCE Campus Boa Viagem</footer>
</body>
</html
```

a) Em /produtos/99 — quem respondeu foi o ProdutoController (com a página 404 padrão do Laravel): a URL casa com a rota Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->whereNumber('id'), pois 99 é um número válido. O método show(99) executa, verifica que não existe nenhum item com índice 99 no array $itens e dispara manualmente a função abort(404). Como essa exceção HTTP não passa pelo Route::fallback, o próprio tratador de exceções do Laravel renderiza a view interna padrão de erro 404 do framework.
Em /qualquer-coisa — quem respondeu foi o Route::fallback (com a sua view personalizada nao-encontrada.blade.php): nenhuma rota declarada no routes/web.php corresponde ao caminho /qualquer-coisa. Assim, o roteador aciona a rota de escape Route::fallback, que executa response()->view('nao-encontrada', [], 404) e exibe a mensagem personalizada "Essa página não existe na Feira" dentro do layout da aplicação.
b) Saídas coladas acima.

## R07: JSON pelo controller

### Saídas
```
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Sat, 28 Nov 2026 15:42:23 GMT
Content-Type: application/json
Set-Cookie: XSRF-TOKEN=eyJpdiI6IjJxMVZMTEJKSFVYTk5sV1owc1Jva0E9PSIsInZhbHVlIjoiWUZjSm1JUDhreVFPMlNXVFZ5cUl6MlU3U2NQSXVIK2Y0RWk4MWl0OWExMENQRmpYQWJXUXViUHd3VUVMZTFQTFpNNmdGa0Fpclk3K1ZUUzdqT0hja1YxYzlXR2ZwS1BGeCtvVk1KdVU1c3JaL2xCOStjWjMvS0tmRG5YSTI4QU4iLCJtYWMiOiI4Nzk4YTE2MDczZjhiNjk1MmE2ZGFmYTMzYWZhMzU3NDBkNmZlOGNiNTk5YzY0NTRiN2FmM2VmNGY3ZTYyZGI3IiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 17:42:23 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IldsVjhQeGVrcVZKdTZROVdMREVWS3c9PSIsInZhbHVlIjoiQlRXb2pxdS9qRjNSOUJ2dUo1YXA2N0x2TEpPQUd1K3JneUVVSk9oTnBtVW12RCt0eHowdWE0WXJaWGNSUFlvYkRCME1IWld3WlladkFOOEhwTndseXVqOE9wdENNZGdubXpTSUhNMG5rK2t3TEFDdW1naitEbUdLemp0emNsN08iLCJtYWMiOiI0ZDkwYmIyODQxMzJlZGIwZTE5ZTlmMGI5MTgwZjI3NWY5MjFkOWNlYmM2MGIxYWRmNTA3YTFkNGExZWY0Mjc5IiwidGFnIjoiIn0%3D; expires=Sat, 28 Nov 2026 17:42:23 GMT; Max-Age=7200; path=/; httponly; samesite=lax

{"1":{"nome":"Queijo coalho","tipo":"por kg","preco":25.5,"categoria":"laticinios","estoque":12},"2":{"nome":"Mel de abelha","tipo":"por unidade","preco":30,"categoria":"mel","estoque":0},"3":{"nome":"Rapadura","tipo":"por unidade","preco":4,"categoria":"doces","estoque":25},"4":{"nome":"Doce de leite","tipo":"por unidade","preco":15,"categoria":"doces","estoque":8},"5":{"nome":"Nata fresca","tipo":"por kg","preco":10,"categoria":"laticinios","estoque":5}}⏎           
```

a) Saída colada acima.
b) Ao retornar `response()->json($this->itens())` sem o `paraArray()`, cada produto aparece no JSON como um objeto vazio (`{}`), resultando em `{"1":{},"2":{},"3":{},"4":{},"5":{}}`. Isso ocorre porque, para serializar os dados, o `response()->json()` do Laravel utiliza internamente a função `json_encode()` do PHP, que por padrão lê apenas os atributos públicos (`public`) visíveis fora de um objeto comum que não implementa a interface `JsonSerializable`. Como todos os atributos de `Produto` (`$nome`, `$preco`, `$categoria` e `$estoque`) são `private`, o serializador não tem permissão para acessá-los, ignora todos os campos e gera `{}` para cada instância de `ProdutoPorPeso` e `ProdutoUnitario`, problema que o método `paraArray()` resolve justamente por executar dentro da própria classe `Produto`, onde os atributos privados são acessíveis, devolvendo um array associativo comum que o `json_encode()` consegue converter normalmente.

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
