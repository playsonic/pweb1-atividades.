# Questão 03: Variáveis, aspas e concatenação

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aspas.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 **Antes de executar**, preencha a coluna "Minha previsão" com o que cada linha vai mostrar.

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"Aluna: " . $nome` | | |
| `"Aluna: $nome"` | | |
| `'Aluna: $nome'` | | |
| `"Cursa o {$semestre}º semestre de $curso"` | | |
| `$nome . $curso` | | |
| `<?= $nome ?>` | | |**

| `"Aluna: " . $nome` | | | -> Aluna: Maria
| `"Aluna: $nome"` | | | -> Aluna: Maria
| `'Aluna: $nome'` | | | -> Aluna: $nome
| `"Cursa o {$semestre}º semestre de $curso"` | | | -> Cursa o 2º e semestre de ADS
| `$nome . $curso` | | | ->  MariaADS
| `<?= $nome ?>` | | |** -> Maria

**1.2 Para que servem as chaves `{}` em `{$semestre}`?**

ele permite que uma variavel tenha outros elementos ao lado dela, no caso do "semestre" é o "º".

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q03-variaveis-aspas/aspas.php`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Sun, 11 Oct 2026 20:30:20 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

<p>Aluna: Maria</p>
<p>Aluna: Maria</p>
<p>Aluna: $nome</p>
<p>Cursa o 2º semestre de ADS</p>
<p>MariaADS</p>
<p>Atalho: Maria</p>
```

**Explicação linha por linha:**

HTTP/1.1 200 OK -> A conexão com servidor foi sucessidada
Host: localhost:8000 -> Esse é quem é a porta que está hospendado
Date: Sun, 11 Oct 2026 20:30:20 GMT -> A data que aconteceu
Connection: close -> A conexão está fechada
X-Powered-By: PHP/8.5.10 -> De qual forma o servidor está sendo executado
Content-type: text/html; charset=UTF-8 -> > O conteudo da página que o navegador ler

<p>Aluna: Maria</p> -> Aparce "Maria" já que a variavel está fora da virgula e o PHP pode executar
<p>Aluna: Maria</p> -> Com aspas dubla o PHP pode executar a varivel na string
<p>Aluna: $nome</p> -> no código essa parte possui aspas simples e isso faz com que exiba estritamente o que foi escrito
<p>Cursa o 2º semestre de ADS</p> -> é exibido a variavel semestre com elemento do lado já que no código ele possui `{}` e o curso aparce ADS
<p>MariaADS</p> -> nessa linha o código apenas o PHP das variaveis curso e nome é executo isso faz com que apenas esse elementos apareceram
<p>Atalho: Maria</p> -> O atalho é o nome "Maria" já que o código está executando variavel dela 

## 3. Perguntas

**3.1 Em quais linhas sua previsão errou? Explique o motivo.**

Todas as minhas previsões estavam corretas, apenas na ultima faltou o "Atalho:"

**3.2 Por que `$nome . $curso` aparece sem espaço entre as palavras? Como corrigir?**

Pois é PHP puro, o html não consegue ler toltamente, aí ele tenta transformar isso para exebir em HTML mas isso acaba fazendo os elementos serem apenas exibidos de uma forma bruta seria apenas corrigindo botando um HTML como uma string aspas dupla; assim: <?php echo "$nome $curso"; ?>