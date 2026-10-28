<?php

class Projeto {
    private string $titulo;
    private string $descricao;
    private string $tecnologias;
    private string $link;

    public function __construct(string $titulo, string $descricao, string $tecnologias, string $link) {
        if (trim($titulo) === '') {
            throw new InvalidArgumentException("O projeto precisa de um título.");
        }

        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->tecnologias = $tecnologias;
        $this->link = $link;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getTecnologias(): string {
        return $this->tecnologias;
    }

    public function getLink(): string {
        return $this->link;
    }

    public function paraArray(): array {
        return [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'tecnologias' => $this->tecnologias,
            'link' => $this->link
        ];
    }
}

class Perfil {
    private string $nome;
    private string $curso;
    private string $campus;
    private string $cidade;
    private string $apresentacao;
    private array $habilidades;
    private array $projetos = [];

    public function __construct(string $nome, string $curso, string $campus, string $cidade, string $apresentacao, array $habilidades) {
        if (count($habilidades) < 5) {
            throw new InvalidArgumentException("O perfil precisa de 5 ou mais habilidades.");
        }

        $this->nome = $nome;
        $this->curso = $curso;
        $this->campus = $campus;
        $this->cidade = $cidade;
        $this->apresentacao = $apresentacao;
        $this->habilidades = $habilidades;
    }

    public function adicionarProjeto(Projeto $projeto): void {
        $this->projetos[count($this->projetos) + 1] = $projeto;
    }

    public function getProjeto(int $id): Projeto {
        if (!isset($this->projetos[$id])) {
            throw new InvalidArgumentException("Projeto não encontrado.");
        }
        return $this->projetos[$id];
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getCurso(): string {
        return $this->curso;
    }

    public function getCampus(): string {
        return $this->campus;
    }

    public function getCidade(): string {
        return $this->cidade;
    }

    public function getApresentacao(): string {
        return $this->apresentacao;
    }

    public function getHabilidades(): array {
        return $this->habilidades;
    }

    public function getProjetos(): array {
        return $this->projetos;
    }

    public function paraArray(): array {
        $projetosArray = [];
        foreach ($this->projetos as $id => $projeto) {
            $projetosArray[$id] = $projeto->paraArray();
        }

        return [
            'nome' => $this->nome,
            'curso' => $this->curso,
            'campus' => $this->campus,
            'cidade' => $this->cidade,
            'apresentacao' => $this->apresentacao,
            'habilidades' => $this->habilidades,
            'projetos' => $projetosArray
        ];
    }
}


$perfil = new Perfil(
    'Dan Mendes',
    'Análise e Desenvolvimento de Sistemas (ADS).',
    'ifce - Campus Boa Viagem',
    'Boa Viagem - CE',
    'Sou um estudante de ADS',
    ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL', 'C', 'Python', 'C++']
);

$perfil->adicionarProjeto(new Projeto(
    'Sistema Pedidos',
    'Um sistema para gerenciar pedidos.',
    'JavaScript, HTML, CSS',
    'https://github.com/playsonic/sistema-pedidos-eng-reversa.git'
));

$perfil->adicionarProjeto(new Projeto(
    'Desenvolvimento Back-end com Node.js e TypeScript',
    'Desenvolvimento em Backend.',
    'TypeScript, Dockerfile',
    'https://github.com/playsonic/Desenvolvimento-Back-end-com-Node.js-TypeScript.git'
));

$perfil->adicionarProjeto(new Projeto(
    'Projeto de POO',
    'Varios micros projetos de Programação Orientada a Objetos.',
    'Python, C++',
    'https://github.com/playsonic/poo-bvg.git'
));


if (isset($_GET['formato']) && $_GET['formato'] === 'json') {
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode($perfil->paraArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

$pag = $_GET['pag'] ?? 'inicio';

$tema_solicitado = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'claro';

$tema = in_array($tema_solicitado, ['claro', 'escuro'], true) ? $tema_solicitado : 'claro';

if (isset($_GET['tema'])) {
    setcookie('tema', $tema, [
        'expires' => time() + (86400 * 30),
        'path' => '/',
        'secure' => true,  
        'httponly' => true, 
        'samesite' => 'Lax'
    ]);
}

$pag_validas = ['inicio', 'habilidades', 'projetos', 'projeto'];
$projetoAtual = null;

if (!in_array($pag, $pag_validas, true)) {
    http_response_code(404);
    $pagina = 'nao-encontrado';
} elseif ($pag === 'projeto') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    try {
        $projetoAtual = $perfil->getProjeto($id);
        $titulo = $projetoAtual->getTitulo();
    } catch (Exception $e) {
        http_response_code(404);
        $pagina = 'nao-encontrado';
        $titulo = $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio de <?php echo htmlspecialchars($perfil->getNome(), ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="<?php echo $tema; ?>">

    <header>
        <nav>
            <a href="?pag=inicio">Início</a> |
            <a href="?pag=habilidades">Habilidades</a> |
            <a href="?pag=projetos">Projetos</a> |
            <?php if ($tema === 'escuro'): ?>
                <a href="?tema=claro">Tema Claro</a>
            <?php else: ?>
                <a href="?tema=escuro">Tema Escuro</a>
            <?php endif; ?> |
            <a href="?formato=json" target="_blank">API JSON</a>
        </nav>
   </header>
    <hr>

    <?php if (!in_array($pag, $pag_validas, true) || ($pagina ?? '') === 'nao-encontrado'): ?>
        <h2>Erro 404</h2>
        <p><?php echo htmlspecialchars($titulo ?? 'Página não encontrada.', ENT_QUOTES, 'UTF-8'); ?></p>

    <?php elseif ($pag === 'inicio'): ?>
        <h1>Sobre mim</h1>
        <p><?php echo "Olá, meu nome é " . htmlspecialchars($perfil->getNome(), ENT_QUOTES, 'UTF-8') . " É um prazer te conhecer."; ?></p>
        <p><?php echo htmlspecialchars($perfil->getApresentacao(), ENT_QUOTES, 'UTF-8'); ?></p>

        <p><?php echo "No Curso de " . htmlspecialchars($perfil->getCurso(), ENT_QUOTES, 'UTF-8'); ?> (<?php echo htmlspecialchars($perfil->getCampus(), ENT_QUOTES, 'UTF-8'); ?>)</p>
        <p><?php echo "Na Cidade de " . htmlspecialchars($perfil->getCidade(), ENT_QUOTES, 'UTF-8'); ?></p>

    <?php elseif ($pag === 'habilidades'): ?>
        <h1>Habilidades</h1>
        <p>Essa é a minha quantidade de habilidades: <strong><?php echo count($perfil->getHabilidades()); ?></strong></p>
        <p>Lista Delas: <?php echo htmlspecialchars(implode(', ', $perfil->getHabilidades()), ENT_QUOTES, 'UTF-8'); ?></p>

    <?php elseif ($pag === 'projetos'): ?>
        <h2>Projetos</h2>
        <ul>
            <?php foreach ($perfil->getProjetos() as $id_proj => $projObj): ?>
                <li>
                    <a href="?pag=projeto&id=<?php echo $id_proj; ?>">
                        <?php echo htmlspecialchars($projObj->getTitulo(), ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php elseif ($pag === 'projeto'): ?>
        <h2><?php echo htmlspecialchars($projetoAtual->getTitulo(), ENT_QUOTES, 'UTF-8'); ?></h2>
        <p><?php echo htmlspecialchars($projetoAtual->getDescricao(), ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Tecnologias:</strong> <?php echo htmlspecialchars($projetoAtual->getTecnologias(), ENT_QUOTES, 'UTF-8'); ?></p>
        <p><a href="<?php echo htmlspecialchars($projetoAtual->getLink(), ENT_QUOTES, 'UTF-8'); ?>" target="_blank">Ver no GitHub</a></p>
    <?php endif; ?>

    <footer>
        <hr>
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($perfil->getNome(), ENT_QUOTES, 'UTF-8'); ?>. Todos os direitos reservados.</p>
        <p>Entre em contato conosco através do sistema.</p>
    </footer>

</body>
</html>
