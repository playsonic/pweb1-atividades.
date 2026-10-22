# Questão 01: Do array à classe

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `livro-array.php` | Fornecido: o livro em array associativo |
| `livro.php` | Você cria: a classe `Livro` e dois objetos |

## 1. Análise do código

**1.1 Explique a declaração `public float $preco;`: o que é cada uma das três partes?**

public: É o modificador de acesso que define que a propriedade pode ser lida e modificada livremente de qualquer lugar (dentro ou fora da classe).

float: É o tipo de dado da propriedade, indicando que ela armazena números de ponto flutuante (números reais com casas decimais, como 39.90).

$preco: É o nome da propriedade (variável) pertencente à classe, onde o valor correspondente do objeto será armazenado.

**1.2 Compare `$livro['titulo']` (array) e `$livro1->titulo` (objeto). O que muda na escrita e o que muda no que o PHP garante?**

Na escrita, o array associativo, acessamos os dados por chaves em formato de string usando colchetes ($livro['titulo']), o que está sujeito a erros de digitação na chave e não possui estrutura rígida. No objeto, utilizamos a sintaxe de seta ($livro1->titulo), que é mais limpa e orientada a domínios. Enquanto o PHP garante, o array associativo é dinâmico e flexível, permitindo adicionar ou remover chaves facilmente, mas sem garantias de tipos ou estrutura. Já a classe com tipagem estrita garante que a propriedade $titulo exista obrigatoriamente e seja estritamente uma string, oferecendo segurança contra tipos inválidos e melhor suporte de autocompletar na IDE.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q01-do-array-a-classe/livro.php`

```
Titulo: Vidas Secas, de Graciliano Ramos 1938, Preço: R$ 39.9, Disponível: Sim
Titulo: Frankenstein, de Mary Shelley 1818, Preço: R$ 20, Disponível: Não
```

**Explicação:**

O script instancia dois objetos da classe Livro ($livro1 e $livro2), atribui valores aos seus atributos tipados e, em seguida, chama o método Exibirlivro() para formatar e exibir as informações de cada livro no terminal, utilizando um operador ternário para converter o booleano de disponibilidade em "Sim" ou "Não".

**2.2 Erro ao atribuir o ano como texto (item 5)**

```
PHP Fatal error:  Uncaught TypeError: Cannot assign string to property Livro::$ano of type int in pweb1-atividades./aula03-oo/q01-do-array-a-classe/livro.php:20
Stack trace:
#0 {main}
  thrown in pweb1-atividades./aula03-oo/q01-do-array-a-classe/livro.php on line 20
```

**Explicação:**

Este erro fatal ocorre porque a propriedade $ano foi declarada explicitamente com o tipo int. Ao tentar atribuir uma string (texto) a essa propriedade, o PHP (reforçado pela diretiva declare(strict_types=1)) rejeita a atribuição imediatamente por incompatibilidade de tipos, impedindo que dados corrompidos ou incorretos entrem no objeto.

## 3. Perguntas

**a) Quantas classes e quantos objetos existem no seu `livro.php`?**

Existe 1 classe, Livro, e 2 objetos instanciados, $livro1 e $livro2.

**b) No `var_dump`, o que significam `object(Livro)#2` e o `(5)`?**

object(Livro)#2: Indica que a variável é uma instância da classe Livro e que este é o segundo objeto criado na execução do script (identificador de objeto #2).
(5): Indica o número de propriedades (atributos) definidos na classe.

**c) O que o `declare(strict_types=1)` mudou no resultado do item 5?**

A diretiva declare(strict_types=1) obriga o PHP a seguir rigorosamente a tipagem declarada nas propriedades e funções do arquivo. Sem ela, o PHP tentaria fazer uma coerção automática de tipos (conversão implícita de string para inteiro). Com ela ativada, o PHP bloqueia a operação e dispara um erro fatal (TypeError), garantindo maior integridade e confiabilidade ao código.