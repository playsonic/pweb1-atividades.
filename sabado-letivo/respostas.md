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


## R04: Layout, menu e página inicial

a) _(responda aqui)_
b) _(responda aqui)_

## R05: A lista pelo controller

a) _(responda aqui)_
b) _(responda aqui)_

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
