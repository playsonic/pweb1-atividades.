<?php
declare(strict_types=1);

abstract class Usuario {
    private string $matricula;
    private string $nome;
    private string $email;
    private array $alugados = []; 

    public function __construct(string $matricula, string $nome, string $email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Regra 1 falhou: O e-mail '$email' não é válido.");
        }
        
        $this->matricula = $matricula;
        $this->nome = $nome;
        $this->email = $email;
    }

    public function getDetalhes(): string {
        return "Usuário: {$this->nome} (Matrícula: {$this->matricula})";
    }

    public function addAlugado(Alugado $alugado): void {
        $this->alugados[] = $alugado;
    }

    public function calcularQuantidadeDeAlugueis(): int {
        return count($this->alugados);
    }

    public function paraArray(): array {
        $alugadosArray = array_map(function(Alugado $a) {
            return $a->paraArray();
        }, $this->alugados);

        return [
            'tipo' => 'Usuario',
            'matricula' => $this->matricula,
            'nome' => $this->nome,
            'email' => $this->email,
            'total_alugueis' => $this->calcularQuantidadeDeAlugueis(),
            'alugados' => $alugadosArray
        ];
    }

    public function getMatricula(): string { return $this->matricula; }
    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getAlugados(): array { return $this->alugados; }
}