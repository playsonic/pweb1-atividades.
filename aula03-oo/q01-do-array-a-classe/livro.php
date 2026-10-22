<?php

declare(strict_types=1);

class Livro {
    public string $titulo;
    public string $autor;
    public int $ano;
    public float $preco;
    public bool $disponivel;

    public function Exibirlivro(Livro $livro): void
    {
    echo "Titulo: {$livro->titulo}, de {$livro->autor} {$livro->ano}, Preço: R$ {$livro->preco}, Disponível: " . ($livro->disponivel ? "Sim" : "Não") . "\n";

    }
}

$livro1 = new Livro();
$livro1->titulo = 'Vidas Secas';
$livro1->autor = 'Graciliano Ramos';
$livro1->ano = 1938;
$livro1->preco = 39.90;
$livro1->disponivel = true; 

$livro2 = new Livro();
$livro2->titulo = "Frankenstein";
$livro2->autor = "Mary Shelley";
$livro2->ano = 1818;
$livro2->preco = 20.00;
$livro2->disponivel = false;

$livro1->Exibirlivro($livro1);
$livro2->Exibirlivro($livro2);
