<?php

declare(strict_types=1);

// Questão 07 - a conta da aula (exemplo 05). Encapsule.
// O saldo é público apenas para fins didáticos nesta aula.
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

$conta = new ContaBancaria();
$conta->titular = 'João';
$conta->numero = '12345';
$conta->depositar(1000);
$conta->sacar(250);
$conta->imprimirExtrato();
