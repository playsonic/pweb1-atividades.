# Questão 01: O primeiro script e o log do servidor

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `ola.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 O arquivo mistura HTML e PHP. Indique quais linhas são HTML e quais são PHP.**

As linhas em HTML, as estrutura básica da página é composta por HTML puro, englobando as tags: `<html lang="pt-BR"> <head> <meta charset="UTF-8"> <title>Questão 01</title> </head> <body> <h1>Olá, turma!</h1>` As duas linhas a seguir contêm blocos de código PHP embutidos no HTML `<p><?php echo "Este texto foi escrito pelo PHP."; ?></p>
<p>Hora no servidor: <?= date('H:i:s') ?></p>`, A presença das tags <?php echo ... ?> e sua abreviação <?= ... ?> indica que o conteúdo dentro delas será processado pelo interpretador PHP.

**1.2 Qual a diferença entre `<?php echo ... ?>` e `<?= ... ?>`?**

Em termos de funcionamento, não há diferença. A tag <?= ... ?> é apenas uma forma abreviada (short open tag) de escrever <?php echo ... ?>. Ela é utilizada para tornar o código mais conciso quando o único objetivo do bloco PHP é imprimir um valor na tela.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor (as linhas que apareceram no terminal do `php -S` ao abrir a página no navegador)**

```
[Wed Oct  7 15:27:16 2026] PHP 8.5.10 Development Server (http://localhost:8000) started
[Wed Oct  7 15:27:21 2026] [::1]:53236 Accepted
[Wed Oct  7 15:27:21 2026] [::1]:53236 Closing
```

**Explicação linha por linha:**

[Wed Oct  7 15:27:16 2026] PHP 8.5.10 Development Server (http://localhost:8000) started -> Indica que o servidor embutido de desenvolvimento do PHP foi iniciado com sucesso no endereço e porta especificados (localhost:8000).
[Wed Oct  7 15:27:21 2026] [::1]:53236 Accepted -> Indica que uma conexão foi aceita; ou seja, o servidor recebeu uma requisição HTTP de um cliente (o navegador).
[Wed Oct  7 15:27:21 2026] [::1]:53236 Closing -> Indica que o servidor processou a requisição, enviou a resposta de volta ao cliente e encerrou aquela conexão. 

**2.2 Saída de `curl.exe -i http://localhost:8000/q01-primeiro-script/ola.php`**

```HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 18:30:50 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Questão 01</title>
</head>
<body>
<h1>Olá, turma!</h1>
<p>Este texto foi escrito pelo PHP.</p>
<p>Hora no servidor: 18:30:50</p>
</body>
</html>
```

**Explicação linha por linha:**

HTTP/1.1 200 OK -> Mostra a versão do protocolo HTTP utilizada e o código de status HTTP 200, que significa que a requisição foi bem-sucedida.
Host: localhost:8000 -> Indica o endereço e a porta do servidor onde a aplicação está hospedada.
Date: Wed, 07 Oct 2026 18:30:50 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> Informa que a conexão de rede será fechada após a conclusão desta resposta.
X-Powered-By: PHP/8.5.10 -> Informa qual tecnologia (e sua respectiva versão) foi utilizada no servidor para processar a página.
Content-type: text/html; charset=UTF-8 -> Diz ao navegador qual é o tipo de arquivo que ele está recebendo (um documento HTML) e a sua codificação de caracteres (UTF-8).

```
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Questão 01</title>
</head>
<body>
<h1>Olá, turma!</h1>
<p>Este texto foi escrito pelo PHP.</p>
<p>Hora no servidor: 18:30:50</p>
</body>
</html>
``` -> É o código final que o navegador recebe para renderizar a página. Vale ressaltar que o código PHP original já foi processado e substituído pelo seu resultado em texto puro, de modo que nenhuma tag PHP chega ao navegador. 

## 3. Perguntas

**3.1 Aperte F5 três vezes. O que muda na página e no log? Por quê?**

Toda vez que a página é atualizada, a hora exibida na tela muda, no caso os segundos tenham passado, pois a função date('H:i:s') é executada novamente pelo servidor a cada requisição. Além disso, no log do terminal, surgem novos pares de linhas Accepted e Closing, representando as novas conexões sendo abertas e fechadas entre o navegador e o servidor.

**3.2 No "Exibir código-fonte" (Ctrl+U), aparece alguma linha de PHP? Explique.**

Não. Nenhuma linha de código PHP é exibida. O PHP é uma linguagem server-side. O servidor lê o código, executa as instruções PHP, gera um texto de saída e envia para o navegador apenas o HTML resultante. O navegador sequer tem conhecimento de que o PHP foi utilizado.

**3.3 Na saída do curl, o que indicam a primeira linha, o cabeçalho `Content-type` e o cabeçalho `X-Powered-By`?**

Primeira linha (HTTP/1.1 200 OK): Indica a versão do protocolo e informa que a comunicação com o servidor foi bem-sucedida.

Content-type: Diz ao navegador qual formato de dado está sendo entregue, o texto HTML, para que ele saiba como exibi-lo corretamente.

X-Powered-By: Revela os bastidores, informando a tecnologia específica e a versão que o servidor utilizou para processar aquela resposta, no caso, PHP 8.5.10.