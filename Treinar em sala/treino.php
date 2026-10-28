<?php
class Pessoa 
{   
    public string $nome;
    public int $idade;
    public float $altura;

    public function exibirPessoa(Pessoa $pessoa): void {
    echo "\nNome: {$pessoa->nome}, Idade: {$pessoa->idade}, Altura: {$pessoa->altura}\n";
}

};



$pessoa = new Pessoa();
$pessoa->nome = 'Renato';
$pessoa->idade = 40;
$pessoa->altura = 1.70;

$pessoa2 = new Pessoa();
$pessoa2->nome = 'Dan';
$pessoa2->idade = 22;
$pessoa2->altura = 1.80;

$pessoa->exibirPessoa($pessoa);
$pessoa2->exibirPessoa($pessoa2);