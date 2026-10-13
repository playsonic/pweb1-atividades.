# Questão 08: O que o navegador entende? (Content-Type)

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `dados.php` | Código fornecido. No item 2.2 você vai descomentar a linha do header |
| `prints/devtools-html.png` | DevTools com o Content-Type antes de descomentar |
| `prints/devtools-json.png` | DevTools com o Content-Type depois de descomentar |

## 1. Análise do código

**1.1 Explique o que fazem `json_encode`, `JSON_PRETTY_PRINT` e `JSON_UNESCAPED_UNICODE`.**

json_encode: Transforma estruturas de dados do PHP (como arrays ou objetos) em uma string no formato JSON, que é um formato de texto universal para troca de dados.

JSON_PRETTY_PRINT: Formata a string JSON com quebras de linha e recuos (indentação), facilitando muito a leitura humana.

JSON_UNESCAPED_UNICODE: Impede que caracteres acentuados ou especiais (como "ç" e "ã") sejam transformados em códigos de escape Unicode (como \u00e7). Ele garante que os acentos sejam mantidos na sua forma original no JSON final.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q08-content-type/dados.php` com o header **comentado****

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Tue, 13 Oct 2026 02:18:55 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}             
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A conexão foi bem-sucedida
Host: localhost:8000 -> Indica o servidor e a porta onde a aplicação está rodando.
Date: Tue, 13 Oct 2026 02:18:55 GMT -> aA data e hora exatas em que o servidor gerou a resposta.
Connection: close -> Informa que a conexão de rede será encerrada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia e a versão utilizadas no backend do servidor.
Content-type: text/html; charset=UTF-8 -> Diz ao navegador que o conteúdo enviado é uma página HTML (apesar de o corpo ser, na verdade, um JSON). Este é o comportamento padrão do PHP quando não especificamos o header.

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
} -> A string contendo os dados do array que foram convertidos para o formato JSON pelo json_encode.    
```

**2.2 Saída do mesmo comando com o header **descomentado****

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Tue, 13 Oct 2026 02:27:38 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-Type: application/json; charset=utf-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A conexão foi bem-sucedida
Host: localhost:8000 -> Indica o servidor e a porta onde a aplicação está rodando.
Date: Tue, 13 Oct 2026 02:27:38 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> Informa que a conexão de rede será encerrada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia e a versão utilizadas no backend do servidor.
Content-Type: application/json; charset=utf-8 -> Agora, o servidor está dizendo explicitamente ao navegador ou cliente que o conteúdo do corpo da resposta é um dado no formato JSON puro, e não uma página HTML.

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
} -> O texto contendo os dados estruturados em JSON.
```

## 3. Perguntas

**3.1 Compare o cabeçalho `Content-Type` nas duas saídas. O que mudou?**

O cabeçalho mudou de Content-type: text/html; charset=UTF-8 (que é o padrão do PHP e diz ao navegador para interpretar o texto como uma página web) para Content-Type: application/json; charset=utf-8 que instrui corretamente o navegador de que se trata de uma estrutura de dados JSON.

**3.2 O corpo da resposta mudou? O que isso mostra sobre quem decide como o conteúdo é interpretado?**

Não, o corpo da resposta continuou exatamente o mesmo. Isso mostra que quem decide como o conteúdo será interpretado se vai renderizar como uma página visual no navegador ou se vai ser lido como dados brutos em um sistema é o cabeçalho HTTP Content-Type enviado pelo servidor, e não o texto contido no corpo da resposta.

**3.3 Retire o `JSON_UNESCAPED_UNICODE`, rode o curl de novo e explique o que aconteceu com "Programação".**

Sem o JSON_UNESCAPED_UNICODE, a palavra "Programação" perdeu seus acentos visíveis e foi transformada no formato "Programa\u00e7\u00e3o Web I". Isso acontece porque a função json_encode do PHP, por padrão, pega caracteres multibyte (como o "ç" e o "ã") e os converte em sequências de escape Unicode (representadas por \uXXXX) para garantir que o texto não quebre em sistemas mais antigos que não suportam a codificação UTF-8 nativamente.
