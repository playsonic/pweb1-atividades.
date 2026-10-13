# Questão 02: Lendo mensagens de erro

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erro.php` | Código fornecido com um erro proposital (corrija no item 3.3) |

## 1. Análise do código

**1.1 Antes de executar: qual é o erro do código? Em que linha ele está?**

O erro do código é a falta de um ponto e vírgula (;) no final da instrução na linha 2. A ausência desse caractere entra em conflito com o comando echo da linha seguinte, gerando um erro de sintaxe.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor ao abrir a página com `display_errors=1`**

```
HTTP/1.1 200 OK
[Wed Oct  7 16:02:45 2026] [::1]:38308 Accepted
[Wed Oct  7 16:02:45 2026] PHP Parse error:  syntax error, unexpected token "echo" in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades./aula02-php-http/q02-erros/erro.php on line 3
[Wed Oct  7 16:02:45 2026] [::1]:38308 Closing
```
A página exibe a seguinta mensagem `Parse error: syntax error, unexpected token "echo" in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades./aula02-php-http/q02-erros/erro.php on line 3`

**Explicação linha por linha:**

HTTP/1.1 200 OK A conexão com o servidor foi bem-sucedida e ele retornou uma página (mesmo que o conteúdo da página seja apenas a mensagem de erro sendo exibida na tela).
[Wed Oct  7 16:02:45 2026] [::1]:38308 Accepted -> A conexão foi estabelecida entre o cliente e o servidor.
[Wed Oct  7 16:02:45 2026] PHP Parse error:  syntax error, unexpected token "echo" in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades./aula02-php-http/q02-erros/erro.php on line 3 -> É a linha que descreve o erro e onde ele ocorreu. Neste caso, indica um erro de sintaxe apontando que o comando echo na linha 3 foi inesperado.
[Wed Oct  7 16:02:45 2026] [::1]:38308 Closing -> A conexão com o servidor foi encerrada após a resposta ser enviada.

**2.2 Log do servidor ao abrir a página com `display_errors=0`**

```
HTTP/1.0 500 Internal Server Error
[Wed Oct  7 16:01:02 2026] [::1]:57326 Accepted
[Wed Oct  7 16:01:02 2026] PHP Parse error:  syntax error, unexpected token "echo" in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades./aula02-php-http/q02-erros/erro.php on line 3
[Wed Oct  7 16:01:02 2026] [::1]:57326 Closing
```
A página não abre e não exibe nada.

**Explicação linha por linha:**

HTTP/1.0 500 Internal Server Error -> Houve um erro interno fatal no servidor durante a execução do script. Como os erros estão ocultos (display_errors=0), ele não envia uma página HTML com a falha, respondendo apenas com este status de erro crítico.
[Wed Oct  7 16:01:02 2026] [::1]:57326 Accepted -> A conexão inicial foi estabelecida com o servidor.
[Wed Oct  7 16:01:02 2026] PHP Parse error:  syntax error, unexpected token "echo" in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades./aula02-php-http/q02-erros/erro.php on line 3 -> O servidor registra no seu log interno qual foi o erro (erro de sintaxe na linha 3), mas, desta vez, não mostra isso para o usuário no navegador.
[Wed Oct  7 16:01:02 2026] [::1]:57326 Closing -> A conexão com o servidor foi encerrada.

## 3. Perguntas

**3.1 A mensagem diz que o erro está em qual linha? Por que não é a linha onde falta o `;`?**

A mensagem diz que o erro está na linha 3, apontando para o token "echo". Isso acontece porque o interpretador do PHP continua lendo o código após a linha 2, esperando encontrar o encerramento da instrução. Ele só percebe que há algo errado na sintaxe quando esbarra abruptamente no comando echo da linha 3, no momento em que ainda esperava finalizar a declaração da variável $curso. 

**3.2 Compare o status registrado no log nas duas execuções (`[200]` e `[500]`). Por que eles são diferentes? Qual dos dois é o correto do ponto de vista do HTTP?**

O status 200 OK ocorre quando display_errors=1 porque o servidor consegue montar e entregar uma página HTML (neste caso, uma página contendo o texto do erro). Para o protocolo HTTP, uma resposta foi gerada e enviada com sucesso. O status 500 Internal Server Error ocorre quando display_errors=0 porque o script falha miseravelmente e a exibição do erro está desligada. Assim, o servidor interrompe a execução e não gera conteúdo para o navegador. Do ponto de vista do protocolo HTTP, o status 500 é o correto. Se um script quebra e não consegue executar sua função primária, o servidor deve avisar o cliente/navegador de que houve uma falha interna, e não fingir que a requisição foi bem-sucedida (Status 200).

**3.3 Corrija o código, faça um commit e cole aqui o log da execução corrigida.**

<?php
$curso = "ADS";
echo "Bem-vindo ao curso de $curso";

