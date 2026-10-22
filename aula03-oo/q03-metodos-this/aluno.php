<?php

declare(strict_types=1);

// Questão 03 - complete os três métodos
class Aluno
{
    public string $nome;
    public float $nota1;
    public float $nota2;

    public function calcularMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        $media = $this->calcularMedia();
        
        if ($media >= 7.0) {
            return 'Aprovado';
        } elseif ($media >= 4.0) {
            return 'Recuperação';
        } else {
            return 'Reprovado';
        }
    }

    public function apresentar(): void
    {
        $media = $this->calcularMedia();
        $mediaFormatada = number_format($media, 1, ',', '.');
        echo "{$this->nome}: média {$mediaFormatada} ({$this->situacao()})\n";
    }
}

$ana = new Aluno();
$ana->nome = 'Ana';
$ana->nota1 = 8.0;
$ana->nota2 = 9.5;

$bruno = new Aluno();
$bruno->nome = 'Bruno';
$bruno->nota1 = 5.0;
$bruno->nota2 = 6.0;

$caio = new Aluno();
$caio->nome = 'Caio';
$caio->nota1 = 2.5;
$caio->nota2 = 3.0;

$ana->apresentar();
$bruno->apresentar();
$caio->apresentar();
