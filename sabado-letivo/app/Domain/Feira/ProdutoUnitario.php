<?php

declare(strict_types=1);

namespace App\Domain\Feira;

use InvalidArgumentException;

class ProdutoUnitario extends Produto
{
    public function tipo(): string
    {
        return 'por unidade';
    }

    public function calcularPreco(float $quantidade): float
    {
        if ($quantidade <= 0) {
            throw new InvalidArgumentException('A quantidade deve ser maior que zero.');
        }

        if ($quantidade !== floor($quantidade)) {
            throw new InvalidArgumentException('Produtos unitários aceitam apenas quantidades inteiras.');
        }

        return $this->getPreco() * $quantidade;
    }
}