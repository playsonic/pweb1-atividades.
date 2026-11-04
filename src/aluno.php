<?php
declare(strict_types=1);
require_once __DIR__ . '/usuario.php';

class Aluno extends Usuario {
    private string $curso;

    public function __construct(string $matricula, string $nome, string $email, string $curso) {
        parent::__construct($matricula, $nome, $email);
        $this->curso = $curso;
    }

    public function getDetalhes(): string {
        return "Aluno: " . $this->getNome() . " | Curso: " . $this->curso;
    }

    public function paraArray(): array {
        $dados = parent::paraArray();
        $dados['tipo'] = 'Aluno';
        $dados['curso'] = $this->curso;
        return $dados;
    }

    public function getCurso(): string { return $this->curso; }
}