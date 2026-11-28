# Aula 06: Laravel na prática

Nome: Dan Mendes

Projeto: `aula06-pratica` (Feira Digital)

## A01: Meu cartão de visita

### Saídas
<!-- curl.exe -i de /meu-nome e de /cartao -->
```
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Content-Type: text/html; charset=utf-8
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:20:31 GMT
Set-Cookie: XSRF-TOKEN=eyJpdiI6IityZ0R0RVpjK2ZiMmRiZ2U1cFBDQWc9PSIsInZhbHVlIjoic1JVWUZoV2R2eHJKYW5QM2pCNHA5S2ZyREdwcGVPcU8yZk9VYVk1Y1lqVHpZbXVtbEtkMDIyaVMrelhVaklPOXUyQWZWZUZhSmRIT1VGemJDTVZuem02RWxFY2NyN3lpemhIbWRjYWJzc2lRRjJHb2ZsZmdjWThyY2I0aXpKdWoiLCJtYWMiOiJmYWYyNWMwZjJlNjM3N2JlYWVjMzY1NDE2ODgxYTZlNTk2ZjE2ZTZjMzkyODAzMDBhYWQwZGM4ZDQzOTI2ODA3IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:20:31 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IjhRbHFGc1FXdUhYNGtuT241YnlPdmc9PSIsInZhbHVlIjoiYm9adGprSXlFM3RneSttLzBvOUp3NnJjYnZ3OXQ3azRuMkNiTUJEZzV1ek9VOVlDKzFTZkZyQjREeHBSM2R3Tk1oTGRIK3N2VE41aGZ3VllWRjJYRy9FRGVIdU5ldWhqc2VKYWkvN1pURFYxVnNqeCtud2tsVjlkRW1SaEJ2ckciLCJtYWMiOiI3NzFhNDg1NDgxMzM5NGViMzA4OTYwMmY5YmNkNzc3MGM4YWVlN2VkNGM3OWQ0YzFjNTE2OTQzN2EwOThjNjc2IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:20:31 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Meu nome é Dan Mendes e estudo ADS no IFCE.HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Content-Type: text/html; charset=utf-8
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:20:31 GMT
Set-Cookie: XSRF-TOKEN=eyJpdiI6Ik1MbFNaakk0YmRzdm9yT3hFWmpXYkE9PSIsInZhbHVlIjoia1gxRGx4MDd2WFNaM3ZWTXJRNzl4TjA3S3ZWbC92MmZ5QWUrQkprNE40V0gzZ3lDYjg3L2Nnb3J2cVIrUTUrRURKdHY3cm4xVkkzVnNnUThETTB0d3FYRDc1YVJBUDUwbTJPYXk5akhLQXNBZkViTGlXeEl4N01iS0VSRWJXd2IiLCJtYWMiOiJhODNjYTE3NTRlMjkyNDEyNTJiZjJkN2VjMTRhMzg5NDg3MjRhOWI2NDUwZjQ1NGJhZDgxMmI0NWM3MmVkYjBhIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:20:31 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IkVaYTdCTzkyNFprZWU1S1owYmdkeWc9PSIsInZhbHVlIjoiNUNTMXFMWUQ4RSsrbnlDeWdzQUVFakJKaGxEbjZMcXc0aWU4LzVQYlB5cHV2cnBabjViZW5NMHVoTDBPQVNLNXVRbzYrak53QXpTTEJBRVlmYjBTYTdhb0lMYnkwc01KSm1oSzBKZTdFeG8xT3VzY1ZvZEhxYU5sRHZFeC9tN1EiLCJtYWMiOiJhNWI2YmJlYzFhZTk0NWJlNWUwYmI1YjQzZmY4MmFmM2Y0ZjUwMDY4NjVlMTFlZmRjOWY0N2JhMTY3OGYzZTdhIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:20:31 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<h2>Dan Mendes</h2><p>Semestre: 4º semestre</p><ul><li>Programação Back-end</li><li>RPG de Mesa</li><li>Linux e Self-Hosting</li></ul>⏎                                                                                                     

```

### Caminho da requisição
GET /cartao -> rota (web.php) -> closure -> HTML 200

### Respostas
a) O `Content-Type` de ambas as rotas é `text/html; charset=UTF-8`. Ele é o mesmo porque, quando uma rota no Laravel retorna uma `string` diretamente, o framework define por padrão o cabeçalho `text/html`, independentemente de a string conter tags HTML (`<h2>`, `<p>`, `<ul>`) ou apenas texto puro.
b) Ao acessar `/meu-nome/`, o servidor redireciona (`301 Moved Permanently`) para `/meu-nome` (sem a barra final) e exibe o texto normalmente. Já `/Meu-Nome` retorna erro `404 Not Found` (caindo no `Route::fallback`), porque as rotas no Laravel diferenciam maiúsculas de minúsculas (*case-sensitive*).
c) O caminho da requisição é `GET /cartao -> rota (web.php) -> closure -> HTML 200`. Ficaram de fora todas as camadas do MVC: **Model** (sem acesso a dados), **View** (o HTML foi retornado direto como string, sem arquivo `.blade.php`) e **Controller** (a lógica ficou direto na *closure* da rota).


## A02: Meu perfil em JSON

### Saídas
<!-- curl.exe -i de /perfil-json e de /perfil-criado -->
```
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:21:26 GMT
Content-Type: application/json
Set-Cookie: XSRF-TOKEN=eyJpdiI6IksvU2g2M3BGbEZBdnljQlJ5U3paQnc9PSIsInZhbHVlIjoiMGVsQ2ZLdXZMK09TcXlHcXg0ZkFwN0JUTlZEczRwR3E5S2N4U1RKc25XdERTT3RqYmxIVmJIMU51WmNGaFphUSsxbFNhK1o1WVFKQjd3Q2RtZUlxVnp3SWRQbm50d2RVMmV0TGhDcmtMZFZreFRVM3IyNURhdWJYUWpPRENsMXoiLCJtYWMiOiJiOTRlYmEzYmY2NmNmY2QwZTA1Y2M1MDU2M2RkNjFkNGNlNmJjNGYwNDhhYTMzOGIwMjczZmI1M2M4NTQ2YTQ1IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:21:26 GMT; Max-Age=7199; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6Ik9JamNJNUIza1p6Q0dLVGo0RTdWYVE9PSIsInZhbHVlIjoiYWVXd1dLajF0QXlmd3BEemR2WVV0RWVpZkdyZUh0MjRmSVluSlpReDR5VW5GcGlHVXlwWUtZTG9Wb2Z1cDZwaXBNRWpGQ2kyd2lWcG9IZlhyczlQVU9VNTErbFpTYXA5OHJSRmVxSGFiRzhua3lLZDBieUlPUmJPZ1FhbzNuYWoiLCJtYWMiOiIwYmY4MDUzYjI1YzE2NTg3YTE4NDk0MWZmOTMwMzFiNTdkOWYwZDZjZDFiODFkNzMxZjRkZWVhOTMxOTg2OWFmIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:21:26 GMT; Max-Age=7199; path=/; httponly; samesite=lax

{"nome":"Dan Mendes","semestre":4,"media":8.5,"bolsista":true,"disciplinas":["Programa\u00e7\u00e3o Web I","Banco de Dados","Engenharia de Software"],"endereco":{"cidade":"Boa Viagem","uf":"CE"}}HTTP/1.1 201 Created
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:21:27 GMT
Content-Type: application/json
Set-Cookie: XSRF-TOKEN=eyJpdiI6Im9ZMkg4dGFWUnFGS0I0b2NLdUZOTlE9PSIsInZhbHVlIjoiNTdoUUlMVVJESjYyU0NJVjR5ZmJjR09VSjI5V0JMMlVBSU1Hd3VBSnFubmEwR0ZURWROS29YcnlWdjR6aE9ENG9XOTFOL2RnQ3Bha2J1Y3VxRFh4SWNZQ2tXb1QzRWp5UjBuVkxqNnRqdTY4TWdVcWp5S0E3U01EUmRLbVZJOFEiLCJtYWMiOiJlMTM4YTM5YjAyMmJmNzJlNzI3NGRhMjA3OGIyNzNhOGI5MTY2MDQyOTEzYWQ2MjI2YTcyYWI3OTJiZjNhM2NjIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:21:27 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IlF5SEplakJOc2laaGxPWTV0YVBMNmc9PSIsInZhbHVlIjoiNzY2Z1lqZExJeUVGMkJjMUQzc3FTaXRWclptdXFRdUVtaVBRc3YwRWFFclIvWnBSNHo0K3ArZDRiNkQ3TCtXOXhrZTljeWhWZ0p4b1kzOUhKT0NIb1E2eGVpOWVsMkZkeHovdGMzSXorL2NwTGtvV3lVeVVmVDlSM1BvWFhkTkoiLCJtYWMiOiI3NDRhZGIyNzc3MGE0Y2ZiZjgxNmI3MDQ4YmJhMjBjNGMxOTcxYmEwMGIzNmVlZjk3NjllYzk4YWVkNGNlYTJlIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:21:27 GMT; Max-Age=7200; path=/; httponly; samesite=lax

{"nome":"Dan Mendes","semestre":4,"media":8.5,"bolsista":true,"disciplinas":["Programa\u00e7\u00e3o Web I","Banco de Dados","Engenharia de Software"],"endereco":{"cidade":"Boa Viagem","uf":"CE"}}⏎                                        
```

### Caminho da requisição
GET /cartao -> rota (web.php) -> closure -> HTML 200

### Respostas
a) Na primeira linha (status HTTP), `/perfil-json` retorna `HTTP/1.1 200 OK`, enquanto `/perfil-criado` retorna `HTTP/1.1 201 Created`, refletindo o código de status `201` informado no segundo argumento de `response()->json([...], 201)`.
b) No JSON, o booleano `true`/`false` do PHP manteve-se como `true`/`false` literal (sem aspas). O array `disciplinas` virou uma lista JSON entre colchetes `[ ]`, enquanto o array `endereco` virou um objeto JSON entre chaves `{ }`. Isso ocorre porque `disciplinas` é um array indexado numericamente (`0, 1, 2...`), convertido para array JSON, e `endereco` é um array associativo (`'cidade'`, `'uf'`), convertido para objeto JSON.
c) Se a nota fosse `8.0`, ela apareceria no JSON apenas como `8` (sem `.0`), pois o `json_encode()` padrão do PHP omite casas decimais zeradas de valores `float`.


## A03: Tabuada e idade

### Saídas
<!-- curl.exe -i de /tabuada/7, /tabuada/sete, /idade/2005 e /boas-vindas-turma -->
```
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Content-Type: text/html; charset=utf-8
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:23:35 GMT
Set-Cookie: XSRF-TOKEN=eyJpdiI6Iml3UjcxZHNLQlRROFZ6RjM1ZnpGVUE9PSIsInZhbHVlIjoiaXJ3QXEvQW9hRnNpTnFZYUhUMDROY2szYVhWbVZvZ3RzeEVSM2Yyd3ZOd1Q4bXQ2dGticHVwWjAwSzI0VVN0WHltTGZPQ0Z4ZXZ6cFlHbU1oa3pOTk9sS2dLeTExT3YyRnhESmY4ZkdCbUZCZGErU0lVU0thcmlBOUZVUW5lZ2QiLCJtYWMiOiIyOGI4OGRhNjk1ZjE1MDZiYmFkM2IzZDM4NmViYzYwZDE2MjIwM2ZlNTdlYWVhNzkwZjg4YTJhNTIyMGY3YzY1IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:23:35 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IlVxOHAxN3hkYnpyVVdkMXd1TVY0YkE9PSIsInZhbHVlIjoiWTUramZCVDNjaThYNFZTV0pWWDV5bVoxclJpUlk0T2xNbWd6N0U0T29qS1hDaFNRNlB6ZG9LblVQeUxxbDRNOVRmQ3dhR094aUdJY0NJem5nemxQVjlmcHBuTFJMRVp5dnZIa0pKSEJPQzlxV2ptYTFMdVE4OVpaRUtzVmRaYnQiLCJtYWMiOiJjNzNiMzQ5YjQ2ZjJlZDI1OWY1ZDU2NTM0YTdkNjFkMTIyNTE4ODUwNDhkMjQwNDNhN2E1YjA1ZjcxNzE3YzBjIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:23:35 GMT; Max-Age=7200; path=/; httponly; samesite=lax

7 x 1 = 7<br>7 x 2 = 14<br>7 x 3 = 21<br>7 x 4 = 28<br>7 x 5 = 35<br>7 x 6 = 42<br>7 x 7 = 49<br>7 x 8 = 56<br>7 x 9 = 63<br>7 x 10 = 70<br>---
HTTP/1.1 404 Not Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:23:35 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6IkdNNms1T0FEQXhHZ1gwdEtGVU1NSmc9PSIsInZhbHVlIjoiQlFZTHhoV1FKRms5Z1lYbUhLWGFXczMyT2VqdnFNK2FGbXgza3RqSlNaV0dDMkM1bE5pdC96R1ozaTluUnZFVjNENWtOUXF2RVBDVk1YM3kvRWZ3T0pFdXo3ejJPSHhCaXRlSFdxWWpKd0JSUVZMdU40b0VWaWxBTHZYUGdqVjIiLCJtYWMiOiI4YTA1ODNlNTU5ZjRlYzViZGE2ZjA4OTgyYTYyMmJjNzA3ZTU3Mjg0Y2E0Zjk5ZmZhZDU3N2Y4OWRmNTkxNTliIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:23:35 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6Ik9vUkFrN2JLMmpMYlZqRWI4QlhRY0E9PSIsInZhbHVlIjoiNWlRcXlBekIzZnFCMFppNHU5Z05leFFyb2phOVhidm44KzRDYkgveDl6N3pLcjlZKzQwMEpPb0JVNkkyRHZyUzFObEhhWDdmT3UyWjJGckNvTFhEOGwvRzdyUFNEVytUdFJpNzhKZ3Q0b25XeW9LSU1NNUU4ZTRURU1kbndlM0QiLCJtYWMiOiIwODMzZjgxODJlN2ZhZTI4OWZlMTAyNjU2N2E2ZTU2ZmQ0ZjU5M2IxYWE5MTQyNGE5MjQ4MmJkYTgyYzQwZDRiIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:23:35 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página não encontrada | Feira Digital</title>
</head>
<body>
    <nav>
    <a href="http://127.0.0.1:8000/boas-vindas">Início</a> |
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
</html>---
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Content-Type: text/html; charset=utf-8
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:23:35 GMT
Set-Cookie: XSRF-TOKEN=eyJpdiI6ImdMNVV5dFRXSFpQWFpjUEhLWmtROEE9PSIsInZhbHVlIjoieTlOT25xRzFCUUw4dmltWDV3ZUZTWDVtS2NoMWtBek14V0NPTE96TnptNWZSMExtWE5KVEwvcng3b2tvcTM3RGxaR3BSSk9GaERGMUVRNXhUa3M2RUUwY1BqNy8wWVRDM1pOZ1gwUnFGQ0J5QXV1NkZseEZBbnpmRnFGTmM4MGYiLCJtYWMiOiJiY2Q5NTk4ODY4ODY0YzJjYzk5MmMyZDdjMjZlNjQwMTI0NWE4ZjQ1M2RhZTdjNGQ4OGIxYzlhZTJmOGJmZTBkIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:23:35 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IlhBbWwyblVrSlNTbXlPdWxETUp5aUE9PSIsInZhbHVlIjoibHYzRVpzaUtEM2ZueUc5N0dNUTFjKy9xbzVFRGMxV2xRYWhHRG9aZ1BvVVRaaUIzRmp4QTBuSm4rNG9BMktVNTZFNTdpbzlqWFQ2UktZcnVSYjhzdU1UN3dhNGRFWElZZVN0WC9HZDZsL2owRzhuaG1lbmY0V1FpeWJEQUhOR0IiLCJtYWMiOiI3Yzg0ZDgxNjUxYTdiY2M1ZjQwZWQyMjk2ZWExOWE0NjdhZmUzYWZkYTk1ZjU3M2IyZWE4MGQyYTUxNjI1ZjkyIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:23:35 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Quem nasceu em 2005 tem ou vai fazer 21 anos em 2026.---
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Content-Type: text/html; charset=utf-8
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:23:35 GMT
Set-Cookie: XSRF-TOKEN=eyJpdiI6ImJudFBmYVEvbVJzZk1xMUJxemJXZXc9PSIsInZhbHVlIjoiNVRRb0wyMUhEeTJtNWkxOXlFWUhucm9waW8zaW1HMUNSRkRjbmNZZ2E3bVkwUkU1K1Q5RjQ3KzlGanp0L2FmaFZTZlV3TWUrWEhyOTRTMjFtRFZiTW5PRm96TDdSOUh4enBQbzhwVGM5SldxREVDT0ROeGpRblNnM2pIbUdsMVEiLCJtYWMiOiJkN2ExYmVlODE5YzgxYjlmZmM0OWIxNzkxZTE4ZGE1YzJhMzBiMTA4YmY2MGM1NWYyMGNmOWY0MGI5M2I3ZWI1IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:23:35 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IlJDK0NxTFdJSUkvZ08zcDAvRHJmeGc9PSIsInZhbHVlIjoiRlY3YWtSQnhILy8vd0JLbTUvVHI1ZzJxZi9tbmZDem1GQ0diV2FSUDRENGgrWGxHOVplQ2xlZWV5S1dYT3JsTkhWenl6dE1iMTBjTGh3cmVuNkpwQlpRODhuc3FJMHh0WjYvYUFRamNDMzZhSEEwVnF5eE5XbHBzbFFHRDJHdFciLCJtYWMiOiJhMjQ4ODdmYjU3ODhjNWIyZGUxOTIwY2UwM2YwY2QwNzM4ZTk1ZTQwMDI5NTVhZDMzZjBkNmJmOTIyN2MyYTEyIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:23:35 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Bem-vinda, turma de ADS!⏎                                                                                                                                                                                                                  
```

### Caminho da requisição
GET /tabuada/7 -> rota (web.php) -> closure -> HTML 200

### Respostas
a) Apareceu a página de erro **404** (`nao-encontrada.blade.php` com *"Essa página não existe na Feira"*). Quem respondeu não foi a rota da tabuada, mas sim o `Route::fallback`, pois a restrição `->whereNumber('numero')` impediu que `"sete"` casasse com `/tabuada/{numero}`.
b) Sem o `whereNumber`, a rota aceita `"sete"` como string e tenta multiplicar `"sete" * $i` dentro do `for`, gerando um erro interno **`500 Internal Server Error` (`TypeError: Unsupported operand types: string * int`)**. Manter a restrição `whereNumber` é melhor porque valida o parâmetro na própria rota e retorna `404` de forma limpa, evitando exceções `500` na aplicação.
c) O `?` em `{turma?}` torna o parâmetro opcional na URL, permitindo acessar `/boas-vindas-turma` sem informar a turma. Se removermos o valor padrão (`= 'ADS'`) do parâmetro da *closure*, acessar `/boas-vindas-turma` sem argumento gera erro **`500` (`ArgumentCountError: Too few arguments`)**, pois a rota permite omitir o valor, mas a função exige o parâmetro.


## A04: Status e redirecionamentos

### Saídas
<!-- curl.exe -i de /admin, /em-breve, /loja e /produtos-antigos -->
```
HTTP/1.1 403 Forbidden
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:25:13 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6IjE3d09vUy9nYmN0ZmFzYk5PZEdpcnc9PSIsInZhbHVlIjoiVUhMSW5ZVkFGZlVWU3FBcWtkMkM2RGplNXlzOXBDMlV4RkwwRU5nMExoOGRsOGZxcDVrSmFmb0tzWUJabjNMaHlkdDVBNnpzT3kxenpqNEdGYzM2YkczNHFNTlJPVzBpT09TOWhZeFVncmY1bjNnRXNqNlF1WjZxYlJIc1J3dGQiLCJtYWMiOiIzNmQ3ZjlkY2YzY2IzNDU2M2VhNjZlNjFmNzk5ZTBiMWM1ZWYyYmY4Yzg4ZTY0NDE4NTdiNGViZmEyYmY4MzE1IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:25:13 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6InBxQ2JOOXpQR2xWT2srTDdIREthS1E9PSIsInZhbHVlIjoiUFBhWlVOc1Y5K254blRrUkhTUjAvRU1Kb2JxN0lMMFdGYmR3QTBtYlR3aTByRm9wM1hhUjhwZXRZYkswbjg3UmZqMmJzVWpnMnFrbFFHRlAyUk5GQjFLL0lQelFvajk3SFN4VG9RcXRNRHFLc2gwVS81dXhXdjBBUXZQcnREdFoiLCJtYWMiOiIzYjhmYjYzZGY4NWMzODc2MmY4ZmE3NzA0ZDQ4N2RiOWY4NjE1YzE0N2Q1ZGFmOTE3NmFhNmUxZWY0ZDdhOTVlIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:25:13 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Área restrita---
HTTP/1.1 503 Service Unavailable
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:25:13 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6ImlXZGRRT1NGeVM5UXVZUlRsTWpiTFE9PSIsInZhbHVlIjoiMTJwenI1RVA3WnRyRHVkR29SSU14aWxuT0JqdUZkZHFRL1l5em5MaWp2TFRMQ0ZzRDRoWTJuajNZK09VdmsxT0RueTBZZU9hUnh0amJsK0JqQ0dyWWZEakpGUityOU5uRXZxbnJEVU5NY0dFUithc1FkNUNFTm9LWUF0Q1Z3ZWgiLCJtYWMiOiI5MjhiNmVhZGMzNTk5ZTliOTFlYjU0YzhkNjZmM2U3ZDM5OTI3ZTAxMTkxZDc5MjQ0YzlmZjI1YzM3ODZmNWNjIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:25:13 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6ImY2ZUZqK3ZEL3ZVcnh3a0NXNG80dHc9PSIsInZhbHVlIjoiREMvb1J5dDJ4a3hTZit6RVhERGxPczA5Yk5BVmE5U0cvc0JyMjhVL3NScksxbWhOVGtKOGkwQnF2d2lWTmtLaHVqdjhhdlFXdmdUVy9jdFZmV0xnV2NUT09hUzV6Qk9VY2hqY3dSeGgvVEVxTDFrNHAySXBwSDJTVW82QkpXYm8iLCJtYWMiOiJkNjMwNDZlMGVmMjg5ZDNkMDUzMzRmYzUxOWI5MGMyNDY2OTA5ZjY1NzEyZTg1MmY5NDQ4OWMyNDhjZGExNDY3IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:25:13 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Página em construção---
HTTP/1.1 302 Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:25:13 GMT
Location: /feira
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6IkZ3Z3UrYVRZUUNMcTI5eFJBc1N3WUE9PSIsInZhbHVlIjoib3JyVUNITThSckQwc3ZNRlZrTjBQRmlyYUVOaDQ5R2hLN1ljQlBBUzc1SjVhdDFwKzAxQktPNFFoSU1Tci9TQTJ0REU5SnI2czJZVlZYakNNQ1dNbXVnL2dQWXpURGhzT3VjbDF5UjFmdUhHQTlENVUweTVwZVpYKzJPUVIxUUQiLCJtYWMiOiJkMmIzZDdjNDgxM2U4OTBjODQ2Zjc1MzBjMjZiMTFlZmQyM2IyODBmZDMzOWU5YzBmOTljYzNjYmUyMmFkNzBkIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:25:13 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6Ik1LelM0UzY2YUM5dHhFYXpJamVtakE9PSIsInZhbHVlIjoiLytFY1g5c3JNcmZaU2x0YXo2WkxON1lyOXRndmUrNGRzOG5ZOVJuZ1ZhTTB0SDVodzArSE5QL3F1NXlKR1RkOFk0TXZLcGxCeXhhZDJ3Y2k0ZmJvZXFnUFcrc3VLNCtqVGlxWmxJV1daQzB2TStndzRwdXhjbGlwcVhnNzl0dGkiLCJtYWMiOiJhOGQ3Y2U0MGEwOTJjZTExYzQ5YzgzMjgyMzhhNWY4ZWJlNGFkZjdkYmMwYmU2MzY0MjBlM2RkNGYxOTA5MjFmIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:25:13 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='/feira'" />

        <title>Redirecting to /feira</title>
    </head>
    <body>
        Redirecting to <a href="/feira">/feira</a>.
    </body>
</html>---
HTTP/1.1 301 Moved Permanently
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Date: Thu, 26 Nov 2026 01:25:13 GMT
Location: /produtos
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6IkpRakEwR05xbU9IblBleE84aFZCMXc9PSIsInZhbHVlIjoiRjFMRXJ1R2MwUlI5dE1FekRjNlRZeW5tR0wrdU4vRUZvZDNrRFd0UXhMZnRJSDFjTUo5UmhtVTY3bm5oUjdOLzU3OXZKdG5yUmF4V05HTVpxSDl1d3NnV01OUFhpS2RmVmswNXllYnZ6dVkwanBENlkrR0tHaDNQWndzMmRpRnoiLCJtYWMiOiI1ZTRmM2Q0MDg4ZmIxNDMyZTUyMzViZDgzNjI0OGI3ZGViMWJhOWVjZmQyYmQ3NGMwYmQwYTFiZjRjM2YyMTc4IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:25:13 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IlMzaGNKcEEwM2t0d0JnNnErZTQwakE9PSIsInZhbHVlIjoiWU1CaEpWWEVXeFA1Kzl2eXhxWTMzR0E5R01Cd1ZSam1BSFlKMFBxOHZxNFA0STUvLzJUaVZMSDJmZXhKYldvM2lVUlp5clEvenNvNEw0QUNkS0xMMFhTVTc1NVNpcXR6SGtJSDQ3VUFMZXRWZ1pBa2czc0F6NHVoT2FJWWN5OEUiLCJtYWMiOiI1YjM2NmI4ZmNhNzE2N2FiMjI5YmUxNzg5YmZhNDc3MWZkNjFiZWVmMTYzNGY3ZjQ3YzQ0NDM5OGVhYjhjYzJjIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:25:13 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='/produtos'" />

        <title>Redirecting to /produtos</title>
    </head>
    <body>
        Redirecting to <a href="/produtos">/produtos</a>.
    </body>
</html>⏎    
```

### Caminho da requisição
GET /loja -> rota (web.php) -> redirect 302 -> GET /feira -> view feira -> HTML 200

### Respostas
a) *(As saídas com as linhas `Location: http://127.0.0.1:8000/feira` e `Location: http://127.0.0.1:8000/produtos` estão coladas no bloco de Saídas acima.)*
b) Abrindo o DevTools do navegador (`F12`), na aba **Network (Rede)**, a requisição para `/admin` mostra o status **`403`** em vermelho na coluna Status; também é possível comprovar via terminal com `curl -i`, que exibe `HTTP/1.1 403 Forbidden` na primeira linha.
c) O navegador fez **duas requisições**: primeiro enviou `GET /loja`, recebeu `302 Found` com `Location: .../feira` e em seguida fez automaticamente `GET /feira` (`200 OK`). Já o `curl -i` (sem `-L`) mostrou apenas uma porque não segue redirecionamentos automaticamente, exibindo só a resposta inicial `302`.
d) Usa-se **`301` (permanente)** quando um endereço mudou em definitivo e os navegadores/buscadores devem substituir a URL antiga pela nova (ex.: migrar `/produtos-antigos` para `/produtos`). Usa-se **`302` (temporário)** quando o desvio é provisório e a rota original voltará a ser usada (ex.: redirecionar `/loja` temporariamente para `/feira` enquanto o carrinho de compras está em manutenção).


## A05: O cardápio da feira

### Saídas
<!-- curl.exe -i de /cardapio e a linha do Ctrl+U com a Panelada -->
```
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Content-Type: text/html; charset=utf-8
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:27:20 GMT
Set-Cookie: XSRF-TOKEN=eyJpdiI6ImNhMy9RVjBsSGdSNmczWGFSbnZyemc9PSIsInZhbHVlIjoiSU41YTBQOVp4ZnRleEdvS3RsdGpSTDJ5VExUT0hLb0RmcUxNL1FKbXJpeFI2YXlrTFlhR3d3MHFOVUZ1Qi8xUkNGalFhNUJPR3ZNNUlIOGlSNmg1TjJySUUxL0lFdnJGc3gvNmZGWEcySHBTVFpvOUZzUCt1WHJ5TldZSnp2bzciLCJtYWMiOiJjYTVkYjllODI1YjYzZjMwNWU4NTZjZGYzNjliMmVjZmNlYzkwNmJhNDQ0YWVjMDQyMjNkN2ExYzMzMmI0NzBmIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:27:20 GMT; Max-Age=7199; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IkVpeWpHMGgwOWZpVlFGeTZ5REtqK3c9PSIsInZhbHVlIjoiOU9JUklaa3RiMHJKQ3luOGh6Zi9SM3BPN2lkVmJLbjNLbVZqOTVDV1Vqd2xCaDFaTUVDZENDcGwwbkdBbmtUVWQvZFQrbjBGcWdkYW9qMWF6ZUhES2xYQjFlSVY4bXJTR2ZNajArYVBLa2lpbWJRTnlQcmEyMlZ1SjFGNS9mTE0iLCJtYWMiOiJiZGI3ZGIxYjRhOWMwN2RkYjU1M2MyOTM1ZTQyYTczN2QwYjI5NTRkM2EyNTkwZWYwODI5NjQyOTFmZmYwY2I3IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:27:20 GMT; Max-Age=7199; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cardápio | Feira Digital</title>
</head>
<body>
    <nav>
    <a href="http://127.0.0.1:8000/boas-vindas">Início</a> |
    <a href="http://127.0.0.1:8000/produtos">Produtos</a> |
    <a href="http://127.0.0.1:8000/cardapio">Cardápio</a> |
    <a href="http://127.0.0.1:8000/sobre">Sobre</a> |
    <a href="http://127.0.0.1:8000/contato">Contato</a> |
    <a href="http://127.0.0.1:8000/inscricao">Inscrição</a>
</nav>
<hr>
    <main>
            <h1>Cardápio da Feira</h1>
    <p>3 pratos disponíveis hoje</p>

    <ul>
                    <li>
                Baião de dois — R$ 18,00
            </li>
                    <li>
                Tapioca de queijo — R$ 8,50
            </li>
                    <li>
                Cuscuz com ovo — R$ 7,00
            </li>
            </ul>
    </main>

    <footer>IFCE Campus Boa Viagem</footer>
</body>
</html>

Linha do Ctrl+U:
<li>&lt;b&gt;Panelada&lt;/b&gt; — R$ 20,00</li>
```

### Caminho da requisição
GET /cardapio -> rota (web.php) -> closure -> view cardapio -> HTML 200

### Respostas
a) `GET /cardapio -> rota (web.php) -> closure -> view cardapio -> HTML 200`
b) Na página apareceu o texto literal `<b>Panelada</b>` (sem negrito), e no código-fonte (`Ctrl+U`) a linha ficou `<li>&lt;b&gt;Panelada&lt;/b&gt; — R$ 20,00</li>`. Não ficou em negrito porque a sintaxe `{{ }}` do Blade escapa automaticamente caracteres especiais HTML via `htmlspecialchars()`. Isso protege o site contra ataques **XSS (Cross-Site Scripting)**, impedindo a execução de tags ou scripts maliciosos injetados nos dados.
c) O Blade juntou três arquivos: `resources/views/layouts/app.blade.php` (layout base), `resources/views/partials/menu.blade.php` (incluído com `@include`) e `resources/views/cardapio.blade.php` (preenchendo `@yield('titulo')` e `@yield('conteudo')`).

## A06: Menu completo e rotas com nome

### Saídas
<!-- php artisan route:list --except-vendor e a mensagem de erro do item 4 -->
```
php artisan route:list --except-vendor

  GET|HEAD   / ......................................................................................................................................................................................................... routes/web.php:10
  GET|HEAD   admin .................................................................................................................................................................................................... routes/web.php:119
  GET|HEAD   boas-vindas ..................................................................................................................................................................................................... boas-vindas
  GET|HEAD   boas-vindas-turma/{turma?} ............................................................................................................................................................................... routes/web.php:114
  GET|HEAD   cardapio ................................................................................................................................................................................ cardapio › CardapioController@index
  GET|HEAD   cartao .................................................................................................................................................................................................... routes/web.php:57
  GET|HEAD   contato ........................................................................................................................................................................................ contato › routes/web.php:137
  GET|HEAD   em-breve ................................................................................................................................................................................................. routes/web.php:123
  GET|HEAD   feira ............................................................................................................................................................................................. feira › routes/web.php:43
  GET|HEAD   idade/{ano} .............................................................................................................................................................................................. routes/web.php:107
  ANY        inicio .............................................................................................................................................................................. Illuminate\Routing › RedirectController
  GET|HEAD   inscricao ..................................................................................................................................................................... inscricao.create › InscricaoController@create
  POST       inscricao ....................................................................................................................................................................... inscricao.store › InscricaoController@store
  ANY        loja ................................................................................................................................................................................ Illuminate\Routing › RedirectController
  GET|HEAD   manutencao ................................................................................................................................................................................................ routes/web.php:34
  GET|HEAD   meu-nome .................................................................................................................................................................................................. routes/web.php:53
  GET|HEAD   ola/{nome} ................................................................................................................................................................................................ routes/web.php:26
  GET|HEAD   perfil-criado ............................................................................................................................................................................................. routes/web.php:82
  GET|HEAD   perfil-json ............................................................................................................................................................................................... routes/web.php:68
  GET|HEAD   produto-json .............................................................................................................................................................................................. routes/web.php:18
  GET|HEAD   produto/{id} .............................................................................................................................................................................................. routes/web.php:30
  GET|HEAD   produtos ........................................................................................................................................................................... produtos.index › ProdutoController@index
  ANY        produtos-antigos .................................................................................................................................................................... Illuminate\Routing › RedirectController
  GET|HEAD   produtos/categoria/{categoria} ............................................................................................................................................. produtos.categoria › ProdutoController@categoria
  GET|HEAD   produtos/json ........................................................................................................................................................................ produtos.json › ProdutoController@json
  GET|HEAD   produtos/{id} ........................................................................................................................................................................ produtos.show › ProdutoController@show
  GET|HEAD   produtos/{id}/json .......................................................................................................................................................... produtos.show-json › ProdutoController@showJson
  GET|HEAD   sobre ........................................................................................................................................................................................ sobre › PaginaController@sobre
  GET|HEAD   tabuada/{numero} .......................................................................................................................................................................................... routes/web.php:97
  GET|HEAD   titulo .................................................................................................................................................................................................... routes/web.php:14
  GET|HEAD   {fallbackPlaceholder} .................................................................................................................................................................................... routes/web.php:168

Mensagem de erro do item 4:
Symfony\Component\Routing\Exception\RouteNotFoundException
Route [sobree] not defined. (View: .../resources/views/partials/menu.blade.php)

```

### Caminho da requisição
GET /cardapio-do-dia -> rota (web.php) -> closure -> view cardapio -> HTML 200

### Respostas
a) As rotas atendidas por *closure* exibem `Closure` na coluna `Action` do `route:list` (como `/`, `/titulo`, `/meu-nome`, `/cartao`, `/perfil-json`, `/tabuada/{numero}`, `/feira`, `/contato`, etc.), enquanto as atendidas por *controller* mostram `ClasseController@metodo` (como `App\Http\Controllers\PaginaController@sobre` e `App\Http\Controllers\ProdutoController@index`).
b) Porque todos os links do menu usam o helper `route('nome-da-rota')`, que gera o `href` dinamicamente a partir do **nome** da rota registrado no Laravel. Como apenas o caminho (URI) mudou e o `->name(...)` foi mantido, os links continuaram apontando para os endereços novos sem precisar editar nenhuma view.
c) A mensagem de erro é `Route [sobree] not defined.`. Ela aparece em todas as páginas porque o menu (`partials/menu.blade.php`) é incluído no layout principal (`layouts/app.blade.php`), que é estendido por todas as views do sistema; assim, o Blade tenta resolver `route('sobree')` ao renderizar qualquer página.

## A07: Do closure ao controller

### Saídas
<!-- trecho da rota antes e depois, curl.exe -i de antes e de depois, mensagem de erro sem o use -->
```
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Content-Type: text/html; charset=utf-8
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:45:58 GMT
Set-Cookie: XSRF-TOKEN=eyJpdiI6Im9YQ1ZjNHNIQVkybStjalphUW5kZ0E9PSIsInZhbHVlIjoidDlqODRkNEVuSStTeFd5NGJBeXRBZVNNVVZUc3M3eHM3MDFYZkkra3pCUjNTZmVnN3E3VGdKMGh0UmIybVpEUXVEb0piNGt3NDVNU24vS2FrL21hVkh4UFZLVkJHSklsM1NreExBYktIdHJaM2F6d3JyUVZKWklBTHRQWTFoR0MiLCJtYWMiOiJlZDFmYWVkZmEwNzljNjZkNGE5MDk5ZjUzOWRmMjFmODJiM2Q1NmM4MTcwZDhlMTE1MmQxY2U1NGYwODNmNTY1IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:45:58 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IkhENXBRU2l4QmpDZk5OUHdzM1B3UGc9PSIsInZhbHVlIjoiQ29Qd0wzOFA5YWc5bU1ZUlMwcTRaZWhzejdzd2wxeDFNUFRXTkVETjNIZUJxR1AzekNGT3M1Qzg3ZDJCNDk1eDFxejlIWWRIaHNGcFc3aXk3a0t4a0VyaHpNaVU4b0V0THV0WGlwUU1hMm1nSVpvN0tLd3IzZFdycjVUMWJYRFkiLCJtYWMiOiI3ODdjZDA4M2FiYTAzNmI3YTA2Mjk2ZTVmZmY5MjE1YWU0NmZhMzJmNzEyNzRmMmMzYzM1Zjg3MGZkOGNmYjc0IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:45:58 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cardápio | Feira Digital</title>
</head>
<body>
    <nav>
    <a href="http://127.0.0.1:8000/boas-vindas">Início</a> |
    <a href="http://127.0.0.1:8000/produtos">Produtos</a> |
    <a href="http://127.0.0.1:8000/cardapio">Cardápio</a> |
    <a href="http://127.0.0.1:8000/sobre">Sobre</a> |
    <a href="http://127.0.0.1:8000/contato">Contato</a> |
    <a href="http://127.0.0.1:8000/inscricao">Inscrição</a>
</nav>
<hr>
    <main>
            <h1>Cardápio da Feira</h1>
    <p>3 pratos disponíveis hoje</p>

    <ul>
                    <li>
                Baião de dois — R$ 18,00
            </li>
                    <li>
                Tapioca de queijo — R$ 8,50
            </li>
                    <li>
                Cuscuz com ovo — R$ 7,00
            </li>
            </ul>
    </main>

    <footer>IFCE Campus Boa Viagem</footer>
</body>
</html>                                                                                                                                                                                                                                      
Target class [CardapioController] does not exist...
```

### Caminho da requisição
GET /cardapio -> rota (web.php) -> CardapioController@index -> view cardapio -> HTML 200

### Respostas
a) A *closure* com a definição do array `$pratos` e a chamada `return view('cardapio', ...)` saiu do `routes/web.php` e foi movida para `app/Http/Controllers/CardapioController.php`, dividida entre `private function pratos(): array` e `public function index()`. No `web.php` permaneceu apenas o registro da rota apontando para `[CardapioController::class, 'index']`.
b) Agora o fluxo é `GET /cardapio -> rota (web.php) -> CardapioController@index -> view cardapio -> HTML 200`. A camada **Controller** (`CardapioController`) entrou no desenho do MVC.
c) A mensagem de erro é `Target class [CardapioController] does not exist.` (ou `Class "CardapioController" not found`). Sem a declaração `use App\Http\Controllers\CardapioController;` no início do `web.php`, o PHP não sabe em qual namespace localizar a classe `CardapioController`.
d) Usar controllers organiza o código separando responsabilidades: mantém o `routes/web.php` enxuto apenas com o mapeamento de URLs, facilita a manutenção e reutilização da lógica de negócio e evita que o arquivo de rotas cresça desordenadamente conforme o sistema ganha novas funcionalidades.

## A08: Estoque e categorias

### Saídas
<!-- curl.exe -i de /produtos/categoria/doces, /produtos/categoria/frutas e /produtos/categoria/123 -->
```
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Content-Type: text/html; charset=utf-8
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:49:34 GMT
Set-Cookie: XSRF-TOKEN=eyJpdiI6IkY3ejI4VUUwTnYwVHBqNjFXNTNMN1E9PSIsInZhbHVlIjoiL2VSTHlhYWNLNUxkTG9SWG5Pekp3dkIxdXJGQzNLWlNNZ3JXVUhKelQrdkRPd3hhSXFmbm1keDFtNWRhaDllaDF6NVZ6aHNQdEpKNS9iWVpuSGdmNndxMGxJYzRHQWxXUzlBRlc5bnoyV3JVYUl3VFgrU3ZWMGcrTTI1N2IxLzgiLCJtYWMiOiJkMDhiMzYyNjI0ZDRmZDg1YzUzZjVkZTRjZjViMjk5MWQ5MWRjMzk4MGNiYjZlZDk3ODJmZDUxY2Y5OGY3ZDM3IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:49:34 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6ImRMUUhWVGdXRlBic1Via0ZLbmxEU1E9PSIsInZhbHVlIjoiNUlENjEzMWIvbkJkN2grNVRpbytrbEMvVlU4TlJ4WjREc1dMQktITnRwOFdMS3lUcTJpZnBUYlZMWm0zVEx6TThiaC9VRko4QTR5d2ZLSXFueldWZnFvMG5vY3hUUVQ0K1hqUFBxcncvaFg3RXQzaFdTQ2hGYnREa3NPRkZMVXUiLCJtYWMiOiIyNWE2ZTlmOWFjMGIwY2YyMjU3ZmYxOWI4MmJiYjc4ZGMwNjE5MmIxN2RhOTY5MmZhYTZmYmU0Mzk0MWVmYjVkIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:49:34 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos | Feira Digital</title>
</head>
<body>
    <nav>
    <a href="http://127.0.0.1:8000/boas-vindas">Início</a> |
    <a href="http://127.0.0.1:8000/produtos">Produtos</a> |
    <a href="http://127.0.0.1:8000/cardapio">Cardápio</a> |
    <a href="http://127.0.0.1:8000/sobre">Sobre</a> |
    <a href="http://127.0.0.1:8000/contato">Contato</a> |
    <a href="http://127.0.0.1:8000/inscricao">Inscrição</a>
</nav>
<hr>
    <main>
            <h1>Produtos</h1>
    <ul>
                    <li>
                <a href="http://127.0.0.1:8000/produtos/3">Rapadura</a>:
                R$ 4,00
                                    — Estoque: 25 un.
                            </li>
                    <li>
                <a href="http://127.0.0.1:8000/produtos/4">Doce de leite</a>:
                R$ 15,00
                                    — Estoque: 8 un.
                            </li>
            </ul>
    </main>

    <footer>IFCE Campus Boa Viagem</footer>
</body>
</html>---
HTTP/1.1 404 Not Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
date: Thu, 26 Nov 2026 01:49:34 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6IjJPOXZpQjNvR1dNd2tKMktFQk8yK3c9PSIsInZhbHVlIjoia2ZuMmtBY3RiRm1yWk0xblF1TkRnNnZSdlBmV1c5RzR4aGpLbWQvWkFsRkhFUWNXNXB5NGZKWnZrMk1lUFc0WHhta1hSMEhQS0h3a0lqYTUySFV1QVZ3T1hUQkE2NTFLZC80aUVaTUFpMUM5MjY5M1d6bDhhSC9zVHMwU25ZY1MiLCJtYWMiOiI3YzdmYzc0ZDcwNDQ1ZWM1NzNhZGJiYjE4YzY3Yzc1YTRkNWU3NDVlYmI2OWJlYjZiNzQwN2QzNTQ4MTFhNTA4IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:49:34 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6IkhDN0l2dWQ4NDhrYzNvK2F1Q3VhbVE9PSIsInZhbHVlIjoiazZMZ3lLcmZJY1NkeXNVOENQV1MvRlI1eXdzcHZTd25NQyswRkZNM2xTK3Qyd09oK2o0ejd1Z1Z3RE0vVnZRZmpuaXZpazd0QlZCZEhIMTJtM1hMTHFhR29Fa05DM25MdnNqTWJGancxb21OaXFSVXZNMUNlMXVrSjBvSXV0azIiLCJtYWMiOiJiNDU0YWFjOTViNzM1NDllOGY1MjQ3ZTY5ZTMyNGE3NTM2NTk3Yjc0YzU3OWIyMWZjNjdlYjE5NDk5YzI1NjU5IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:49:34 GMT; Max-Age=7200; path=/; httponly; samesite=lax

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
---
HTTP/1.1 404 Not Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:49:34 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6IlE1RTZzMjZoYXJPQ3BNVnJHMlZmRlE9PSIsInZhbHVlIjoib08ya3ZkNjAyTGRCMWdoM1Bpd0tCNmZlMFVyS1NPUkxtR09menU4Nk4zNXdwYzFKV3NUM1MydFBuaGN1SnloTzJWMHNTZnVCOVZ3c1JRbXQ0U0lWcmNFSmIvQ05oVDFzRXVYeTQvd1lDRGNBK29oVHVmK0J4TXMwbkRQT3BRaVUiLCJtYWMiOiI1M2Q0OWMyYmUyYTU1ZTE4MGM0ZjcxMmU0MmFiMjJlYTZhYWYyNDE2YjJhZmVlYjVlOGI3YmZkY2Y5ZGY1Y2RkIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:49:34 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6ImdwK2FUYzNKb1kxaWlEM2IrTkZQRkE9PSIsInZhbHVlIjoiTG9nRlY4T2lrLzZ4b1IwZG1aZXNiK3ZoK1lIWmVDV2tWcTdGODVWc01WYTQxRElrUy9DMWYvSnVUMnB1OEEvRFdUZjVGb0I5Q3pWK2pDMjREOEtELzRmdy9pZ1hFV25zVkNmaWlyVWNoSm54QUU4Ky9LYTA1a0ZPSkFETzVxT08iLCJtYWMiOiIxYWYwYzVjZWJjYTkyMDcwOWVlN2ExNDY1Mzc2ZjY3Nzg5ZDk3MmZiOWNiYzM4NDc3ODlhMTk2YTI2NTIzNjViIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:49:34 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página não encontrada | Feira Digital</title>
</head>
<body>
    <nav>
    <a href="http://127.0.0.1:8000/boas-vindas">Início</a> |
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
</html>
```

### Caminho da requisição
GET /produtos/categoria/doces -> rota (web.php) -> ProdutoController@categoria -> view produtos.index -> HTML 200

### Respostas
a) Em `/produtos/categoria/frutas`, a URI casou com a rota (pois `"frutas"` tem apenas letras), mas o `ProdutoController@categoria` não encontrou produtos dessa categoria e chamou `abort(404)`. Já em `/produtos/categoria/123`, a restrição `->whereAlpha('categoria')` impediu o casamento da rota e quem respondeu `404` foi o `Route::fallback`. Em ambos os casos foi exibida a página 404 personalizada (`nao-encontrada.blade.php`).
b) Porque na view `produtos/index.blade.php` o loop `@foreach ($produtos as $id => $produto)` usa a chave do array (`$id`) para montar o link `route('produtos.show', $id)`. Como o `array_filter` preserva as chaves originais (`1, 2, 3...`), cada produto continua apontando para o seu próprio ID real no `show($id)`.
c) Porque as views Blade são independentes do controller que as chama: basta que o controller envie a variável esperada (`$produtos`) com a mesma estrutura de dados. Tanto `ProdutoController@index` (lista completa) quanto `ProdutoController@categoria` (lista filtrada) passam esse array para `view('produtos.index', ...)`, permitindo reaproveitar o mesmo template HTML.

## A09: Um produto em JSON

### Saídas
<!-- curl.exe -i de um produto que existe, de um que não existe e de /produtos/abc/json -->
```
HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:53:29 GMT
Content-Type: application/json
Set-Cookie: XSRF-TOKEN=eyJpdiI6InlsNTlyS1FhRjJtdWxXYnNIWXFtNXc9PSIsInZhbHVlIjoiODkxSmQwVUxPc1g1VlJnZDhwYXN0MXl5VXFGYkhzaUt0YmVtTTQ5aGRuOHhGTTFvem15YkROa2NjVUw2UFh1YXFNd1dZemtOb0taVy8xWXNlUDZZK21razBoaE9qeHlGZW8wQUNuQi9aRlhoVGR3dlg1SlVSNjhTU2JLZnJRN28iLCJtYWMiOiJkNDFhY2NlN2JiMTM2MjgxNmVhYjJmOGZjOTFiMGRhYTNmNjk1MjdkZDAyZDc5ZjE2N2NlOTVkYzkxNTM4MTZiIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:53:29 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6Ijc0b3cvUldiOWJMQ0pxRWkyQVh0bkE9PSIsInZhbHVlIjoiSERDWlRKaEU4bDVjNG9tZkozb1FLeXZHVEpndk56a1NZNWJiWGZuWUFZUWx1MUZlZG1wdmpQWnJwNkFoRXZBYjhmWmRtTm93bmoycXlhakRYVzFLc3JnK1h6cEFDbk15bXY2YWR2NGtvcmJiRFp0UmtkbmlkYU41ODlSWlN0YXIiLCJtYWMiOiI2YWFkYTVhMmE3NjU4ZWNkM2ViMTExOWFmMTlkMGY0MDU2ODhkZWQ0ZTI3YmJjZjE1MjVjODI4OWRhYzM2M2E2IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:53:29 GMT; Max-Age=7200; path=/; httponly; samesite=lax

{"id":2,"nome":"Mel de abelha","preco":30,"categoria":"mel","estoque":0}
---
HTTP/1.1 404 Not Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:53:29 GMT
Content-Type: application/json
Set-Cookie: XSRF-TOKEN=eyJpdiI6Ijk1VnRsRC9sTGg0OGtWcnl0eHd5Znc9PSIsInZhbHVlIjoiSWhNNzRkd0tiNTh4Sk9VQzQ4ZUxvNjdGQ0dLM3BjQkxYNEQxbWNya09PRkdPSmhySjY0Y3hVMnYzbFJ0Z3BtNmFKd1pYSUtrYURKbHlabmlhNEhqR2tCMlBicFp1ZS8wOU5sdjR5eVhoOVd2NG1KeElFNUdmUjFSR1h1TGVINEwiLCJtYWMiOiIzOWNhODhlMWRkZjdiNGMwNTg2ZWY5OWU1N2NiYjliYTZiM2U4ZDQ4N2U1NDJlYTEzNWY4YzZkY2NlZWZmZTA2IiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:53:29 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6Im5GdVJKRE1wdEljTWhadEl5VjJQQXc9PSIsInZhbHVlIjoidmlIWHhaSldvbExocmRuUlVnWmorR1p1Qzd6d2h3R2RCZFFsa0NkT3JjY3p6ZXlpUkFHQ0J1dlh3b21QeUhMdXZiZUpUWFQ0SmRhaUY4NnFlZjFwN2xPK1hSM0MzWHFhTVZtazd4ZVlxMjJ4c2ZQbU9uZ29SbElVTUVzSUxEWGkiLCJtYWMiOiIxNmNhMTA5MzM1ZWMzNTZiNzI5MGIzNDc0OTQ4NGEyMjcwM2VlYzUzNDM3MWJjNmIwMDhhMTA0MTU3ZDg4ZjMxIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:53:29 GMT; Max-Age=7200; path=/; httponly; samesite=lax

{"erro":"Produto 99 n\u00e3o encontrado"}
---
HTTP/1.1 404 Not Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
Date: Thu, 26 Nov 2026 01:53:29 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: XSRF-TOKEN=eyJpdiI6InBJanlyNG9lbVg1NGVtdzhaUmZiZXc9PSIsInZhbHVlIjoiOHpTclZsbTlOQkhjVTRVSnAySmI3VUNvaGdPRER1NGVQbTRScFpZTWE5TStkTG9LbUpXTldrV2ZNRmN4d0xhblo1WGhpdXJzZlAwRi9waUNJc1U3bEM5OHowV3R6OXQ2U1VPU1QwUnNiUGNHeEhYZ0hzYmFjY2FIREFKK205QmQiLCJtYWMiOiJjZWYyMjExNzUyMTNlZmFiMWRmMmI2NGEwZWM2NGY0MWMwODY3YzI1MjViNjRmMjU0NTc5YWQxYjJiODc3MmQwIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:53:29 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: laravel-session=eyJpdiI6Ino0TDAxL2ViK2dCd3ZxN2djWUFIZ2c9PSIsInZhbHVlIjoieFhZV3ptaEo0RGpNQ01qR29ZaHBWd3Fqd09RQU8raUtoVjkvQitNSXRZWmpzVGxDbHhGM2dVWlFKM2lRV1N0VEFNS2paamJVZGdrMTFyOUdtYVpIU2YxWjhyRVRmUnRsUW1iclB2cktGU0lrNmhRVWlzWk9yZC9nOGJkYXNhbk4iLCJtYWMiOiIxNmQ2NGVkYTY0NTQ4MjZhNWQ3NjBmMzYwOGYzZDJkOWI3ZGZjNDg4ODhkYjkwM2UzNzdlNjQyNjUyOTQ0NDlmIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:53:29 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página não encontrada | Feira Digital</title>
</head>
<body>
    <nav>
    <a href="http://127.0.0.1:8000/boas-vindas">Início</a> |
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
</html>
```

### Caminho da requisição
GET /produtos/2/json -> rota (web.php) -> ProdutoController@showJson -> JSON 200

### Respostas
a) No 404 de `/produtos/99/json`, o `Content-Type` é `application/json` e o corpo é `{"erro":"Produto 99 não encontrado"}`. Já no 404 de `/produtos/abc/json` (barrado por `whereNumber('id')` e atendido pelo `Route::fallback`), o `Content-Type` é `text/html; charset=UTF-8` e o corpo é uma página HTML (`nao-encontrada.blade.php`).
b) Porque clientes que consomem rotas JSON (como front-ends JavaScript ou aplicativos) esperam receber dados estruturados em JSON para fazer o *parse* da resposta. Se a API retornar uma página HTML de erro (`abort(404)`), o cliente falhará ao tentar interpretar HTML como JSON.
c) O caminho é `GET /produtos/2/json -> rota (web.php) -> ProdutoController@showJson -> JSON 200`. A **View** ficou de fora porque não há renderização de página HTML: o controller converte o array PHP diretamente em JSON via `response()->json(...)` e o envia na resposta HTTP.

## A10: Inscrição de produtores

### Saídas
<!-- mensagens de erro dos testes (a) e (b), mensagem de sucesso do teste (c), curl.exe -i do teste (d) -->
```
--- Teste (a) - Enviar formulário vazio ---

    The nome field is required.

    The email field is required.

    The produto field is required.

    The quantidade field is required.

--- Teste (b) - Quantidade 0 e telefone 123 ---

    The quantidade field must be at least 1.

    The telefone field must be 11 digits.

--- Teste (c) - Envio válido ---
Inscrição recebida: Dan Mendes vai trazer 10 de Queijo coalho.

--- Teste (d) - curl -i -X POST http://127.0.0.1:8000/inscricao ---
HTTP/1.1 419 unknown status
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.5.13
Cache-Control: no-cache, private
date: Thu, 26 Nov 2026 01:54:34 GMT
Content-Type: text/html; charset=utf-8
Set-Cookie: laravel-session=eyJpdiI6ImoxMkw1djdkMTR1UUpuS3UvSko0ZGc9PSIsInZhbHVlIjoibnQ4Z3NZVlBpUm1rSDdWZk9rSG9sY004UVBibXpUVXhOVmUwNHhuZGYzdDlMQVR0NktSU1ltM2JsUUQ5UGEwUGpHNUdCTkd1YVF5akhGTUJxeUFGYnRJWU9vS3RYS2x1TWM2bEc3NnhVQXdMRnJFQlRMOEpHT3ozdkM2SGU3akYiLCJtYWMiOiJmMDdjYTUxNWVhNGJiNjE2ZDcxNTkyNDBkNzhmZGQ0ZTU2ZGJiMGY1OTMzN2I4NDk1NmZkNDlhYWJmNjlmMjljIiwidGFnIjoiIn0%3D; expires=Thu, 26 Nov 2026 03:54:34 GMT; Max-Age=7200; path=/; httponly; samesite=lax
```

### Caminho da requisição
POST /inscricao -> rota (web.php) -> InscricaoController@store -> redirect 302 -> GET /inscricao -> view inscricao -> HTML 200

### Respostas
a) Sim, os dados válidos que o usuário já havia digitado (como nome, e-mail e produto no teste b) permaneceram nos campos. A função diretiva responsável por isso é a `old('nome_do_campo')` nos atributos `value="{{ old(...) }}"` do formulário, que recupera os valores antigos guardados na sessão *flash* após falha na validação.
b) No código-fonte (`Ctrl+U`), o `@csrf` gera `<input type="hidden" name="_token" value="...">`. O `curl.exe -X POST` recebe status **`419 Page Expired`** mesmo com `@csrf` na view porque o `curl` envia uma requisição `POST` isolada sem cookie de sessão válido e sem o campo `_token` no corpo da requisição, fazendo o middleware de proteção CSRF do Laravel bloquear o envio.
c) Fluxo completo do teste (c) — **2 requisições HTTP**:
   1. Clique em **Enviar** -> `1ª Requisição: POST /inscricao` (com dados e `_token`) -> rota (`web.php`) -> `InscricaoController@store` -> `$request->validate()` (sucesso) -> grava mensagem na sessão *flash* (`->with('sucesso', ...)`) -> Resposta `302 Found` (`Location: /inscricao`).
   2. Navegador segue redirecionamento -> `2ª Requisição: GET /inscricao` -> rota (`web.php`) -> `InscricaoController@create` -> `view inscricao` (exibe `session('sucesso')`) -> Resposta `HTML 200 OK`.
d) O `store()` redireciona (padrão *Post/Redirect/Get*) para evitar o reenvio duplicado dos dados. Se ele retornasse a view diretamente na resposta do `POST`, apertar **`F5` (Atualizar)** faria o navegador reenviar a última requisição (`POST /inscricao`), executando `store()` novamente e duplicando a inscrição.
