# Questão 04: Tipos e conversões

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `tipos.php` | Código fornecido (no item 3.3 você vai acrescentar linhas) |

## 1. Análise do código

**1.1 **Antes de executar**, preencha a coluna "Minha previsão" com o tipo e o valor de cada linha.

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"10" + 5` | | |
| `"10" . 5` | | |
| `7 / 2` | | |
| `7 % 2` | | |
| `(int) "3.9 kg"` | | |
| `(bool) "0"` | | |
| `(bool) "false"` | | |
| `0.1 + 0.2 == 0.3` | | |**

| `"10" + 5` | | | -> 15
| `"10" . 5` | | | -> 105
| `7 / 2` | | | -> 3,5
| `7 % 2` | | | -> 0
| `(int) "3.9 kg"` | | | -> 3
| `(bool) "0"` | | | -> False
| `(bool) "false"` | | | -> True 
| `0.1 + 0.2 == 0.3` | | |** -> False

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q04-tipos/tipos.php`**

```
<pre>
int(15)
string(3) "105"
float(3.5)
int(1)
int(3)
bool(false)
bool(true)
bool(false)
</pre>
```

**Explicação linha por linha:**

```
<pre>int(15) -> O PHP converteu a string "10" para inteiro e realizou a soma matemática com o 5.
string(3) "105" -> O operador . concatenou a string "10" com o número 5, transformando tudo em um texto de 3 caracteres.
float(3.5) -> Resultado da divisão normal. O PHP converteu automaticamente o resultado para um número decimal.
int(1) -> O operador % obteve o resto da divisão de 7 por 2, que é 1 e não 0.
int(3) -> O comando (int) forçou a conversão do texto para inteiro. O PHP pega apenas o número inicial e descarta as casas decimais e as letras ("3.9 kg" vira 3).
bool(false) -> É falso. No PHP, a string contendo apenas o número zero ("0") é uma exceção e é considerada false.
bool(true) -> É verdadeiro. O PHP considera qualquer string não vazia como verdadeira. A palavra "false" é apenas um texto comum, então é avaliada como true. Para ser falso, deveria ser uma string vazia "".
bool(false) -> Retorna falso porque o computador lida com números decimais de forma imprecisa.
</pre>
```

## 3. Perguntas

**3.1 Explique a diferença entre `"10" + 5` e `"10" . 5`.**

No PHP, o sinal de "+" é estritamente um operador matemático. Ele força a conversão da string "10" em número e realiza uma soma, resultando em 15. Já o ponto . é o operador de concatenação, responsável por unir textos. Ele transforma o número 5 em texto e o junta ao "10", resultando na string "105".

**3.2 Por que `(bool) "0"` é `false`, mas `(bool) "false"` é `true`?**

O PHP possui regras específicas de conversão para valores booleanos. Ele considera a string "0" como um valor vazio ou nulo e, portanto, a converte para false. Por outro lado, qualquer string contendo texto é vista apenas como uma string não vazia. Como não está vazia e não é "0", ela é convertida para true.

**3.3 Acrescente ao arquivo duas linhas `var_dump` criadas por você, com resultados que te surpreenderam ou que você achou interessantes. Explique cada uma.**

var_dump(true + true) -> Retorna int(2). Isso é interessante porque o PHP converte o valor booleano true para o número 1 ao tentar fazer uma operação matemática. Logo, ele soma 1 + 1.
var_dump([] == false); Retorna bool(true). É surpreendente porque estamos comparando um array vazio [] com um booleano. No PHP, arrays sem nenhum elemento são considerados falsos, então a comparação se torna verdadeira.
