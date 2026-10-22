# Questão 09: Método HTTP e código de status

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `api.php` | Criado por você, conforme o enunciado |

## 1. Análise do código

**1.1 Cole o código do `api.php` e explique cada parte: a verificação do método, o status, os cabeçalhos e o JSON.**

```
<?php
header('Content-Type: application/json; charset=utf-8'); -> Define o cabeçalho informando ao cliente que a resposta será no formato JSON (com suporte a acentuação UTF-8).

$metodo = $_SERVER['REQUEST_METHOD']; -> Captura qual método HTTP (GET, POST, PUT, etc.) foi utilizado na requisição e o armazena na variável $metodo.

if ($metodo !== 'POST') { -> Verifica se o método utilizado é diferente de POST. Se for diferente, executa o bloco de erro.
    http_response_code(405); -> Define o código de status HTTP da resposta como 405 (Method Not Allowed), indicando que o método usado pelo cliente não é permitido para esta rota.
    header('Allow: POST'); -> Envia um cabeçalho extra informando ao cliente que, para este endereço, o único método permitido é o POST.
    echo json_encode(["erro"], JSON_UNESCAPED_UNICODE); -> Converte o array PHP em uma string JSON e a imprime na tela. No bloco if, envia o erro; no final do arquivo, envia a mensagem de sucesso.
    exit; -> Interrompe a execução do script imediatamente, garantindo que o resto do código não seja executado caso o método seja inválido. 
}

http_response_code(200); -> Se o método for POST, define o status HTTP como 200, indicando sucesso.
echo json_encode(["ok"], JSON_UNESCAPED_UNICODE); -> JSON de sucesso
```

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q09-somente-post/api.php`**

```
HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Tue, 13 Oct 2026 03:19:12 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-Type: application/json; charset=utf-8
Allow: POST

["erro"]
```

**Explicação linha por linha:**

```
HTTP/1.1 405 Method Not Allowed -> O servidor recusa a requisição porque o comando Curl, por padrão, faz uma requisição GET, e nossa API só aceita POST.
Host: localhost:8000 -> Indica o servidor e a porta onde a aplicação está rodando.
Date: Tue, 13 Oct 2026 03:19:12 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> Informa que a conexão de rede será encerrada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia e a versão utilizadas no backend do servidor.
Content-Type: application/json; charset=utf-8 -> O servidor está dizendo explicitamente ao navegador ou cliente que o conteúdo do corpo da resposta é um dado no formato JSON puro.
Allow: POST -> é permetido allow

["erro"] -> O corpo da resposta em formato JSON, contendo a mensagem de erro que geramos no script.
```

**2.2 Saída de `curl.exe -i -X POST http://localhost:8000/q09-somente-post/api.php`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Tue, 13 Oct 2026 03:25:31 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-Type: application/json; charset=utf-8

["ok"]
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A conexão foi bem-sucedida
Host: localhost:8000 -> Indica o servidor e a porta onde a aplicação está rodando.
Date: Tue, 13 Oct 2026 03:25:31 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> Informa que a conexão de rede será encerrada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia e a versão utilizadas no backend do servidor.
Content-Type: application/json; charset=utf-8 -> O servidor está dizendo explicitamente ao navegador ou cliente que o conteúdo do corpo da resposta é um dado no formato JSON puro.

["ok"] -> O corpo da resposta em JSON validando que a requisição POST foi processada com sucesso.
```

**2.3 Saída de `curl.exe -i -X PUT http://localhost:8000/q09-somente-post/api.php`**

```
HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Tue, 13 Oct 2026 03:27:53 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-Type: application/json; charset=utf-8
Allow: POST

["erro"]
```

**Explicação linha por linha:**

```
HTTP/1.1 405 Method Not Allowed -> Tentamos forçar uma requisição usando o método PUT (com -X PUT). Como o script recusa qualquer coisa que não seja POST, ele retorna o erro 405 novamente.
Host: localhost:8000 -> Indica o servidor e a porta onde a aplicação está rodando.
Date: Tue, 13 Oct 2026 03:19:12 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> Informa que a conexão de rede será encerrada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia e a versão utilizadas no backend do servidor.
Content-Type: application/json; charset=utf-8 -> O servidor está dizendo explicitamente ao navegador ou cliente que o conteúdo do corpo da resposta é um dado no formato JSON puro.
Allow: POST -> é permetido allow

["erro"] -> O corpo da resposta em formato JSON, contendo a mensagem de erro que geramos no script.
```

**2.4 Log do servidor das três requisições**

```
[Tue Oct 13 00:19:12 2026] [::1]:37472 Accepted
[Tue Oct 13 00:19:12 2026] [::1]:37472 Closing
[Tue Oct 13 00:25:31 2026] [::1]:52700 Accepted
[Tue Oct 13 00:25:31 2026] [::1]:52700 Closing
[Tue Oct 13 00:27:53 2026] [::1]:60290 Accepted
[Tue Oct 13 00:27:53 2026] [::1]:60290 Closing
```

**Explicação linha por linha:**

```
[Tue Oct 13 00:19:12 2026] [::1]:37472 Accepted -> Representa a abertura da primeira requisição, a requisição GET padrão.
[Tue Oct 13 00:19:12 2026] [::1]:37472 Closing -> Representa o fechamento da primeira requisição, a requisição GET padrão.
[Tue Oct 13 00:25:31 2026] [::1]:52700 Accepted -> Representa a abertura da segunda requisição, a requisição GET padrão.
[Tue Oct 13 00:25:31 2026] [::1]:52700 Closing -> Representa o fechamento da segunda requisição, a requisição GET padrão.
[Tue Oct 13 00:27:53 2026] [::1]:60290 Accepted -> Representa a abertura da terceira requisição, a requisição GET padrão.
[Tue Oct 13 00:27:53 2026] [::1]:60290 Closing -> Representa o fechamento da terceira requisição, a requisição GET padrão.
```

## 3. Perguntas

**3.1 Que método o navegador usa ao abrir o endereço? Qual status ele recebe?**

Ao digitar um endereço na barra do navegador e apertar Enter (ou ao usar o comando curl sem especificar o método), o método utilizado por padrão é o GET. Por isso, ele recebe o status HTTP 405 (Method Not Allowed).

**3.2 Para que serve o cabeçalho `Allow`?**

Serve para informar ao cliente quais são os métodos HTTP que aquele endereço específico aceita. Quando o cliente recebe um erro 405, ele pode ler o cabeçalho Allow para saber exatamente o que precisa corrigir na sua requisição.

**3.3 No log, onde aparecem o método e o status de cada requisição?**

Eles deveriam aparecer em uma linha intermediária entre o Accepted e o Closing, no formato [200]: GET /api.php. Mas no meu não apareceu.