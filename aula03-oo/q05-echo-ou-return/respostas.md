# Questão 05: `echo` ou `return`?

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `retangulo.php` | Fornecido com métodos que imprimem. Você refatora |

## 1. Análise do código

**1.1 Cole a versão refatorada da classe e explique o que mudou em cada método.**

class Retangulo
{
    public float $largura;
    public float $altura;

    public function area(): float
    {
        return $this->largura * $this->altura;
    }

    public function perimetro(): float
    {
        return 2 * ($this->largura + $this->altura);
    }
}

O tipo de retorno de ambos os métodos foi alterado de void (sem retorno) para float, uma vez que agora eles devolvem resultados matemáticos de cálculos baseados em propriedades do tipo float.

A instrução echo "Texto: " . (calculo) . "\n"; foi completamente removida.

A instrução return foi introduzida em vez do echo. Agora, os métodos calculam a operação e devolvem o valor cru, delegando à lógica do script principal a decisão sobre o que fazer com esse dado (se será guardado, impresso ou somado).

**1.2 Explique como o total da área foi calculado no `foreach`.**

No script principal, instanciamos múltiplos objetos da classe Retangulo (ex: sala, quarto, casa de banho) e colocamo-los todos num array (ex: $comodos = [$sala, $quarto, $banheiro]). O laço de repetição foreach percorre esse array objeto a objeto. A cada iteração, ele acede ao método area() do objeto atual (graças ao return agora implementado) e adiciona o valor devolvido a uma variável acumuladora (ex: $totalArea += $comodo->area()), resultando no somatório global de todas as áreas no final do laço.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída do código original**: `php q05-echo-ou-return/retangulo.php`

```
Área: 48
Perímetro: 28
```

**Explicação:**

No código inicial, quando chamamos $sala->area() e $sala->perimetro(), os métodos apenas executam o cálculo (8 * 6 = 48; 2 * (8+6) = 28) e imprimem imediatamente o texto concatenado no ecrã.

**2.2 Saída do teste `var_dump($sala->area())` na versão original (item 2)**

```
Área: 48
NULL
```

**Explicação:**

Quando fazemos um var_dump() na chamada de um método com tipo de retorno original (void), observamos dois comportamentos: primeiro, o método executa o seu comando echo interno e exibe "Área: 48"; de seguida, como o método não utilizou o comando return, não há valor de devolução para o programa, pelo que o valor capturado pelo var_dump() na chamada é avaliado como NULL (vazio).

**2.3 Saída da versão refatorada**

```
Área da sala: 48
Perímetro da sala: 28
Área total do apartamento: 65
```

**Explicação:**

Como os métodos agora apenas usam return, temos controlo total sobre os dados. Podemos formatar livremente um echo personalizado para a sala ("Área da sala: 48") no exterior da classe e, mais importante, conseguimos acumular os dados brutos de três instâncias distintas num total, algo impossível de executar na versão inicial.

## 3. Perguntas

**a) O que um método `void` devolve? Use a saída 2.2 para responder.**

Um método void não devolve qualquer valor para o ponto onde foi invocado. O PHP representa esta ausência com o tipo NULL, o que fica perfeitamente comprovado na saída 2.2, em que o var_dump() obteve um resultado do tipo e valor NULL.

**b) Por que não dava para somar as áreas na versão original?**

Porque os métodos originais imprimiam diretamente uma string no ecrã utilizando echo e terminavam, devolvendo NULL. Tentar efetuar cálculos com um resultado NULL não tem eficácia, não sendo possível capturar os valores matemáticos ou encadeá-los numa fórmula de soma no script principal.

**c) Cite uma situação em que um método com `echo` faz sentido.**

Um método com echo faz sentido quando a finalidade principal é estritamente formatar ou gerar uma exibição visual e não existe qualquer intenção de reaproveitar esses dados no código. Exemplos clássicos incluem uma função renderizarHTML() para gerar visualização em ecrã, ou métodos formatadores como o mostrarStatus() da Questão 04 e o apresentar() da Questão 03.