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

if (file_exists($arquivoJson)) {
    $conteudo = file_get_contents($arquivoJson);
    $dadosSalvos = json_decode($conteudo, true);

    if (isset($dadosSalvos['usuarios'])) {
        foreach ($dadosSalvos['usuarios'] as $u) {
            if ($u['tipo'] === 'Professor') {
                $listaUsuarios[] = new Professor($u['matricula'], $u['nome'], $u['email'], $u['disciplina']);
            } else {
                $listaUsuarios[] = new Aluno($u['matricula'], $u['nome'], $u['email'], $u['curso']);
            }
        }
    }

    if (isset($dadosSalvos['alugueis'])) {
        foreach ($dadosSalvos['alugueis'] as $a) {
            $usuarioDono = null;
            foreach ($listaUsuarios as $userObj) {
                if ($userObj->getMatricula() === $a['usuario_matricula']) {
                    $usuarioDono = $userObj;
                    break;
                }
            }

            if ($usuarioDono) {
                $novoAluguel = new Alugado($usuarioDono, $a['dataAluguel'], $a['dataDevolucao']);

                if (isset($a['devolvido']) && $a['devolvido'] === true) {
                    $novoAluguel->marcarComoDevolvido();
                }

                foreach ($a['itens_alugados'] as $itemLivroJson) {
                    foreach ($listaLivros as $livroObj) {
                        if ($livroObj->getIsbn() === $itemLivroJson['isbn']) {
                            $novoAluguel->addLivro($livroObj);
                        }
                    }
                }
                $usuarioDono->addAlugado($novoAluguel);
                $listaAlugueis[] = $novoAluguel;
            }
        }
    }
}


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
          
if (isset($_GET['formato']) && $_GET['formato'] === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    
    $dadosApi = [
        'usuarios' => array_map(function($u) { return $u->paraArray(); }, $listaUsuarios),
        'alugueis' => array_map(function($a) { return $a->paraArray(); }, $listaAlugueis)
    ];
    
    echo json_encode($dadosApi, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

$pagina = $_GET['pagina'] ?? 'home';
$paginas_permitidas = ['home', 'cadastro', 'livros', 'alugar'];

if (!in_array($pagina, $paginas_permitidas)) {
    http_response_code(404);
    $pagina = '404';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca do Campus</title>
  <link rel="stylesheet" href="estilo.css">
  </style>
</head>
<body>

  <header>
    <h1>Biblioteca do Campus</h1>
    <nav>
        <a href="?pagina=home">Início</a>
        <a href="?pagina=livros">Acervo de Livros</a>
        <a href="?pagina=cadastro">Cadastrar Membro</a>
        <a href="?pagina=alugar">Registar Aluguer</a>
        <a href="?formato=json" target="_blank">Ver Dados (JSON)</a>
    </nav>
  </header>

  <main>
    <?php if ($erroFormulario !== ''): ?>
        <div class="erro" style="color: red; margin-bottom: 15px;"><strong>Erro:</strong> <?= h($erroFormulario) ?></div>
    <?php endif; ?>
    
    <?php if ($mensagemSucesso !== ''): ?>
        <div class="sucesso" style="color: green; margin-bottom: 15px;"><strong>Sucesso:</strong> <?= h($mensagemSucesso) ?></div>
    <?php endif; ?>

    <?php if ($pagina === 'home'): ?>
        <h2>Membros Cadastrados</h2>
        <?php foreach ($listaUsuarios as $user): ?>
            <div class="card">
                <h3><?= h($user->getNome()) ?></h3>
                <p><?= h($user->getDetalhes()) ?></p>
                <p><strong>Email:</strong> <?= h($user->getEmail()) ?></p>
                <p><strong>Registos de Aluguer:</strong> <?= h((string)$user->calcularQuantidadeDeAlugueis()) ?></p>
            </div>
        <?php endforeach; ?>

    <?php elseif ($pagina === 'livros'): ?>
        <h2>Acervo de Livros</h2>
        <?php foreach ($listaLivros as $livro): ?>
            <?php 
                $alugadoPara = $statusLivros[$livro->getIsbn()]['alugadoPara'];
                $dataDevolucao = $statusLivros[$livro->getIsbn()]['dataDevolucao'];
            ?>
            <div class="card">
                <h3><?= h($livro->getTitulo()) ?></h3>
                <p><strong>Autor:</strong> <?= h($livro->getAutor()) ?></p>
                <p><strong>ISBN:</strong> <?= h($livro->getIsbn()) ?></p>
                <hr class="linha">
                
                <?php if ($alugadoPara !== null): ?>
                    <p class="status-alugado" >
                        Status: Alugado por <?= h($alugadoPara->getNome()) ?> (Devolução em <?= h($dataDevolucao) ?>)
                    </p>
                    
                    <form method="POST" action="?pagina=livros">
                        <input type="hidden" name="acao" value="devolver_livro">
                        <input type="hidden" name="matricula" value="<?= h($alugadoPara->getMatricula()) ?>">
                        <input type="hidden" name="isbn" value="<?= h($livro->getIsbn()) ?>">
                        <button type="submit" class="btn-devolver">Confirmar Devolução</button>
                    </form>
                <?php else: ?>
                    <p class="status-disponivel">Status: Disponível nas estantes</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    <?php elseif ($pagina === 'cadastro'): ?>
        <h2>Cadastrar Novo Membro</h2>
        <form method="POST" action="?pagina=cadastro">
            <input type="hidden" name="acao" value="cadastrar_usuario">
            
            <label>Tipo de Vínculo:</label>
            <select name="tipo">
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
            </select>

            <label>Matrícula:</label>
            <input type="text" name="matricula" required>

            <label>Nome Completo:</label>
            <input type="text" name="nome" required>

            <label>E-mail Institucional:</label>
            <input type="email" name="email" required>

            <label>Curso ou Disciplina:</label>
            <input type="text" name="especifico" placeholder="Ex: Informática (Aluno) ou Matemática (Prof)" required>

            <button type="submit">Cadastrar Membro</button>
        </form>

    <?php elseif ($pagina === 'alugar'): ?>
        <h2>Registar Novo Aluguer</h2>
        <form method="POST" action="?pagina=alugar">
            <input type="hidden" name="acao" value="registrar_aluguel">
            
            <label>Selecione o Membro:</label>
            <select name="matricula" required>
                <option value="">-- Escolha um membro --</option>
                <?php foreach ($listaUsuarios as $u): ?>
                    <option value="<?= h($u->getMatricula()) ?>"><?= h($u->getNome()) ?> (Matrícula: <?= h($u->getMatricula()) ?>)</option>
                <?php endforeach; ?>
            </select>

            <label>Selecione o Livro:</label>
            <select name="isbn" required>
                <option value="">-- Escolha um livro --</option>
                <?php foreach ($listaLivros as $l): ?>
                    <option value="<?= h($l->getIsbn()) ?>"><?= h($l->getTitulo()) ?> (ISBN: <?= h($l->getIsbn()) ?>)</option>
                <?php endforeach; ?>
            </select>

            <label>Data do Aluguer:</label>
            <input type="date" name="data_aluguel" required>

            <label>Data de Devolução:</label>
            <input type="date" name="data_devolucao" required>

            <button type="submit">Confirmar Aluguer</button>
        </form>

    <?php elseif ($pagina === '404'): ?>
        <h2>Erro 404</h2>
        <p>A página que está a tentar aceder não existe no sistema.</p>
        <a href="?pagina=home">Voltar para a página inicial</a>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; <?= date('Y') ?> Biblioteca do Campus. Sistema de Gestão.</p>
  </footer>

</body>
</html>