# Questão 06: Strings e acentuação

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `palavra.php` | Código fornecido, que você vai completar no item 1.2 |

> Se aparecer `Call to undefined function mb_strlen()`, ative a linha `extension=mbstring` no seu `php.ini` e reinicie o servidor. Registre isso na resposta 3.3.

## 1. Análise do código

**1.1 Explique o código original linha por linha.**

```
$palavra = $_GET['palavra'] ?? "Ceara"; -> Obtém a palavra passada no parâmetro da URL; caso a URL não envie nada, usa a palavra "Ceara" como padrão.

echo "<p>Palavra: $palavra</p>"; -> Mostra a palavra escolhida na tela dentro de um parágrafo HTML.
echo "<p>strlen: " . strlen($palavra) . "</p>" -> Mostra a quantidade de bytes (e não bits) ocupados pela palavra na memória.
```

**1.2 Complete o código para mostrar também: `mb_strlen`, `strtoupper`, `mb_strtoupper` e uma classificação com `if`: "palavra curta" (até 5 letras) ou "palavra longa". Use `mb_strlen` na classificação. Cole o código e explique.**

```
<?php
$palavra = $_GET['palavra'] ?? "Ceara";
$tamanhopalavra = mb_strlen($palavra);

echo "<p>Palavra: $palavra</p>"; 
echo "<p>strlen: " . strlen($palavra) . "</p>"; 
echo "<p>mb_strlen: $tamanhopalavra </p>"; 
echo "<p>strtoupper: ". strtoupper($palavra) . "</p>";
echo "<p>mb_strtoupper: " . mb_strtoupper($palavra) . "</p>";

if ($tamanhopalavra <= 5) {
$tamanho = "palavra curta";
} else {
$tamanho = "palavra longa";
}


echo "<p>É uma $tamanho</p>"?>
```

```
<?php
$palavra = $_GET['palavra'] ?? "Ceara";
$tamanhopalavra = mb_strlen($palavra); -> Conta e armazena a quantidade real de caracteres da palavra, considerando acentuações (multibyte).

echo "<p>Palavra: $palavra</p>"; -
echo "<p>strlen: " . strlen($palavra) . "</p>";  
echo "<p>mb_strlen: $tamanhopalavra </p>"; -> Exibe a quantidade real de caracteres.
echo "<p>strtoupper: ". strtoupper($palavra) . "</p>"; -> Converte a palavra para maiúsculas (caixa alta), mas não consegue converter caracteres acentuados.
echo "<p>mb_strtoupper: " . mb_strtoupper($palavra) . "</p>"; -> Converte a palavra para maiúsculas corretamente, incluindo os caracteres com acento.

if ($tamanhopalavra <= 5) { -> Verifica o tamanho da palavra, faz a comparação e define na variável $tamanho se é uma "palavra curta" ou "palavra longa".
$tamanho = "palavra curta";
} else {
$tamanho = "palavra longa";
}

echo "<p>É uma $tamanho</p>"?> -> Exibe o resultado da classificação na tela.
```

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q06-strings/palavra.php?palavra=Ceara"`**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 04:18:53 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

<p>Palavra: Ceara</p>
<p>strlen: 5</p>
<p>mb_strlen: 5 </p>
<p>strtoupper: CEARA</p>
<p>mb_strtoupper: CEARA</p>
<p>É uma palavra curta</p>
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A requisição foi bem-sucedida.
Host: localhost:8000 -> Indica o servidor e a porta acessados.
Date: Mon, 12 Oct 2026 04:18:53 GMT -> A data e hora em que o servidor gerou a resposta.
Connection: close -> A conexão será fechada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia que processou o servidor (PHP).
Content-type: text/html; charset=UTF-8 -> O tipo de conteúdo retornado ao navegador (HTML com codificação UTF-8).

<p>Palavra: Ceara</p> -> Mostra a palavra "Ceara" sem acento.
<p>strlen: 5</p> -> A quantidade de bytes contados é 5.
<p>mb_strlen: 5 </p> -> A quantidade real de caracteres contados é 5.
<p>strtoupper: CEARA</p> -> A palavra convertida para letras maiúsculas.
<p>mb_strtoupper: CEARA</p> -> A palavra convertida para maiúsculas (neste caso, o resultado é igual ao de cima pois não há acentos).
<p>É uma palavra curta</p> -> O resultado da verificação do if/else, confirmando que a palavra tem até 5 caracteres.
```

**2.2 Abra no navegador `palavra.php?palavra=Ceará` e cole a linha do log do servidor**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 04:29:55 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

<p>Palavra: Ceará</p>
<p>strlen: 6</p>
<p>mb_strlen: 5 </p>
<p>strtoupper: CEARá</p>
<p>mb_strtoupper: CEARÁ</p>
<p>É uma palavra curta</p>
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A requisição foi bem-sucedida.
Host: localhost:8000 -> Indica o servidor e a porta acessados.
Date: Mon, 12 Oct 2026 04:29:55 GMT -> A data e hora em que o servidor gerou a resposta.
Connection: close -> A conexão será fechada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia que processou o servidor (PHP).
Content-type: text/html; charset=UTF-8 -> O tipo de conteúdo retornado ao navegador (HTML com codificação UTF-8).

<p>Palavra: Ceará</p> -> Mostra a palavra "Ceará" com acento.
<p>strlen: 6</p> -> A quantidade de bytes agora é 6, pois o caractere acentuado "á" ocupa 2 bytes no formato UTF-8.
<p>mb_strlen: 5 </p> -> aA quantidade de caracteres continua sendo 5, pois a função multibyte entende a acentuação.
<p>strtoupper: CEARá</p>-> Coloca as letras em maiúsculas, mas falha no "á", pois não reconhece caracteres especiais.
<p>mb_strtoupper: CEARÁ</p> -> Converte todas as letras corretamente, inclusive o caractere especial ("Á").
<p>É uma palavra curta</p> -> Como mb_strlen retornou 5, o sistema classifica corretamente a palavra como curta.
```

## 3. Perguntas

**3.1 Compare o `strlen` de "Ceara" e de "Ceará". Por que o acento muda o resultado?**

A função strlen conta o número de bytes de uma string, e não o número de caracteres visuais. Na codificação UTF-8, letras normais do alfabeto sem acento ocupam 1 byte, mas caracteres acentuados (como o "á") ocupam 2 bytes. Por isso, "Ceara" retorna 5, enquanto "Ceará" retorna 6 bytes, embora ambas tenham apenas 5 letras.

**3.2 No log, a palavra aparece como `Cear%C3%A1`. O que é isso? Por que o navegador transformou o "á"?**

Isso é chamado de URL Encoding (codificação de URL). A estrutura de uma URL aceita apenas um conjunto limitado de caracteres baseados no padrão ASCII (letras sem acentos, números e alguns símbolos). Quando digitamos um caractere especial como "á", o navegador automaticamente o codifica no formato hexadecimal (neste caso, %C3%A1) para que o servidor consiga recebê-lo de forma segura e sem quebrar a requisição.

**3.3 Qual a diferença entre `strtoupper` e `mb_strtoupper` com a palavra "Ceará"?**

A função strtoupper foi desenhada para o padrão ASCII antigo, então ela só consegue converter caracteres de 1 byte. Por isso, ela ignora o "á" e retorna "CEARá". Já a função mb_strtoupper possui suporte a multibyte (como o padrão UTF-8), o que permite que ela reconheça e converta caracteres acentuados corretamente, resultando em "CEARÁ".
