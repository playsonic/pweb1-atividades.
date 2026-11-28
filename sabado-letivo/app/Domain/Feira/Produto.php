<?php

declare(strict_types=1);

namespace App\Domain\Feira;

use InvalidArgumentException;

abstract class Produto
{
    private string $nome;
    private float $preco;
    private string $categoria;
    private int $estoque;

    public function __construct(string $nome, float $preco, string $categoria, int $estoque = 0)
    {
        if (trim($nome) === '') {
            throw new InvalidArgumentException('O nome do produto é obrigatório.');
        }

        if ($preco <= 0) {
            throw new InvalidArgumentException('O preço deve ser maior que zero.');
        }

        if (trim($categoria) === '') {
            throw new InvalidArgumentException('A categoria do produto é obrigatória.');
        }

        if ($estoque < 0) {
            throw new InvalidArgumentException('O estoque não pode ser negativo.');
        }

        $this->nome = $nome;
        $this->preco = $preco;
        $this->categoria = $categoria;
        $this->estoque = $estoque;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function getEstoque(): int
    {
        return $this->estoque;
    }

    public function estaDisponivel(): bool
    {
        return $this->estoque > 0;
    }

    abstract public function tipo(): string;

    abstract public function calcularPreco(float $quantidade): float;

    public function paraArray(): array
    {
        return [
            'nome' => $this->nome,
            'tipo' => $this->tipo(),
            'preco' => $this->preco,
            'categoria' => $this->categoria,
            'estoque' => $this->estoque,
        ];
    }
}