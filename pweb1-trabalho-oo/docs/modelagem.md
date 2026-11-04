# Modelagem

## Diagrama de classes

Substitua o exemplo abaixo (tema 01, Feira Digital do Sertão) pelo diagrama do seu sistema.
Legenda: `<|--` herança ("é um"), `*--` composição ("tem um"), `#` protected, `-` private, `+` public.

```mermaid
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
```

```mermaid
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
```

```mermaid
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
```

```mermaid
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
```
```mermaid
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
    
    // Novos métodos para gerir a devolução
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
```


## Justificativas

### Herança

A classe mãe é Usuario (abstrata), e suas classes filhas são Professor e Aluno. A regra "X é um Y" aplica-se perfeitamente aqui: um Professor é um Usuário do sistema e um Aluno também é um Usuário, compartilhando atributos comuns como matricula, nome e email. O método getDetalhes() e o paraArray() são sobrescritos nas classes filhas (polimorfismo) porque a forma de apresentar os detalhes muda: o aluno exibe o seu curso, enquanto o professor exibe a sua disciplina.

### Composição

A classe Alugado guarda uma lista (array) de objetos da classe Livro e a classe Usuario guarda uma lista de objetos Alugado. A relação é claramente "tem um" (ou "tem vários"), pois um registro de aluguel tem livros vinculados a ele, mas um aluguel definitivamente não é um livro. Da mesma forma, um usuário tem aluguéis. Sem a existência do registro do aluguel, a lista de livros alugados não faria sentido lógico de existir agrupada daquela forma.

### Encapsulamento

Todos os atributos das classes (matricula, nome, email, isbn, devolvido, etc.) são privados (private) para proteger o estado interno dos objetos. Apenas métodos getters (ex: getNome(), getIsbn()) foram implementados para permitir a leitura externa segura. Não existem métodos setters genéricos porque os dados obrigatórios são injetados exclusivamente através do método construtor (__construct), onde passam por validações de regras de negócio (como a validação de e-mail e checagem cronológica das datas). As únicas alterações de estado permitidas após a instanciação ocorrem de forma controlada através de métodos específicos, como addLivro(), addAlugado() e marcarComoDevolvido().