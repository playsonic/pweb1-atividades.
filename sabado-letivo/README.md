# Sábado letivo (28/11/2026): do PHP ao Laravel com apoio de LLM

**Aluno(a):** _(seu nome)_
**Tema:** _(número e nome do tema, ex.: 01 - Feira Digital do Sertão)_
**Problema que o sistema resolve:** _(uma frase)_
**Versão do Laravel:** _(saída de `php artisan --version`)_

## Como rodar

```powershell
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Classes do domínio (R02)

Pasta: `app/Domain/_(Pasta)_`

| Classe | Mãe ou filha | O que o método polimórfico faz nela |
|---|---|---|
| _(Produto)_ | mãe (abstrata) | _(declara `calcularPreco`)_ |
| | filha | |
| | filha | |

## Rotas (R10)

| Verbo | Endereço | Nome | Quem atende |
|---|---|---|---|
| GET | / | inicio | closure + view inicio |
| | | | |
