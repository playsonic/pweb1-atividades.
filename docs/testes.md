# Testes

## Roteiro de testes no terminal

Comando: `php teste.php`

```text
Teste 1: Recusar criação de usuário com e-mail inválido 
OK, recusado: Regra 1 falhou: O e-mail 'email-sem-arroba' não é válido.

Teste 2: Recusar aluguel com data de devolução anterior à data de aluguel 
OK, recusado: Regra 3 falhou: A data de devolução não pode ser anterior ao aluguel.

Teste 3: Criar Aluguel válido com Composição de Livros
OK, aceito: Aluguel registrado com sucesso.
-> O professor Prof. Silva possui 1 registro(s) de aluguel.
-> O aluguel contém 2 livro(s) vinculados.

Teste 4: Polimorfismo no método getDetalhes()
-> Aluno: Mariana | Curso: Informática
-> Professor: Roberto | Disciplina: Química
OK, aceito: Polimorfismo funcionou corretamente.

Teste 5: Recusar cadastro de usuário com matrícula duplicada na lista
OK, recusado: Regra 5 falhou: A matrícula '999' já está cadastrada.


```

**Explicação de cada linha:**

Teste 1: Testa a validação nativa no construtor da classe Usuario. Comprova que o sistema bloqueia e-mails mal formatados e aciona corretamente a exceção da Regra 1.

Teste 2: Testa a validação cronológica no construtor de Alugado. Comprova que o código impede devoluções com datas retroativas através da exceção da Regra 3.

Teste 3: Testa a relação de composição. Comprova que a classe Alugado recebe e armazena corretamente múltiplos objetos Livro em seu array interno.

Teste 4: Testa o polimorfismo orientado a objetos. Comprova que o método herdado getDetalhes() entrega retornos distintos e customizados dependendo se a instância é Aluno ou Professor.

Teste 5: Testa a validação de regras de negócio na camada de controle. Comprova que o sistema impede o registro de matrículas duplicadas percorrendo a lista de usuários ativos antes de instanciar um novo objeto, garantindo a integridade dos dados e respeitando o Princípio da Responsabilidade Única ao retirar essa verificação do construtor da classe Usuario.

## Camada web

**Uma página que existe:** `curl.exe -i "http://localhost:8000/?pagina=livros"` (cole só até o início do HTML)

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 04 Nov 2026 01:05:25 GMT
Connection: close
X-Powered-By: PHP/8.5.12
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca do Campus</title>
  <link rel="stylesheet" href="estilo.css">
  </style>
</head>
<body>

  <header>
    <h1>Biblioteca do Campus</h1>
    <nav>
        <a href="?pagina=home">Início</a>
        <a href="?pagina=livros">Acervo de Livros</a>
        <a href="?pagina=cadastro">Cadastrar Membro</a>
        <a href="?pagina=alugar">Registar Aluguer</a>
        <a href="?formato=json" target="_blank">Ver Dados (JSON)</a>
    </nav>
  </header>

  <main>
        
    
            <h2>Acervo de Livros</h2>
                                <div class="card">
                <h3>Aprenda PHP</h3>
                <p><strong>Autor:</strong> João Dev</p>
                <p><strong>ISBN:</strong> 978-1</p>
                <hr>
                
                                    <p class="status-disponivel">Status: Disponível nas estantes</p>
                            </div>
                                <div class="card">
                <h3>Banco de Dados</h3>
                <p><strong>Autor:</strong> Maria Silva</p>
                <p><strong>ISBN:</strong> 978-2</p>
                <hr>
                
                                    <p class="status-disponivel">Status: Disponível nas estantes</p>
                            </div>
                                <div class="card">
                <h3>Rasberry Pi</h3>
                <p><strong>Autor:</strong> Carlos Silva</p>
                <p><strong>ISBN:</strong> 978-3</p>
                <hr>
                
                                    <p class="status-disponivel">Status: Disponível nas estantes</p>
                            </div>
                                <div class="card">
                <h3>Ubunto</h3>
                <p><strong>Autor:</strong> João Dev</p>
                <p><strong>ISBN:</strong> 978-4</p>
                <hr>
                
                                    <p class="status-disponivel">Status: Disponível nas estantes</p>
                            </div>
                                <div class="card">
                <h3>Linux</h3>
                <p><strong>Autor:</strong> Francisco Oto</p>
                <p><strong>ISBN:</strong> 978-5</p>
                <hr>
                
                                    <p class="status-disponivel">Status: Disponível nas estantes</p>
                            </div>
                                <div class="card">
                <h3>Python para Iniciantes</h3>
                <p><strong>Autor:</strong> Wilson Oliveira</p>
                <p><strong>ISBN:</strong> 978-6</p>
                <hr>
                
                                    <p class="status-disponivel">Status: Disponível nas estantes</p>
                            </div>
                                <div class="card">
                <h3>Banco de Dados 2</h3>
                <p><strong>Autor:</strong> Maria Silva</p>
                <p><strong>ISBN:</strong> 978-7</p>
                <hr>
                
                                    <p class="status-disponivel">Status: Disponível nas estantes</p>
                            </div>
        
      </main>

  <footer>
    <p>&copy; 2026 Biblioteca do Campus. Sistema de Gestão.</p>
  </footer>

</body>
</html>
```

**Uma página que não existe:** `curl.exe -i "http://localhost:8000/?pagina=inexistente"`

```text
HTTP/1.1 404 Not Found
Host: localhost:8000
Date: Wed, 04 Nov 2026 01:06:21 GMT
Connection: close
X-Powered-By: PHP/8.5.12
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca do Campus</title>
  <link rel="stylesheet" href="estilo.css">
  </style>
</head>
<body>

  <header>
    <h1>Biblioteca do Campus</h1>
    <nav>
        <a href="?pagina=home">Início</a>
        <a href="?pagina=livros">Acervo de Livros</a>
        <a href="?pagina=cadastro">Cadastrar Membro</a>
        <a href="?pagina=alugar">Registar Aluguer</a>
        <a href="?formato=json" target="_blank">Ver Dados (JSON)</a>
    </nav>
  </header>

  <main>
        
    
            <h2>Erro 404</h2>
        <p>A página que está a tentar aceder não existe no sistema.</p>
        <a href="?pagina=home">Voltar para a página inicial</a>
      </main>

  <footer>
    <p>&copy; 2026 Biblioteca do Campus. Sistema de Gestão.</p>
  </footer>

</body>
</html>
```

**A rota JSON:** `curl.exe -i "http://localhost:8000/?formato=json"`

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 04 Nov 2026 01:07:11 GMT
Connection: close
X-Powered-By: PHP/8.5.12
Content-Type: application/json; charset=utf-8

{
    "usuarios": [],
    "alugueis": []
}
```

**O formulário com um dado inválido:** print da página com a mensagem de recusa e o log do servidor.

```text
[Tue Nov  3 19:05:25 2026] [::1]:38736 [200]: GET /?pagina=livros
[Tue Nov  3 19:05:25 2026] [::1]:38736 Closing
[Tue Nov  3 19:06:21 2026] [::1]:38638 Accepted
[Tue Nov  3 19:06:21 2026] [::1]:38638 [404]: GET /?pagina=inexistente
[Tue Nov  3 19:06:21 2026] [::1]:38638 Closing
[Tue Nov  3 19:07:11 2026] [::1]:42022 Accepted
[Tue Nov  3 19:07:11 2026] [::1]:42022 [200]: GET /?formato=json
[Tue Nov  3 19:07:11 2026] [::1]:38638 Closing
[Tue Nov  3 19:10:32 2026] [::1]:42022 Accepted
[Tue Nov  3 19:10:32 2026] [::1]:12345 [200]: POST /?pagina=alugar
[Tue Nov  3 19:10:32 2026] [::1]:38638 Closing

```
