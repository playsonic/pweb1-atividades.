# Questão 03: Métodos e `$this`

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aluno.php` | Fornecido com os métodos a completar |

## 1. Análise do código

**1.1 Cole o código dos três métodos que você escreveu e explique cada um.**

```
    public function calcularMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        $media = $this->calcularMedia();
        
        if ($media >= 7.0) {
            return 'Aprovado';
        } elseif ($media >= 4.0) {
            return 'Recuperação';
        } else {
            return 'Reprovado';
        }
    }

    public function apresentar(): void
    {
        $media = $this->calcularMedia();
        $mediaFormatada = number_format($media, 1, ',', '.');
        echo "{$this->nome}: média {$mediaFormatada} ({$this->situacao()})\n";
    }   
```
calcularMedia(): Utiliza a pseudovariável $this para aceder às propriedades $nota1 e $nota2 do objeto atual, soma-as e divide o resultado por dois, devolvendo o valor com o tipo float.

situacao(): Invoca o método interno $this->calcularMedia() para obter o valor da média sem duplicar o cálculo. Em seguida, avalia o valor utilizando estruturas condicionais (if/elseif/else) para devolver a string correspondente à situação académica do aluno.

apresentar(): Calcula a média, formata-a para exibir apenas uma casa decimal com a vírgula como separador decimal (usando number_format()) e imprime no ecrã (com echo) uma frase formatada contendo o nome, a média e a situação do aluno obtida dinamicamente através de $this->situacao().

**1.2 Classifique os três métodos: de ação, com retorno, com parâmetros, modificador ou de consulta? Justifique.**

calcularMedia() e situacao(): São métodos com retorno (devolvem um float e uma string, respetivamente) e de consulta, pois limitam-se a aceder aos dados e processá-los para devolver um resultado, sem alterar o estado (atributos) do objeto. Nenhum deles tem parâmetros.

apresentar(): É um método de ação (ou comportamento) e sem retorno (void), pois a sua única finalidade é executar uma rotina de impressão (echo) no terminal. Não modifica os atributos e não possui parâmetros.
## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q03-metodos-this/aluno.php`

```
Ana: média 8,8 (Aprovado)
Bruno: média 5,5 (Recuperação)
Caio: média 2,8 (Reprovado)
```

**Explicação:**

O script instanciou com sucesso três objetos independentes da classe Aluno. O método apresentar() foi chamado para cada um, executando os cálculos internos com base nos valores atribuídos individualmente. As médias de Ana (8.75) e Caio (2.75) foram arredondadas corretamente pela função number_format para uma casa decimal (8,8 e 2,8, respetivamente).

**2.2 Saída com o quarto aluno (notas 6,5 e 7,5)**

```
Quarto Aluno: média 7,0 (Aprovado)
```

**Explicação:**

Ao instanciar um quarto aluno e atribuir as notas 6.5 e 7.5, a soma resulta em 14.0, resultando numa média exata de 7.0. A saída valida a lógica estabelecida no método situacao(), que classifica corretamente o aluno com nota exata de 7.0 como "Aprovado", graças ao operador lógico "maior ou igual" (>=).

## 3. Perguntas

**a) Por que `situacao()` chama `$this->calcularMedia()` em vez de repetir a conta?**

Esta prática respeita o princípio de programação DRY (Don't Repeat Yourself), que visa evitar a duplicação de código. Ao centralizar o cálculo num único método, assegura-se que, caso a regra para calcular a média mude no futuro (por exemplo, introduzindo notas com pesos), a alteração só precisa de ser feita num único lugar, prevenindo falhas de manutenção em cadeia.

**b) Com média exatamente 7,0, qual é a situação? Qual linha do código decide isso?**

A situação é "Aprovado". A decisão ocorre na primeira verificação condicional do método situacao(): if ($media >= 7.0) {. O operador >= (maior ou igual) assegura que o valor limite (exatamente 7.0) satisfaça a condição e entre nesse bloco de código.

**c) O método `apresentar()` foi escrito uma vez. Como ele sabe se deve mostrar a Ana ou o Bruno?**

Sabe disso através do uso da pseudovariável $this, que atua como um ponteiro interno para o próprio objeto. Quando o script invoca $ana->apresentar(), $this dentro da classe aponta para os dados do objeto $ana. Quando é invocado $bruno->apresentar(), o contexto do $this transita automaticamente para os dados do objeto $bruno. Isto permite que o mesmo código opere dados distintos com base na instância que o convocou.