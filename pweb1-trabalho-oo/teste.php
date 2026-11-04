<?php
declare(strict_types=1);

require_once __DIR__ . '/src/livro.php';
require_once __DIR__ . '/src/usuario.php';
require_once __DIR__ . '/src/alugado.php'; 
require_once __DIR__ . '/src/aluno.php';
require_once __DIR__ . '/src/professor.php';


echo "Teste 1: Recusar criação de usuário com e-mail inválido\n";
try {
    $alunoErro = new Aluno("001", "João Errado", "email-sem-arroba", "Informática");
    echo "ERRO: a operação foi aceita e não deveria.\n";
} catch (Exception $e) {
    echo "OK, recusado: {$e->getMessage()}\n";
}
echo "\n";


echo "Teste 2: Recusar aluguel com data de devolução anterior à data de aluguel\n";
try {
    $alunoValido = new Aluno("003", "Carlos Certo", "carlos@escola.com", "Informática");
    
    $aluguelErro = new Alugado($alunoValido, "2023-11-10", "2023-11-05");
    echo "ERRO: a operação foi aceita e não deveria.\n";
} catch (Exception $e) {
    echo "OK, recusado: {$e->getMessage()}\n";
}
echo "\n";

echo "Teste 3: Criar Aluguel válido com Composição de Livros\n";
try {
    $profValido = new Professor("101", "Prof. Silva", "silva@escola.com", "Física");
    $livro1 = new Livro("978-01", "Física Quântica", "Autor X", 2020);
    $livro2 = new Livro("978-02", "Mecânica Clássica", "Autor Y", 2018);

    $aluguelValido = new Alugado($profValido, "2023-10-01", "2023-10-15");
    
    $aluguelValido->addLivro($livro1);
    $aluguelValido->addLivro($livro2);
    $profValido->addAlugado($aluguelValido);

    echo "OK, aceito: Aluguel registrado com sucesso.\n";
    echo "-> O professor " . $profValido->getNome() . " possui " . $profValido->calcularQuantidadeDeAlugueis() . " registro(s) de aluguel.\n";
    echo "-> O aluguel contém " . $aluguelValido->calcularTotalLivros() . " livro(s) vinculados.\n";
} catch (Exception $e) {
    echo "ERRO inesperado: {$e->getMessage()}\n";
}
echo "\n";


echo "Teste 4: Polimorfismo no método getDetalhes()\n";
try {
    $aluno1 = new Aluno("202", "Mariana", "mariana@escola.com", "Informática");
    $prof1 = new Professor("303", "Roberto", "roberto@escola.com", "Química");

    $lista = [$aluno1, $prof1];

    foreach ($lista as $usuario) {
        echo "-> " . $usuario->getDetalhes() . "\n";
    }
    echo "OK, aceito: Polimorfismo funcionou corretamente.\n";
} catch (Exception $e) {
    echo "ERRO inesperado: {$e->getMessage()}\n";
}
echo "\n";