# Questão 10: Cookies e a ordem da resposta HTTP

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `contador.php` | Parte A: criado por você |
| `login.php` | Parte B: código fornecido com erro (corrija no item 1.2) |
| `dashboard.php` | Parte B: criado por você |
| `prints/cookies-application.png` | DevTools, aba Application > Cookies, mostrando o cookie do contador |

> O arquivo `cookies.txt` criado pelo curl **não** deve ser enviado ao GitHub (ele já está no `.gitignore`).

## 1. Análise do código

**1.1 **Parte A:** cole o código do `contador.php` e explique como ele lê e grava o cookie.**

```
<?php
$visitas = isset($_COOKIE['visitas']) ? (int)$_COOKIE['visitas'] : 0; -> Lê o cookie 'visitas'. Se ele existir, converte o valor para inteiro; se não existir, assume o valor padrão 0.


$visitas++; -> Soma 1 à quantidade de visitas.


setcookie('visitas', $visitas, time() + 3600); -> Grava o novo valor de volta no cookie do usuário com validade de 1 hora. A função time() + 3600 define o timestamp atual mais 3600 segundos (1 hora) à frente.
echo "Você visitou esta página $visitas vez(es).";
?>
```

**1.2 **Parte B:** cole o `login.php` corrigido e o `dashboard.php`, e explique a correção.**

```
<?php
$usuarioLogado = $_COOKIE['usuario_logado'] ?? 'não'; -> Lê o cookie 'usuario_logado'. Se não existir, define o valor padrão como "não"

if ($usuarioLogado === 'true') { -> validação de login
    echo "Bem-vindo ao dashboard!";
} else {
    echo "Acesso negado. Faça o login primeiro.";
}
?>
```

No arquivo login.php original, havia um echo "Carregando a página..."; que ficava antes do setcookie e do header. No protocolo HTTP, todos os cabeçalhos (headers) da resposta devem ser enviados antes de qualquer conteúdo do corpo da página. Aquele echo forçava o envio antecipado do corpo, fechando o bloco de cabeçalhos e causando um erro fatal ao tentar modificar os headers depois. Ao remover o echo, as funções setcookie e header passam a funcionar corretamente.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 **Parte A:** saída de `curl.exe -i http://localhost:8000/q10-cookies/contador.php`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Tue, 13 Oct 2026 13:13:00 GMT
Connection: close
X-Powered-By: PHP/8.2.0
Set-Cookie: visitas=1; expires=Tue, 13-Oct-2026 14:13:00 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

Você visitou esta página 1 vez(es).
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK A conexão com servidor foi sucessidada
Host: localhost:8000 -> A porta e o host onde o servidor está rodando.
Date: Tue, 13 Oct 2026 13:13:00 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> A conexão de rede será encerrada após o envio.
X-Powered-By: PHP/8.2.0 -> -> Indica qual tecnologia e versão processou a página no servidor.
Set-Cookie: visitas=1; expires=Tue, 13-Oct-2026 14:13:00 GMT; Max-Age=3600 -> O servidor instrui o navegador/cliente a guardar um cookie chamado "visitas" com o valor "1" e validade de 1 hora.
Content-type: text/html; charset=UTF-8 -> O tipo de conteúdo que o navegador vai exibir (HTML).

Você visitou esta página 1 vez(es). -> O corpo da resposta, exibindo o contador.
```

**2.2 **Parte A:** saída de `curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000/q10-cookies/contador.php`, executado **três vezes** (cole a terceira)**

```
HTTP/1.1 200 OK 
Host: localhost:8000
Date: Tue, 13 Oct 2026 13:14:00 GMT
Connection: close
X-Powered-By: PHP/8.2.0
Set-Cookie: visitas=3; expires=Tue, 13-Oct-2026 14:14:00 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

Você visitou esta página 3 vez(es).
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> A conexão com o servidor foi bem-sucedida.
Host: localhost:8000 -> A porta e o host onde o servidor está rodando.
Date: Tue, 13 Oct 2026 13:14:00 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> A conexão de rede será encerrada após o envio.
X-Powered-By: PHP/8.2.0 -> -> Indica qual tecnologia e versão processou a página no servidor.
Set-Cookie: visitas=1; expires=Tue, 13-Oct-2026 14:13:00 GMT; Max-Age=3600 -> Como o curl enviou o cookie antigo (que estava com valor 2), o PHP somou +1, atualizou para 3 e instruiu o cliente a sobrescrever o cookie guardado com este novo valor.
Content-type: text/html; charset=UTF-8 -> Tipo do conteúdo.


Você visitou esta página 3 vez(es). -> O texto renderizado comprovando que o servidor reconheceu o retorno do usuário através do cookie.
```

**2.3 **Parte B, antes da correção:** saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Tue, 13 Oct 2026 13:15:00 GMT
Connection: close
X-Powered-By: PHP/8.2.0
Content-type: text/html; charset=UTF-8

<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at /.../login.php:2) in <b>/.../login.php</b> on line <b>3</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at /.../login.php:2) in <b>/.../login.php</b> on line <b>4</b><br />
Carregando a página...
```

**Explicação linha por linha:**

```
HTTP/1.1 200 OK -> O servidor respondeu com status de sucesso padrão (200), pois o redirecionamento (302) falhou.
Host: localhost:8000 -> aA porta e o host onde o servidor está rodando.
Date: Tue, 13 Oct 2026 13:15:00 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> A conexão de rede será encerrada após o envio.
X-Powered-By: PHP/8.2.0 -> Indica qual tecnologia e versão processou a página no servidor.
Content-type: text/html; charset=UTF-8 -> O tipo de conteúdo que o navegador vai exibir (HTML).

<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at /.../login.php:2) in <b>/.../login.php</b> on line <b>3</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at /.../login.php:2) in <b>/.../login.php</b> on line <b>4</b><br /> -> Erros informando que não foi possível modificar os cabeçalhos nas linhas 3 e 4, onde estavam o "setcookie" e "header" porque a saída do corpo já havia começado com o echo na linha 2.
Carregando a página... -> O texto do echo prematuro que causou todo o problema.
```

**2.4 **Parte B, depois da correção:** saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

```
HTTP/1.1 302 Found
Host: localhost:8000
Date: Tue, 13 Oct 2026 13:16:00 GMT
Connection: close
X-Powered-By: PHP/8.2.0
Set-Cookie: usuario_logado=true; expires=Tue, 13-Oct-2026 14:16:00 GMT; Max-Age=3600
Location: dashboard.php
Content-type: text/html; charset=UTF-8
```

**Explicação linha por linha:**

```
HTTP/1.1 302 Found -> Informa ao cliente que a requisição foi compreendida, mas o recurso exige um redirecionamento temporário para outra página.
Host: localhost:8000 -> A porta e o host onde o servidor está rodando.
Date: Tue, 13 Oct 2026 13:16:00 GMT -> A data e hora exatas em que o servidor gerou a resposta.
Connection: close -> aA conexão de rede será encerrada após o envio.
X-Powered-By: PHP/8.2.0 -> Indica qual tecnologia e versão processou a página no servidor.
Set-Cookie: usuario_logado=true; expires=Tue, 13-Oct-2026 14:16:00 GMT; Max-Age=3600 -> O PHP envia com sucesso a instrução para salvar o cookie de login.
Location: dashboard.php -> O servidor informa para qual URL (dashboard) o navegador deve ser redirecionado imediatamente.
Content-type: text/html; charset=UTF-8 -> Tipo do conteúdo padrão. Como há um redirecionamento 302, o navegador ignorará o corpo da página e seguirá para o Location.
```

## 3. Perguntas

**3.1 No item 2.1, qual cabeçalho da resposta grava o cookie? E por que o contador não passa de 1 se você repetir o comando sem `-c` e `-b`?**

O cabeçalho que instrui a gravação do cookie é o Set-Cookie. O contador não passa de 1 sem os parâmetros adicionais porque o curl, por padrão, ignora cookies. Como o protocolo HTTP não tem estado (stateless) e não tem "memória", se o cliente (curl) não guardar o cookie recebido e não o enviar de volta na próxima requisição, o servidor sempre tratará aquela conexão como sendo de um usuário inteiramente novo (visita 1).

**3.2 No item 2.2, o que fazem as opções `-c` e `-b`? O que isso prova sobre quem "lembra" do usuário no HTTP?**

A opção -c cookies.txt (cookie-jar) diz para o curl salvar os cookies recebidos pelo servidor no arquivo especificado. A opção -b cookies.txt diz para o curl ler esse mesmo arquivo e enviar os cookies armazenados junto com a requisição ao servidor.

Isso prova que, na arquitetura HTTP, é responsabilidade exclusiva do cliente (navegador/curl) armazenar os dados e enviá-los de volta em cada requisição para que o servidor consiga "lembrar" quem é o usuário.

**3.3 No item 2.3, qual aviso apareceu e por que o redirecionamento não aconteceu?**

Apareceu o aviso "Warning: Cannot modify header information - headers already sent". O redirecionamento não aconteceu porque a instrução header('Location: ...') precisa ser enviada na área de cabeçalhos da requisição HTTP. O echo "Carregando a página..."; forçou o servidor a fechar prematuramente o bloco de cabeçalhos e iniciar a transmissão do corpo da resposta, bloqueando qualquer alteração posterior nos cabeçalhos.

**3.4 No item 2.4, explique o status, o cabeçalho `Location` e o cabeçalho `Set-Cookie`. Por que `setcookie()` e `header()` precisam vir antes de qualquer `echo`?**

O status 302 sinaliza ao cliente que ele deve fazer uma nova requisição automática para outro endereço.

O cabeçalho Location informa exatamente qual é o destino dessa nova requisição (neste caso, dashboard.php).

O cabeçalho Set-Cookie determina a criação do cookie de sessão no cliente antes do redirecionamento.

Eles precisam vir antes de qualquer echo (ou mesmo antes de qualquer espaço em branco ou HTML fora da tag <?php) porque a estrutura da resposta HTTP divide rigidamente a mensagem em duas partes: cabeçalhos e corpo, separados por uma linha em branco. Assim que o servidor envia o primeiro caractere de texto para a tela (o corpo), a seção de cabeçalhos é encerrada definitivamente. O PHP perde a capacidade de inserir novos cabeçalhos, inviabilizando o uso de setcookie() e header().