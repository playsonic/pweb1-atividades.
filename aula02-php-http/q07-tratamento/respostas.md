# Questão 07: O dado pode não vir, o dado pode ser perigoso

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `saudacao.php` | Código fornecido, que você vai corrigir no item 1.2 |

## 1. Análise do código

**1.1 Quais são os dois problemas deste código?**

O código não usa o operador ?? (coalescência nula), o que gera um aviso (Warning) no PHP caso o usuário acesse a página sem passar o parâmetro ?nome= na URL. Também o código não utiliza a função htmlspecialchars, imprimindo diretamente na tela o que vem da URL. Isso permite a injeção de códigos maliciosos, abrindo brecha para ataques XSS.

**1.2 Corrija o código usando `??` (valor padrão "Visitante") e `htmlspecialchars`. Faça um commit **antes** e outro **depois** da correção. Cole o código corrigido e explique.**

```
$nome = htmlspecialchars($_GET['nome'] ?? "Visitante");
echo "Olá, " . $nome;
```
O operador ?? "Visitante" verifica se a chave 'nome' existe na URL; se não existir, ele atribui a string "Visitante", evitando o erro de variável indefinida. Em seguida, a função htmlspecialchars() pega esse valor e converte qualquer caractere especial de HTML (como < e >) em entidades seguras de texto (como &lt; e &gt;), prevenindo que o navegador interprete o dado inserido como um código executável.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 **Antes da correção**: log do servidor ao abrir `saudacao.php` sem parâmetro**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 05:19:03
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

<br />
<b>Warning</b>:  Undefined array key "nome" in <b>/home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades./aula02-php-http/q07-tratamento/saudacao.php</b> on line <b>2</b><br />
Olá,
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A requisição foi bem-sucedida.
Host: localhost:8000 -> Indica o servidor e a porta acessados.
Date: Mon, 12 Oct 2026 05:19:03 GMT -> A data e hora em que o servidor gerou a resposta.
Connection: close -> A conexão será fechada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia que processou o servidor (PHP).
Content-type: text/html; charset=UTF-8 -> O tipo de conteúdo retornado ao navegador (HTML com codificação UTF-8).

<br />
<b>Warning</b>:  Undefined array key "nome" in <b>/pweb1-atividades./aula02-php-http/q07-tratamento/saudacao.php</b> on line <b>2</b><br /> -> São os cabeçalhos padrão da resposta HTTP. Indicam que a conexão foi bem-sucedida, informam dados do servidor, data, tipo de conteúdo (HTML) e encerram a conexão.
Olá, -> sendo executada. Como a variável estava vazia devido ao erro acima, ele imprimiu apenas a saudação sem nome nenhum.
```

**2.2 **Antes da correção**: saída de `curl.exe -s "http://localhost:8000/q07-tratamento/saudacao.php?nome=<b>Oi</b>"`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 05:21:03 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8


Olá, <b>Oi</b>
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A requisição foi bem-sucedida.
Host: localhost:8000 -> Indica o servidor e a porta acessados.
Date: Mon, 12 Oct 2026 05:21:03 GMT -> A data e hora em que o servidor gerou a resposta.
Connection: close -> A conexão será fechada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia que processou o servidor (PHP).
Content-type: text/html; charset=UTF-8 -> O tipo de conteúdo retornado ao navegador (HTML com codificação UTF-8).

Olá, <b>Oi</b> -> Como o código ainda não tem proteção, ele pegou a tag HTML
```

**2.3 **Depois da correção**: saída do mesmo comando do item 2.2**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 05:25:08 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

Olá, <b>Oi</b>
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A requisição foi bem-sucedida.
Host: localhost:8000 -> Indica o servidor e a porta acessados.
Date: Mon, 12 Oct 2026 05:25:08 GMT -> A data e hora em que o servidor gerou a resposta.
Connection: close -> A conexão será fechada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> A tecnologia que processou o servidor (PHP).
Content-type: text/html; charset=UTF-8 -> O tipo de conteúdo retornado ao navegador (HTML com codificação UTF-8).

Olá, <b>Oi</b> -> pegou os símbolos < e > e os transformou nas entidades HTML seguras &lt; (less than) e &gt; (greater than). Quando o navegador lê isso, ele não executa o negrito; ele exibe na tela exatamente o texto literal <b>Oi</b>.
```


## 3. Perguntas

**3.1 Qual aviso apareceu no item 2.1? O que ele significa?**

Apareceu o aviso Undefined array key "nome". Ele significa que o código tentou buscar a chave 'nome' dentro da variável global $_GET (que guarda os parâmetros da URL), mas essa chave não existia porque nenhum parâmetro foi passado na requisição.

**3.2 Compare o corpo da resposta em 2.2 e 2.3. O que o `htmlspecialchars` fez com `<b>`?**

O htmlspecialchars converteu os caracteres especiais < e > (que compõem as tags HTML) em entidades de texto inofensivas (&lt; e &gt;). Assim, em vez de o PHP devolver a tag HTML pronta para ser executada pelo navegador (como em 2.2), ele devolve um texto literal codificado (como em 2.3), impedindo a renderização indesejada.

**3.3 Teste no navegador `?nome=<script>alert('Ataque')</script>` antes e depois da correção. Explique o que aconteceu e por que isso é perigoso (XSS).**

Antes da correção: Ao acessar a URL, o navegador exibe um alerta (uma janela pop-up) escrito "Ataque". Isso acontece porque o PHP injetou o código JavaScript diretamente na página e o navegador o executou. Isso é extremamente perigoso e se chama Cross-Site Scripting (XSS). Um atacante poderia usar essa falha para roubar cookies, capturar senhas de usuários reais ou redirecionar a página para um site falso.

Depois da correção: O alerta não aparece mais. Em vez disso, o navegador apenas exibe na tela o texto literal <script>alert('Ataque')</script>. A proteção desarmou o código transformando-o em texto inofensivo.