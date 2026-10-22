# Questão 04: Tipos de métodos

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `termostato.php` | Fornecido. Você acrescenta dois métodos no item 4 |

## 1. Análise do código

**1.1 ANTES de executar, classifique os métodos:**

| Método | Tipo de retorno | Recebe parâmetro? | Altera o objeto? | Tipo do método |
|---|---|---|---|---|
| `getTemperatura()` | float | Não | Não | Consulta (Getter) |
| `definirAlvo()` | void | Sim (float $alvo) | Sim ($this->alvo) | Modificador (Setter) |
| `resfriar()` | void | Sim (float $graus) | Sim ($this->temperatura) | Modificador / Ação |
| `precisaResfriar()` | bool | Não | Não | Consulta |
| `mostrarStatus()` | void | Não | Não | Ação (Imprime no ecrã) |

**1.2 ANTES de executar, escreva as 5 linhas que você espera ver na saída:**

```
Laboratório 1: 25.0 °C (alvo 22.0 °C) - resfriando
Laboratório 1: 23.0 °C (alvo 22.0 °C) - resfriando
Laboratório 1: 23.0 °C (alvo 24 °C) - ok
33.0
bool(false)
```

**1.3 Cole os dois métodos novos (`aquecer` e `diferencaParaAlvo`) e classifique cada um.**

```
public function aquecer(float $graus): void
    {
        $this->temperatura += $graus;
    }

public function diferencaParaAlvo(): float
    {
        return abs($this->temperatura - $this->alvo);
    }
```

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída do código original**: `php q04-tipos-de-metodos/termostato.php`

```
Laboratório 1: 25.0 °C (alvo 22.0 °C) - resfriando
Laboratório 1: 23.0 °C (alvo 22.0 °C) - resfriando
Laboratório 1: 23.0 °C (alvo 24.0 °C) - ok
33
bool(false)
```

**Explicação:**

Laboratório 1: 25.0 °C (alvo 22.0 °C) - resfriando -> Imprime o estado inicial. Como 25 é maior que 22, diz "resfriando".

Laboratório 1: 23.0 °C (alvo 22.0 °C) - resfriando -> O método resfriar(2) reduziu a temperatura de 25 para 23. Continua maior que 22, logo, continua "resfriando".

Laboratório 1: 23.0 °C (alvo 24.0 °C) - ok -> O método definirAlvo(24) alterou o alvo. Agora a temperatura (23) não é maior que o alvo (24), então precisaResfriar() devolve falso, e o operador ternário imprime "ok".

33 -> O echo $sala->getTemperatura() + 10 pega na temperatura atual (23) devolvida pelo método, soma 10, e imprime 33.

bool(false) -> O var_dump($sala->precisaResfriar()) imprime o valor booleano, que neste caso é false, visto que a temperatura atual não é superior ao alvo.

**2.2 Saída com os métodos novos**

```
Laboratório 1: 28.0 °C (alvo 24.0 °C) - resfriando
4
```

**Explicação:**

Após adicionar os novos métodos, chamámos aquecer(5). A temperatura subiu de 23 para 28. O mostrarStatus() avalia que 28 é maior que 24 e imprime "resfriando". Por fim, o echo de diferencaParaAlvo() processa o cálculo absoluto |28 - 24|, exibindo corretamente a diferença de 4.

## 3. Perguntas

**a) Sua previsão do item 1.2 acertou todas as linhas? Explique cada diferença.**

Na minha previsão, adivinhei a lógica, mas dependendo de como o PHP trata os floats no echo, ele pode omitir a casa decimal ".0" ao imprimir inteiros puros, originando pequenas discrepâncias visuais, como escrever "24" em vez de "24.0" (se não for formatado explicitamente com number_format), ou imprimir 33 sem a casa decimal, ao contrário da minha estimativa de 33.0.

**b) Por que `echo $sala->getTemperatura() + 10` funciona, mas `$sala->mostrarStatus() + 10` não faria sentido?**

Funciona com $sala->getTemperatura() porque este é um método com retorno do tipo numérico (float). Ele entrega um valor (neste caso, 23.0) à instrução, que pode ser somado na mesma expressão matemática (23 + 10 = 33).
Por outro lado, o método $sala->mostrarStatus() é do tipo void (sem retorno) e a sua única função é efetuar um echo no terminal; não entrega nenhum valor para ser submetido a um cálculo ou manipulação externa.

**c) Qual método chama outro método do mesmo objeto?**

O método mostrarStatus(). Na primeira linha de código no interior deste método, ele evoca $this->precisaResfriar() para decidir dinamicamente se o ar condicionado está a esfriar ou se está tudo ok.