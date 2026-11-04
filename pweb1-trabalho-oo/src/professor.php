<?php
declare(strict_types=1);
require_once __DIR__ . '/usuario.php';

class Professor extends Usuario {
    private string $disciplina;

    public function __construct(string $matricula, string $nome, string $email, string $disciplina) {
        parent::__construct($matricula, $nome, $email);
        $this->disciplina = $disciplina;
    }

    public function getDetalhes(): string {
        return "Professor: " . $this->getNome() . " | Disciplina: " . $this->disciplina;
    }

    public function paraArray(): array {
        $dados = parent::paraArray(); 
        $dados['tipo'] = 'Professor';
        $dados['disciplina'] = $this->disciplina;
        return $dados;
    }

    public function getDisciplina(): string { return $this->disciplina; }
}