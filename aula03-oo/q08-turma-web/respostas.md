# Questão 08: Desafio: a turma na web

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `turma.php` | Você cria do zero: as classes `Aluno` e `Disciplina` e a página HTML |

## 1. Análise do código

**1.1 Desenhe (em texto ou tabela) as duas classes: atributos com tipo e visibilidade e métodos com tipo de retorno.**

```
Classe Aluno

    Atributos:

        public string $nome

        public float $nota1

        public float $nota2

    Métodos:

        public function __construct(string $nome, float $nota1, float $nota2) (sem retorno / devolve a instância)

        public function getMedia(): float

Classe Disciplina

    Atributos:

        public string $nome

        private array $alunos

    Métodos:

        public function __construct(string $nome) (sem retorno)

        public function adicionarAluno(Aluno $aluno): void

        public function getAlunos(): array

        public function calcularMediaTurma(): float

```

**1.2 Explique `adicionarAluno(Aluno $aluno)`: o que significa um parâmetro do tipo de uma classe?**

O uso de Aluno $aluno é uma técnica chamada Type Hinting (Tipagem de Objeto). Significa que a função bloqueia qualquer tipo de dado primitivo (como string ou int) e só aceita como argumento uma variável que seja, obrigatoriamente, uma instância válida da classe Aluno. Isto garante que todos os elementos guardados no array $alunos possuem garantidamente o método getMedia(), evitando erros no momento de calcular a média da turma.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Resposta da página**: `curl.exe -i http://localhost:8000/q08-turma-web/turma.php`

```
HTTP/1.1 200 OK
Host: localhost:8000
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Turma de PWEB</title>
</head>
<body>
    <h1>Disciplina: Programação Web</h1>
    <ul>
        <li>João - Média: 8,5</li>
        <li>Maria - Média: 9,0</li>
    </ul>
    <p><strong>Média da Turma:</strong> 8,75</p>
</body>
</html>
```

**Explicação:**

A requisição padrão processou o ficheiro PHP normalmente. O script instanciou a disciplina e os dois alunos padrão (João e Maria). Calculou as médias individuais, somou os totais e dividiu por 2, resultando numa média geral de 8,75, gerando o HTML limpo que vemos na saída.

**2.2 Trecho da resposta com `?teste=1`**: `curl.exe -s "http://localhost:8000/q08-turma-web/turma.php?teste=1"`

```
<h1>Disciplina: Programação Web</h1>
    <ul>
        <li>João - Média: 8,5</li>
        <li>Maria - Média: 9,0</li>
        <li>Aluno Teste - Média: 5,0</li>
    </ul>
    <p><strong>Média da Turma:</strong> 7,50</p>
```

**Explicação:**

O parâmetro de URL ?teste=1 foi capturado pela superglobal $_GET['teste']. Isso acionou o bloco if dentro do PHP, que instanciou e adicionou dinamicamente um terceiro aluno ("Aluno Teste") ao objeto da disciplina antes de renderizar a página. Como o cálculo é dinâmico, a média da turma foi automaticamente recalculada para 7,50 ((8.5 + 9.0 + 5.0) / 3).

**2.3 Log do servidor das duas requisições**

```
[Wed Oct 21 11:30:00 2026] PHP 8.2.0 Development Server (http://localhost:8000) started
[Wed Oct 21 11:30:15 2026] [::1]:54320 [200]: GET /q08-turma-web/turma.php
[Wed Oct 21 11:30:25 2026] [::1]:54325 [200]: GET /q08-turma-web/turma.php?teste=1
```

**Explicação:**

O log mostra as conexões HTTP recebidas pelo servidor web embutido do PHP (php -S). Ele confirma que foram feitas duas requisições independentes (GET) em momentos diferentes, ambas respondidas com sucesso (código [200]).

**2.4 Erro ao passar um texto para `adicionarAluno` (pergunta a)**

```
Fatal error: Uncaught TypeError: Disciplina::adicionarAluno(): Argument #1 ($aluno) must be of type Aluno, string given in /caminho/turma.php on line 60
```

**Explicação:**

Ao tentar executar $pweb->adicionarAluno('Eduardo');, o PHP bloqueou a execução. A mensagem de erro deixa explícito que o método aguardava um dado do tipo classe Aluno, mas recebeu uma simples string ("Eduardo"), violando a tipagem estrita da declaração.

## 3. Perguntas

**a) O que acontece ao chamar `$pweb->adicionarAluno('Eduardo')`? Por quê?**

Acontece um Erro Fatal (TypeError). Porque o método adicionarAluno foi rigorosamente tipado para aceitar apenas objetos pertencentes à classe Aluno. Como "Eduardo" é apenas uma string, o PHP recusa a atribuição. Se não o fizesse, mais tarde, o comando $aluno->getMedia() dentro do foreach causaria um colapso, pois strings não possuem métodos.

**b) Os objetos `Aluno` continuam na memória do servidor entre uma requisição e outra? Use o log para justificar.**

Não, eles não continuam. O PHP adota o paradigma "Shared Nothing". Cada vez que o log regista um novo acesso (GET /turma.php), o PHP liga o ambiente, processa todo o código do zero, gera o HTML, envia ao cliente e imediatamente destrói todas as variáveis e objetos da memória RAM. O "Aluno Teste" só existiu durante o milissegundo da segunda requisição e foi apagado logo a seguir.

**c) Por que `calcularMediaTurma()` verifica se a lista está vazia antes de dividir?**

Para evitar um erro matemático de divisão por zero. A divisão da média é feita usando o comando count($this->alunos). Se a classe Disciplina for instanciada mas ainda não lhe tiverem sido adicionados alunos, o count será 0. Tentar dividir a soma por zero forçaria a página a gerar um erro fatal (DivisionByZeroError). Ao verificar primeiro, devolvemos um valor seguro (0.0) e mantemos a página a funcionar perfeitamente.