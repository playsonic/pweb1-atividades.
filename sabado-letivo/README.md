# Sábado letivo (28/11/2026): do PHP ao Laravel com apoio de LLM

**Aluno(a):** Dan Mendes
**Tema:** 01 Feira Digital do Sertão
**Problema que o sistema resolve:** Centraliza e automatiza o cadastro, a consulta, a filtragem por categoria e o cálculo dinâmico de preços de produtos vendidos por peso ou por unidade em uma feira, substituindo o controle manual sujeito a erros._
**Versão do Laravel:** 13.44.1

## Como rodar

```powershell
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Classes do domínio (R02)

Pasta: `app/Domain/Feira`

| Classe | Mãe ou filha | O que o método polimórfico faz nela |
| --- | --- | --- |
| `Produto` | mãe (abstrata) | declara `calcularPreco` (e `tipo`) |
| `ProdutoPorPeso` | filha | multiplica o preço por kg pela quantidade informada (`$preco * $quantidade`), aceitando valores fracionados maiores que zero |
| `ProdutoUnitario` | filha | exige que a quantidade seja um número inteiro maior que zero (lança `InvalidArgumentException` se for decimal) e multiplica pelo preço unitário |

## Rotas (R10)

| Verbo | Endereço | Nome | Quem atende |
| --- | --- | --- | --- |
| GET | / | inicio | closure + view inicio |
| GET | /simular/{quantidade} | — | closure + domínio `ProdutoPorPeso` |
| GET | /produtos | produtos.index | `ProdutoController@index` |
| GET | /produtos/criar | produtos.create | `ProdutoController@create` |
| POST | /produtos | produtos.store | `ProdutoController@store` |
| GET | /produtos/json | produtos.json | `ProdutoController@json` |
| GET | /produtos/{id} | produtos.show | `ProdutoController@show` |
| GET | /produtos/{id}/json | produtos.showJson | `ProdutoController@showJson` |
| GET | /categorias/{categoria} | produtos.categoria | `ProdutoController@categoria` |
| GET | /cardapio | cardapio | closure / controller + view cardapio |
| GET | /sobre | sobre | closure / controller + view sobre |
| GET | /contato | contato | closure / controller + view contato |
| GET | /inscricao | inscricao.create | closure / controller + view inscricao |
| ANY | /{fallbackPlaceholder} | — | `Route::fallback` + view `nao-encontrada` (404) |