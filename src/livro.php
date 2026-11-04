<?php
declare(strict_types=1);

class Livro {
    private string $isbn;
    private string $titulo;
    private string $autor;
    private int $anoPublicacao;

    public function __construct(string $isbn, string $titulo, string $autor, int $anoPublicacao) {
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anoPublicacao = $anoPublicacao;
    }

    public function paraArray(): array {
        return [
            'isbn' => $this->isbn,
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'anoPublicacao' => $this->anoPublicacao
        ];
    }

    public function getIsbn(): string { return $this->isbn; }
    public function getTitulo(): string { return $this->titulo; }
    public function getAutor(): string { return $this->autor; }
    public function getAnoPublicacao(): int { return $this->anoPublicacao; }
}