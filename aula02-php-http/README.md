### Questão 01: O primeiro script

* **Iniciar o servidor:**
```
php -S localhost:8000 ola.php

```

* **Testar:**
Acesse `http://localhost:8000` no navegador ou execute:
```
curl.exe -i http://localhost:8000

```

### Questão 02: Lendo mensagens de erro

* **Iniciar o servidor:**
```
php -S localhost:8000 erro.php

```

* **Testar:**
Acesse `http://localhost:8000` no navegador (teste alterando a diretiva `display_errors` entre `0` e `1` no `php.ini`).

### Questão 03: Aspas simples e duplas

* **Iniciar o servidor:**
```
php -S localhost:8000 aspas.php

```

* **Testar:**
Acesse `http://localhost:8000` no navegador ou execute:
```
curl.exe -s http://localhost:8000

```

### Questão 04: Tipos e conversões

* **Iniciar o servidor:**
```
php -S localhost:8000 tipos.php

```

* **Testar:**
Acesse `http://localhost:8000` no navegador ou execute:
```
curl.exe -s http://localhost:8000

```

### Questão 05: Média com dados da URL

* **Iniciar o servidor:**
```
php -S localhost:8000 media.php

```

* **Testar:**
Acesse no navegador passando os parâmetros via Query String:
```text
http://localhost:8000?n1=8&n2=6

```

### Questão 06: Strings e acentuação

* **Iniciar o servidor:**
```
php -S localhost:8000 palavra.php

```


* **Testar:**
Acesse no navegador testando palavras com acentuação:
```text
http://localhost:8000?palavra=Ceará

```



### Questão 07: Tratamento e Segurança (XSS)

* **Iniciar o servidor:**
```
php -S localhost:8000 saudacao.php

```


* **Testar:**
Acesse no navegador injetando código HTML para verificar a sanitização:
```text
http://localhost:8000?nome=<b>Oi</b>

```



### Questão 08: Content-Type e JSON

* **Iniciar o servidor:**
```
php -S localhost:8000 dados.php

```


* **Testar:**
Execute o comando abaixo para verificar o retorno do cabeçalho `application/json`:
```
curl.exe -i http://localhost:8000

```



### Questão 09: Método HTTP e Status (Somente POST)

* **Iniciar o servidor:**
```
php -S localhost:8000 api.php

```


* **Testar:**
* Para verificar o **Erro 405** (GET padrão):
```
curl.exe -i http://localhost:8000

```


* Para verificar o **Sucesso 200** (POST):
```
curl.exe -i -X POST http://localhost:8000

```

### Questão 10: Cookies e Redirecionamento

**Parte A:**

* **Iniciar o servidor:** `php -S localhost:8000 contador.php`
* **Testar (com armazenamento de cookies):**
```
curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000

```

**Parte B:**

* **Iniciar o servidor:** `php -S localhost:8000 login.php`
* **Testar:**
Acesse `http://localhost:8000` no navegador. Se o código estiver correto, o cookie será criado e ocorrerá o redirecionamento automático para `dashboard.php`.

```

```