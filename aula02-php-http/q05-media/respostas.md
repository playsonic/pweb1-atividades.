# Questão 05: Média com dados da URL

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `media.php` | Código fornecido, que você vai modificar no item 1.2 |

## 1. Análise do código

**1.1 Explique o código original: o que fazem `const`, os parênteses no cálculo e o operador `? :`?**

const: Define uma constante. No código original, é utilizado para definir MEDIA_APROVACAO com o valor 7. Diferente de uma variável, o valor de uma constante não pode ser alterado durante a execução do script.

Os parênteses no cálculo: Assim como na matemática tradicional, os parênteses ($n1 + $n2) garantem a ordem de precedência. Eles forçam a soma das notas a acontecer antes da divisão por 2. Se não estivessem lá, o PHP dividiria apenas $n2 por 2 e somaria o resultado a $n1.

O operador ? : : É o operador ternário (um if/else em uma única linha). Ele avalia uma condição; se for verdadeira (média >= 7), retorna o valor após o ? ("Aprovado"). Se for falsa, retorna o valor após o : ("Em recuperação").

**1.2 Modifique o código para receber as notas pela URL (`?n1=...&n2=...`), usando `??` com valor padrão `0` e convertendo para `float`. Cole aqui o trecho que você alterou e explique.**

```
$n1 = (float) ($_GET['n1'] ?? 0);
$n2 = (float) ($_GET['n2'] ?? 0);
```

$_GET['n1'] / $_GET['n2']: Acessa os dados enviados pela URL através da Query String. Enquanto o "?? 0" é o operador de coalescência nula. Ele verifica se o parâmetro n1 ou n2 existe na URL. Se não existir, ele define o valor padrão como 0, evitando que o PHP lance um erro de variável não definida. Por fim, o (float) Faz o type casting, forçando a conversão do valor recebido (que chega como string na URL ou o número inteiro 0 do padrão) para um número de ponto flutuante (decimal), garantindo que as operações matemáticas sejam feitas corretamente, inclusive com notas quebradas (ex: 8.5). Os parênteses ao redor de $_GET[...] ?? 0 garantem que toda a expressão seja avaliada e só o resultado final seja convertido para float.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=5&n2=6"`**

```curl -i "http://localhost:8000/media.php?n1=5&n2=6"
HTTP/1.1 200 OK
Host: localhost:8000
Date: Sun, 11 Oct 2026 23:19:19 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

<p>Notas: 5 e 6</p>
<p>Média: 5.5</p>
<p>Situação: Em recuperação</p>
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> O protocolo e a confirmação de que a requisição ao servidor foi bem-sucedida.
Host: localhost:8000 -> Indica o servidor e a porta que receberam a requisição.
Date: Sun, 11 Oct 2026 23:19:19 GMT -> A data e hora exatas em que o servidor respondeu.
Connection: close -> O servidor informa que a conexão será fechada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> O cabeçalho que revela a tecnologia (PHP) utilizada pelo servidor para processar a página.
Content-type: text/html; charset=UTF-8 -> O tipo de dado retornado (página HTML) e a codificação de caracteres.

<p>Notas: 5 e 6</p> -> O HTML gerado pelo PHP exibindo os valores que foram capturados da URL.
<p>Média: 5.5</p> -> O resultado da operação matemática (5 + 6) / 2 calculada pelo script.
<p>Situação: Em recuperação</p> O resultado lógico da comparação feita pelo operador ternário. Como 5.5 é menor que 7 (constante MEDIA_APROVACAO), a condição foi falsa, retornando a segunda opção.
```

**2.2 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=9"`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Sun, 11 Oct 2026 23:35:15 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

<p>Notas: 9 e 0</p>
<p>Média: 4.5</p>
<p>Situação: Em recuperação</p>
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A requisição foi processada com sucesso
Host: localhost:8000 -> Indica o servidor e a porta que receberam a requisição.
Date: Sun, 11 Oct 2026 23:35:15 GMT GMT -> A data e hora exatas em que o servidor respondeu.
Connection: close -> O servidor informa que a conexão será fechada após a entrega dos dados.
X-Powered-By: PHP/8.5.10 -> O cabeçalho que revela a tecnologia (PHP) utilizada pelo servidor para processar a página.
Content-type: text/html; charset=UTF-8 -> O tipo de dado retornado (página HTML) e a codificação de caracteres.

<p>Notas: 9 e 0</p> -> O HTML gerado pelo PHP exibindo os valores que foram capturados da URL.
<p>Média: 4.5</p> -> O resultado da operação matemática (5 + 6) / 2 calculada pelo script.
<p>Situação: Em recuperação</p> -> O resultado lógico da comparação feita pelo operador ternário. Como 5.5 é menor que 7 (constante MEDIA_APROVACAO), a condição foi falsa, retornando a segunda opção.
```

**2.3 Log do servidor das duas requisições acima**

```
[Sun Oct 11 20:19:26 2026] [::1]:58582 Accepted
[Sun Oct 11 20:19:26 2026] [::1]:58582 [200]: GET /media.php?n1=5&n2=6
[Sun Oct 11 20:19:26 2026] [::1]:58582 Closing
[Sun Oct 11 20:35:15 2026] [::1]:56586 Accepted
[Sun Oct 11 20:35:15 2026] [::1]:56586 [200]: GET /media.php?n1=9
[Sun Oct 11 20:35:15 2026] [::1]:56586 Closing

```

**Explicação linha por linha:**

```
[Sun Oct 11 20:19:26 2026] [::1]:58582 Accepted -> A primeira conexão do cliente foi estabelecida.
[Sun Oct 11 20:19:26 2026] [::1]:58582 [200]: GET /media.php?n1=5&n2=6 -> O servidor registra que recebeu uma requisição do tipo GET para o arquivo media.php, contendo os dados n1=5 e n2=6 na URL. O [200] indica que processou a página com sucesso.
[Sun Oct 11 20:19:26 2026] [::1]:58582 Closing -> A primeira conexão foi encerrada.
[Sun Oct 11 20:35:15 2026] [::1]:56586 Accepted -> A segunda conexão foi estabelecida.
[Sun Oct 11 20:35:15 2026] [::1]:56586 [200]: GET /media.php?n1=9 -> O servidor registra a requisição GET, desta vez informando apenas o parâmetro n1=9 na URL. Mesmo faltando um dado, o servidor conseguiu responder com sucesso (Status 200) graças ao nosso tratamento no código (?? 0).
[Sun Oct 11 20:35:15 2026] [::1]:56586 Closing -> A segunda conexão foi encerrada.
```

## 3. Perguntas

**3.1 No log, onde aparecem os valores das notas? Que parte da URL é essa?**

Os valores aparecem logo após o nome do arquivo, no final da linha que começa com GET. Essa parte da URL é chamada de Query String. Ela começa sempre a partir do ponto de interrogação ? e os pares de chave/valor são separados pelo "e comercial" & (ex: ?n1=5&n2=6).

**3.2 Na requisição 2.2, a nota 2 não foi enviada. Qual valor o código usou? Qual operador garantiu isso?**

O código usou o valor 0. O operador que garantiu isso foi o operador de coalescência nula (??). Ele verifica se a variável $_GET['n2'] existe; como ela não existia na URL, ele automaticamente aplicou o valor padrão 0 que definimos à sua direita ($_GET['n2'] ?? 0). 

**3.3 O que acontece com `?n1=abc&n2=10`? Explique o papel do `(float)`.**

Se o usuário digitar letras (abc), o valor da primeira nota se transformará em 0. O responsável por isso é o type casting (float). Quando o PHP tenta converter forçadamente uma string não-numérica como "abc" em um número (float ou int), ele não entende o texto e o converte para o valor numérico 0. Assim, o cálculo continua funcionando sem quebrar o código (a conta feita seria (0 + 10) / 2). Além disso, o principal papel do (float) é garantir que os valores que chegam como texto da URL sejam tratados corretamente como números decimais, permitindo operações matemáticas precisas com casas decimais (como 8.5).