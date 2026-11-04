<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/livro.php';
require_once __DIR__ . '/../src/usuario.php';
require_once __DIR__ . '/../src/alugado.php'; 
require_once __DIR__ . '/../src/aluno.php';
require_once __DIR__ . '/../src/professor.php';

function h(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$arquivoJson = __DIR__ . '/dados.json';

$listaLivros = [
    new Livro("978-1", "Aprenda PHP", "João Dev", 2023),
    new Livro("978-2", "Banco de Dados", "Maria Silva", 2021),
    new Livro("978-3", "Rasberry Pi", "Carlos Silva", 2019),
    new Livro("978-4", "Ubunto", "João Dev", 2000),
    new Livro("978-5", "Linux", "Francisco Oto", 2021),
    new Livro("978-6", "Python para Iniciantes", "Wilson Oliveira", 2022),
    new Livro("978-7", "Banco de Dados 2", "Maria Silva", 2025),
];
$listaUsuarios = [];
$listaAlugueis = [];



$erroFormulario = '';
$mensagemSucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    $salvarDados = false;

    try {
        if ($acao === 'cadastrar_usuario') {
            $tipo = $_POST['tipo'] ?? 'aluno';
            $matricula = $_POST['matricula'] ?? '';
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $especifico = $_POST['especifico'] ?? '';

            if ($tipo === 'professor') {
                $novoUsuario = new Professor($matricula, $nome, $email, $especifico);
            } else {
                $novoUsuario = new Aluno($matricula, $nome, $email, $especifico);
            }
            
            $listaUsuarios[] = $novoUsuario;
            $mensagemSucesso = "Membro " . $novoUsuario->getNome() . " cadastrado com sucesso!";
            $salvarDados = true;
            
        } elseif ($acao === 'registrar_aluguel') {
            $matriculaUser = $_POST['matricula'] ?? '';
            $isbnLivro = $_POST['isbn'] ?? '';
            $dataAluguel = $_POST['data_aluguel'] ?? '';
            $dataDevolucao = $_POST['data_devolucao'] ?? '';

            $usuarioSelecionado = null;
            foreach ($listaUsuarios as $u) {
                if ($u->getMatricula() === $matriculaUser) { $usuarioSelecionado = $u; break; }
            }

            $livroSelecionado = null;
            foreach ($listaLivros as $l) {
                if ($l->getIsbn() === $isbnLivro) { $livroSelecionado = $l; break; }
            }

            if (!$usuarioSelecionado || !$livroSelecionado) {
                throw new Exception("Usuário ou Livro inválido selecionado.");
            }
            
            foreach ($listaAlugueis as $aluguelExistente) {
                if (!$aluguelExistente->isDevolvido() && in_array($livroSelecionado, $aluguelExistente->getLivros(), true)) {
                    throw new Exception("Este livro já está alugado e ainda não foi devolvido.");
                }
            }

            $novoAluguel = new Alugado($usuarioSelecionado, $dataAluguel, $dataDevolucao);
            $novoAluguel->addLivro($livroSelecionado);
            $usuarioSelecionado->addAlugado($novoAluguel);
            
            $listaAlugueis[] = $novoAluguel;
            $mensagemSucesso = "Aluguer registado com sucesso!";
            $salvarDados = true;
            
        } elseif ($acao === 'devolver_livro') {
            $matriculaUser = $_POST['matricula'] ?? '';
            $isbnLivro = $_POST['isbn'] ?? '';

            $sucessoDevolucao = false;
            foreach ($listaAlugueis as $aluguel) {
                if (!$aluguel->isDevolvido() && $aluguel->getUsuario()->getMatricula() === $matriculaUser) {
                    foreach ($aluguel->getLivros() as $l) {
                        if ($l->getIsbn() === $isbnLivro) {
                            $aluguel->marcarComoDevolvido();
                            $mensagemSucesso = "Livro devolvido com sucesso! O estado foi atualizado nas estantes.";
                            $salvarDados = true;
                            $sucessoDevolucao = true;
                            break 2; 
                        }
                    }
                }
            }
            if (!$sucessoDevolucao) {
                throw new Exception("Não foi possível encontrar um aluguer ativo para este livro e utilizador.");
            }
        }

        if ($salvarDados) {
            $dadosParaSalvar = [
                'usuarios' => array_map(function($u) { return $u->paraArray(); }, $listaUsuarios),
                'alugueis' => array_map(function($a) { 
                    $arr = $a->paraArray();
                    $arr['usuario_matricula'] = $a->getUsuario()->getMatricula(); 
                    return $arr; 
                }, $listaAlugueis)
            ];
            
            file_put_contents($arquivoJson, json_encode($dadosParaSalvar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

    } catch (Exception $e) {
        $erroFormulario = $e->getMessage();
    }
}



$statusLivros = [];

foreach ($listaLivros as $livro) {
    $isbn = $livro->getIsbn();
      $statusLivros[$isbn] = [
        'alugadoPara' => null,
        'dataDevolucao' => ''
    ];
    
    foreach ($listaAlugueis as $registro) {
        if (!$registro->isDevolvido() && in_array($livro, $registro->getLivros(), true)) {
            $statusLivros[$isbn]['alugadoPara'] = $registro->getUsuario();
            $statusLivros[$isbn]['dataDevolucao'] = $registro->getDataDevolucao();
            break; 
        }
    }
}
          
?>
