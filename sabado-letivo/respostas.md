# Respostas: sábado letivo (28/11/2026)

Nome: _(seu nome)_
Tema: _(número e nome)_

## R02: Classes do domínio

### Saída do tinker
```
(cole aqui a saída do terminal)
```

a) Saída colada acima.
b) Tabela de classes preenchida no README.md: _(sim/não)_
c) _(responda aqui)_

## R03: Rotas rápidas

### Saídas
```
(cole aqui o curl.exe -i de /status, /manutencao e /inicio)
```

a) Content-Type do /status: _(responda aqui)_ — Location do /inicio: _(responda aqui)_
b) _(responda aqui)_
c) _(responda aqui)_

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
