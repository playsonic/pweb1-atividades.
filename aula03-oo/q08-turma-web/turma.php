<?php

declare(strict_types=1);

class Aluno
{
    public string $nome;
    public float $nota1;
    public float $nota2;

    public function getMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }
}

class Disciplina
{
    public string $nome;
    private array $alunos = [];

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function getAlunos(): array
    {
        return $this->alunos;
    }

    public function calcularMediaTurma(): float
    {
        $totalAlunos = count($this->alunos);
        
        if ($totalAlunos === 0) {
            return 0.0;
        }

        $somaMedias = 0.0;
        foreach ($this->alunos as $aluno) {
            $somaMedias += $aluno->getMedia();
        }

        return $somaMedias / $totalAlunos;
    }
}

$pweb = new Disciplina();
$pweb->nome = 'Programação Web';

$joao = new Aluno();
$joao->nome = 'João';
$joao->nota1 = 8.0;
$joao->nota2 = 9.0;
$pweb->adicionarAluno($joao);

$maria = new Aluno();
$maria->nome = 'Maria';
$maria->nota1 = 9.0;
$maria->nota2 = 9.0;
$pweb->adicionarAluno($maria);

if (isset($_GET['teste']) && $_GET['teste'] == '1') {
    $alunoTeste = new Aluno();
    $alunoTeste->nome = 'Aluno Teste';
    $alunoTeste->nota1 = 5.0;
    $alunoTeste->nota2 = 5.0;
    $pweb->adicionarAluno($alunoTeste);
}

?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turma de PWEB</title>
</head>
<body>
    <h1>Disciplina: <?= htmlspecialchars($pweb->nome) ?></h1>
    
    <ul>
        <?php foreach ($pweb->getAlunos() as $aluno): ?>
            <li>
                <?= htmlspecialchars($aluno->nome) ?> - Média: <?= number_format($aluno->getMedia(), 1, '.', '') ?>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <p>Média da Turma: <?= number_format($pweb->calcularMediaTurma(), 2, '.', '') ?></p>
</body>
</html>