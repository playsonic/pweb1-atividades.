# Questão 06: Construtor

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `produto.php` | O Produto da aula. Você acrescenta o construtor |
| `teste-erros.php` | Fornecido: três criações erradas, uma de cada vez |

## 1. Análise do código

**1.1 Cole o seu construtor e explique cada linha.**

public function __construct(string $nome, float $preco, int $quantidade = 1)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

public function __construct(...): Define o método mágico do construtor, que é executado automaticamente assim que o objeto é instanciado. Os parâmetros definem os dados obrigatórios (e opcionais) para a criação.

$this->nome = $nome;: Atribui o valor do parâmetro $nome recebido na instânciação à propriedade $nome específica daquele objeto (referenciada por $this).

$this->preco = $preco;: Atribui o parâmetro $preco à respetiva propriedade $preco do objeto.

$this->quantidade = $quantidade;: Atribui o parâmetro $quantidade (ou o valor padrão de 1) à propriedade $quantidade do objeto.

**1.2 Explique o `= 1` no parâmetro `$quantidade`.**

O = 1 define um valor padrão (default) para o parâmetro $quantidade. Isto significa que a passagem desse argumento ao instanciar o objeto torna-se opcional. Se o programador invocar new Produto('Rato', 50.00), o PHP assumirá automaticamente que a quantidade é 1. Se invocar new Produto('Rato', 50.00, 5), o valor 1 será substituído pelo 5.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q06-construtor/produto.php`

```
Produto: Notebook
Preço unitário: R$ 3.500,00
Quantidade: 3
Total: R$ 10.500,00
Preço após desconto: R$ 3.150,00
```

**Explicação:**

O construtor recebeu todos os parâmetros no momento do new Produto(...) e construiu o objeto já com estado válido. Os métodos apresentar(), calcularTotal() e aplicarDesconto() funcionaram normalmente com os dados internalizados.

**2.2 Erro com `new Produto('Teclado')`**: `php q06-construtor/teste-erros.php`

```
PHP Fatal error:  Uncaught ArgumentCountError: Too few arguments to function Produto::__construct(), 1 passed in .../teste-erros.php on line X and at least 2 expected in .../produto.php
```

**Explicação:**

Ocorreu um ArgumentCountError. O construtor exige obrigatoriamente, no mínimo, dois argumentos (nome e preço), mas na instanciação $p1 = new Produto('Teclado'); foi passado apenas um (o nome). O PHP bloqueia a criação do objeto para impedir que ele exista com o preço indefinido.

**2.3 Erro com `new Produto('Teclado', 'cem reais', 2)`**

```
PHP Fatal error:  Uncaught TypeError: Produto::__construct(): Argument #2 ($preco) must be of type float, string given in .../teste-erros.php on line X
```

**Explicação:**

Ocorreu um erro fatal de tipo (TypeError). O segundo parâmetro do construtor foi declarado estritamente como float (número decimal), mas a chamada $p2 = new Produto('Teclado', 'cem reais', 2); tentou injetar uma string ('cem reais'). Como foi usado declare(strict_types=1), o PHP recusa a conversão e falha imediatamente.

**2.4 Erro com `new Produto()`**

```
PHP Fatal error:  Uncaught ArgumentCountError: Too few arguments to function Produto::__construct(), 0 passed in .../teste-erros.php on line X and at least 2 expected in .../produto.php
```

**Explicação:**

Tal como no erro 2.2, o construtor exige parâmetros. A chamada $p3 = new Produto(); foi feita com zero argumentos, violando a regra de passar pelo menos os dois parâmetros obrigatórios (nome e preço). O PHP não permite a criação de um "Produto vazio".

## 3. Perguntas

**a) A mensagem diz "at least 2 expected", e não "exactly 3". Por quê?**

Porque o terceiro parâmetro ($quantidade) possui um valor padrão (= 1). No PHP, parâmetros com valores padrão tornam-se opcionais. Assim, o construtor tem 3 parâmetros no total, mas apenas os primeiros 2 (nome e preço) não possuem valor padrão, sendo os únicos estritamente exigidos (expected).

**b) Quem devolve o objeto pronto: o `__construct` ou o `new`?**

É a palavra-chave new. O new é o operador responsável por alocar memória e instanciar o objeto. O método __construct é apenas uma função interna chamada automaticamente logo após a criação do objeto para inicializar as propriedades; o __construct nunca tem um return devolvendo o objeto.

**c) Que erro da versão anterior (sem construtor) deixou de ser possível?**

Deixou de ser possível criar um objeto com estado inconsistente (propriedades não inicializadas). Na versão original (sem construtor), era possível instanciar um Produto e esquecer de atribuir o $preco, gerando erros fatais (como no ficheiro de erros da Questão 02) mais tarde no código, ao tentar invocar calcularTotal(). Com o construtor, o objeto já nasce obrigatoriamente preenchido com dados válidos, caso contrário, o script é interrompido imediatamente na linha do new.