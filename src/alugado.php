<?php
declare(strict_types=1);

require_once __DIR__ . '/livro.php';
require_once __DIR__ . '/usuario.php';

class Alugado {
    private Usuario $usuario;
    private string $dataAluguel;
    private string $dataDevolucao;
    private bool $devolvido = false;
    
    private array $livros = [];

    public function __construct(Usuario $usuario, string $dataAluguel, string $dataDevolucao) {
        if (strtotime($dataDevolucao) < strtotime($dataAluguel)) {
            throw new Exception("Regra 3 falhou: A data de devolução não pode ser anterior ao aluguel.");
        }
        $this->usuario = $usuario;
        $this->dataAluguel = $dataAluguel;
        $this->dataDevolucao = $dataDevolucao;
    }

    public function addLivro(Livro $livro): void {
        $this->livros[] = $livro;
    }

    public function calcularTotalLivros(): int {
        return count($this->livros);
    }
    
    public function marcarComoDevolvido(): void {
        $this->devolvido = true;
    }
    
    public function isDevolvido(): bool {
        return $this->devolvido;
    }

    public function paraArray(): array {
        $livrosArray = array_map(function(Livro $livro) {
            return $livro->paraArray();
        }, $this->livros);

        return [
            'dataAluguel' => $this->dataAluguel,
            'dataDevolucao' => $this->dataDevolucao,
            'devolvido' => $this->devolvido,
            'quantidade_livros' => $this->calcularTotalLivros(),
            'itens_alugados' => $livrosArray
        ];
    }

    public function getUsuario(): Usuario { return $this->usuario; }
    public function getDataAluguel(): string { return $this->dataAluguel; }
    public function getDataDevolucao(): string { return $this->dataDevolucao; }
    public function getLivros(): array { return $this->livros; }
}