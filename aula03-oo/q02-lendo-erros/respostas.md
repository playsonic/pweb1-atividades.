# Questão 02: Lendo erros de objetos

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erros.php` | Fornecido com quatro erros. Corrija um de cada vez |

## 1. Análise do código

**1.1 Preencha a tabela, na ordem em que os erros apareceram:**

| Rodada | Linha | Tipo da mensagem (Warning ou Fatal error) | O que estava errado | Como corrigiu |
|---|---|---|---|---|
| 1 | linha 14 | UWarning / Notice | O método utilizava $nome solto em vez de referenciar a propriedade do objeto via $this->nome. | Alterou-se para $this->nome. |
| 2 | Linha 19 | Warning / Notice | A atribuição usava incorretamente um cifrão extra na propriedade ($aluno->$nome em vez de $aluno->nome). | Removeu-se o cifrão extra ($aluno->nome = 'Carla';). |
| 3 | Linha 20 | Fatal Error (TypeError) | o atributo semestre está sendo atribuida com uma string | $aluno->semestre = 3; |
| 4 | Linha 21 | Fatal Error (Uncaught Error) | A propriedade $curso foi declarada na classe, mas tentou ser exibida via echo antes de receber qualquer valor (não inicializada). | Atribuiu-se um valor à propriedade ($aluno->curso = 'ADS';). |

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Rodada 1**: `php q02-lendo-erros/erros.php`

```
PHP Warning:  Undefined variable $nome in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php on line 19
PHP Fatal error:  Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php:20
Stack trace:
#0 {main}
  thrown in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php on line 20

```

**2.2 Rodada 2**

```
PHP Warning:  Undefined variable $nome in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php on line 19
PHP Fatal error:  Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php:20
Stack trace:
#0 {main}
  thrown in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php on line 20
```

**2.3 Rodada 3**

```
PHP Fatal error:  Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php:20
Stack trace:
#0 {main}
  thrown in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php on line 20
```

**2.4 Rodada 4**

```text
PHP Fatal error:  Uncaught Error: Typed property Aluno::$curso must not be accessed before initialization in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php:21
Stack trace:
#0 {main}
  thrown in pweb1-atividades./aula03-oo/q02-lendo-erros/erros.php on line 21
```

**2.5 Execução final, sem erros**

```
Curso: ADS
Sou Carla, do 3º semestre.
```

**Explicação:**

Rodada 1-> Na primeira rodada, o interpretador identificou múltiplos problemas. O primeiro foi um aviso (Warning) na linha 14 porque a variável $nome foi tratada como uma variável local comum dentro do método e não foi encontrada. O segundo foi um erro fatal (TypeError) na linha 20 por incompatibilidade de tipos na atribuição do semestre.

Rodada 2-> AquApós corrigir a linha 14 (adicionando $this), o aviso de variável indefinida mudou para a linha 19 devido ao uso incorreto de um cifrão na atribuição ($aluno->$nome). O erro fatal de tipo na linha 20 permaneceu inalterado, pois ainda não havia sido corrigido.

Rodada 3-> Com o erro da linha 19 corrigido, todos os Warnings desapareceram. No entanto, o script continuou travando na linha 20 devido à atribuição incorreta de texto na propriedade numérica ($semestre).

Rodada 4-> Superados os erros anteriores, o PHP barrou a execução na linha 21 porque a propriedade tipada $curso foi declarada na classe mas nunca recebeu valor antes de ser lida pelo comando echo.

Rodade 5-> Com todas as inconsistências resolvidas (uso correto de $this, sintaxe de atribuição limpa, tipos de dados corretos e inicialização prévia de propriedades), o código executou com sucesso, exibindo o curso e executando o método apresentar() perfeitamente.

## 3. Perguntas

**a) Na rodada 1 apareceram duas mensagens. Qual delas parou o programa? Qual a diferença entre `Warning` e `Fatal error`?**

O programa foi interrompido pelo Fatal error (TypeError). O Warning é um aviso de que algo está incorreto ou fora dos padrões, mas o PHP tenta continuar a execução do script. Enquanto o Fatal error é um erro crítico que impede o interpretador de prosseguir com a execução, interrompendo imediatamente o programa.

**b) Por que o erro do `$curso` só aparece na linha do `echo`, e não na linha do `new Aluno()`?**

Porque no PHP as propriedades tipadas sem valor padrão não geram erro no momento da instanciação (new Aluno()). O erro só ocorre quando você tenta acessar/ler essa propriedade (no caso, via echo) antes que um valor inicial tenha sido atribuído a ela.

**c) Dentro do método, por que é preciso escrever `$this->nome`, e não só `$nome`?**

Porque $nome isolado seria interpretado como uma variável local comum da função (que não existe e estaria vazia). Já $this->nome indica explicitamente que você deseja acessar a propriedade pertencente à instância atual do objeto que está executando o método.