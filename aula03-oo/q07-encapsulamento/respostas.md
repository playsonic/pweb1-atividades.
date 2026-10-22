# Questão 07: Encapsulamento

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `conta.php` | A conta da aula. Você encapsula |
| `teste-protecao.php` | Fornecido: três tentativas de burlar a classe |

## 1. Análise do código

**1.1 Cole a sua classe e explique: quais atributos e métodos são `private`, quais são `public` e por quê.**

```
class ContaBancaria
{
    public string $titular;
    public string $numero;
    private float $saldo = 0.0;
    private array $extrato = [];

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception("Depósito inválido.");
        }
        $this->saldo += $valor;
        $this->registrar('Depósito', $valor);
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0 || $valor > $this->saldo) {
            throw new Exception("Saque inválido ou saldo insuficiente.");
        }
        $this->saldo -= $valor;
        $this->registrar('Saque', $valor);
    }

    public function consultarSaldo(): float
    {
        return $this->saldo;
    }

    private function registrar(string $operacao, float $valor): void
    {
        $this->extrato[] = "$operacao: R$ " . number_format($valor, 2, ',', '.');
    }

    public function imprimirExtrato(): void
    {
        echo "=== EXTRATO ({$this->numero}) ===\n";
        foreach ($this->extrato as $movimento) {
            echo $movimento . "\n";
        }
        echo "Saldo Final: R$ " . number_format($this->saldo, 2, ',', '.') . "\n";
    }
}
```

public ($titular, $numero, depositar, sacar, consultarSaldo, imprimirExtrato): São públicos porque compõem a "interface" do objeto com o mundo exterior. Dados cadastrais ($titular, $numero) não apresentam risco direto à regra de negócio do banco. Os métodos públicos são os caminhos oficiais e seguros para interagir com a conta.

private ($saldo, $extrato, registrar()): São privados para proteger o "coração" da classe contra manipulações externas. O saldo financeiro nunca pode ser alterado livremente ou diretamente; deve passar sempre por métodos de validação (depositar/sacar). O $extrato e o método registrar() são privados porque o extrato só deve ser preenchido de forma automática após uma operação bem-sucedida, nunca através de uma ordem manual externa.

**1.2 Explique o método privado `registrar()` e como o extrato é montado.**

O método registrar() atua como uma engrenagem interna da classe. Ele recebe o nome da operação ("Saque" ou "Depósito") e o valor associado, formata esse valor para a moeda local, constrói uma string e adiciona-a ao array $this->extrato. O extrato vai crescendo como um histórico sequencial cada vez que os métodos públicos (depositar e sacar) efetuam uma transação com sucesso e o invocam internamente.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída com `$conta->saldo = -300;` na versão original (item 1)**

```
Titular: João
Conta: 12345
Saldo: R$ -300,00
```

**Explicação:**

Na versão original, como a propriedade $saldo era public, o comando externo de injeção direta de um valor negativo sobrepôs todas as regras de negócio. Os R$ 750,00 que restavam na conta foram arbitrariamente transformados em R$ -300,00 sem passar pela validação lógica da classe.

**2.2 Saída da versão encapsulada**: `php q07-encapsulamento/conta.php`

```
Fatal error: Uncaught Exception: Saque inválido ou saldo insuficiente. in .../conta.php

Erro: Saque inválido ou saldo insuficiente.
=== EXTRATO (12345) ===
Depósito: R$ 1.000,00
Saque: R$ 250,00
Saldo Final: R$ 750,00
```

**Explicação:**

Com as regras bem implementadas através da instrução throw new Exception, a tentativa de sacar R$ 5000 de um saldo de R$ 750 foi bloqueada violentamente antes da subtração ocorrer. O método emite a exceção, não chega à fase de subtrair o saldo e não executa o método interno registrar(). O saldo e o extrato permanecem intactos.

**2.3 Tentativa 1: `$conta->saldo = -300;`**: `php q07-encapsulamento/teste-protecao.php`

```
PHP Fatal error:  Uncaught Error: Cannot access private property ContaBancaria::$saldo in .../teste-protecao.php
```

**Explicação:**

O encapsulamento funcionou. O PHP emite um erro fatal de acesso porque a propriedade $saldo foi declarada como private, tornando-a completamente invisível e bloqueada para o código externo à classe.

**2.4 Tentativa 2: `$conta->registrar(...)`**

```
PHP Fatal error:  Uncaught Error: Call to private method ContaBancaria::registrar() from global scope in .../teste-protecao.php
```

**Explicação:**

O erro ocorre porque registrar() é um método privado (private function). Uma rotina externa não tem autoridade para forjar movimentos bancários ou adicionar históricos "falsos" no extrato; apenas a própria classe (via depositar/sacar) pode evocar este método.

**2.5 Tentativa 3: `echo $conta->saldo;`**

```
PHP Fatal error:  Uncaught Error: Cannot access private property ContaBancaria::$saldo in .../teste-protecao.php
```

**Explicação:**

O bloqueio do encapsulamento afeta tanto a "escrita" como a "leitura". O código exterior não consegue sequer olhar para o valor da variável $saldo diretamente, sendo forçado a usar o método de leitura public function consultarSaldo() para esse fim.

## 3. Perguntas

**a) Por que a conta não tem um método `setSaldo()`?**

Porque permitir um setSaldo(5000) quebraria toda a segurança da conta bancária. Num objeto bancário real, o saldo atual é o resultado exclusivo de um histórico contínuo de débitos e créditos. A única forma legítima de alterar o saldo é através das ações/movimentações financeiras estritas (depositar() e sacar()), não por uma alteração manual direta.

**b) Qual a diferença entre a versão original (`echo` + `return`) e a nova (`throw`) quando uma operação é inválida?**

Na versão original, echo apenas avisa no ecrã (e continua a execução do script de forma silenciosa), podendo fazer com que o sistema assuma que o passo foi dado. A utilização de throw new Exception trava a rotina imediatamente. Isso garante que a aplicação não avança para lógicas futuras em estados incorretos ou comprometidos, forçando o programador a lidar ativamente com o erro através de blocos try/catch.

**c) O que acontece com o saldo quando um saque é recusado? Use a saída 2.2.**

Quando o saque é recusado (por insuficiência ou valor inválido), o método deteta a violação das regras e "explode" o erro antecipadamente (usando return ou throw). Como isso é feito antes da linha onde ocorre a subtração matemática ($this->saldo -= $valor;), a alteração não se concretiza. O saldo mantém-se exatamente com o mesmo valor (R$ 750,00) que possuía antes da tentativa falhada.