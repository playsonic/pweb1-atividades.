<?php

declare(strict_types=1);

namespace App\Domain\Feira;

use InvalidArgumentException;

class ProdutoPorPeso extends Produto
{
    public function tipo(): string
    {
        return 'por kg';
    }

    public function calcularPreco(float $quantidade): float
    {
        if ($quantidade <= 0) {
            throw new InvalidArgumentException('A quantidade em kg deve ser maior que zero.');
        }

        return $this->getPreco() * $quantidade;
    }
}