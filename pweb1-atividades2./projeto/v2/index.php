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

$perfil = [
        'nome' => 'Dan Mendes',
        'curso' => 'Análise e Desenvolvimento de Sistemas (ADS).',
        'cidade' => 'Boa Viagem - CE',
        'textomim' => 'Sou um estudante de ADS'
];

$habilidades = ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL', 'C', 'Python', 'C++'];

$projetos = [
    1 => [
        'titulo' => 'Sistema Pedidos',
        'descricao' => 'Um sistema para gerenciar pedidos.',
        'tecnologias' => 'JavaScript, HTML, CSS',
        'link' => 'https://github.com/playsonic/sistema-pedidos-eng-reversa.git'
    ],
    2 => [
        'titulo' => 'Desenvolvimento Back-end com Node.js e TypeScript',
        'descricao' => 'Desenvolvimento em Backend.',
        'tecnologias' => 'TypeScript, Dockerfile',
        'link' => 'https://github.com/playsonic/Desenvolvimento-Back-end-com-Node.js-TypeScript.git'
    ],
    3 => [
        'titulo' => 'Projeto de POO',
        'descricao' => 'Varios micros projetos de Programação Orientada a Objetos.',
        'tecnologias' => 'Python, C++',
        'link' => 'https://github.com/playsonic/poo-bvg.git'
    ],
];


if (isset($_GET['formato']) && $_GET['formato'] === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    
    $dados_api = [
        'perfil' => $perfil,
        'projetos' => $projetos,
        'habilidades' => $habilidades
    ];
    
    echo json_encode($dados_api, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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
if ($pag === 'projeto') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if (!isset($projetos[$id])) {
        http_response_code(404);
    }
} elseif (!in_array($pag, $pag_validas, true)) {
    http_response_code(404);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio de <?php echo htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8'); ?></title>
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


    <?php if (!in_array($pag, $pag_validas, true)): ?>
        <h2>Erro 404</h2>
        <p>Página não encontrada.</p>

    <?php elseif ($pag === 'inicio'): ?>
        <h1>Sobre mim</h1>
        <p><?php echo "Olá, meu nome é " . htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') . " É um prazer te conhecer."; ?></p>
        <p><?php echo htmlspecialchars($perfil['textomim'], ENT_QUOTES, 'UTF-8'); ?></p>

        <p><?php echo "No Curso de " . htmlspecialchars($perfil['curso'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><?php echo "Na Cidade de " . htmlspecialchars($perfil['cidade'], ENT_QUOTES, 'UTF-8'); ?></p>

    <?php elseif ($pag === 'habilidades'): ?>
        <h1>Habilidades</h1>
        <p>Essa é a minha quantidade de habilidades: <strong><?php echo count($habilidades); ?></strong></p>
        <p>Lista Delas: <?php echo htmlspecialchars(implode(', ', $habilidades), ENT_QUOTES, 'UTF-8'); ?></p>

    <?php elseif ($pag === 'projetos'): ?>
        <h2>Projetos</h2>
        <ul>
            <?php foreach ($projetos as $id_proj => $proj): ?>
                <li>
                    <a href="?pag=projeto&id=<?php echo $id_proj; ?>">
                        <?php echo htmlspecialchars($proj['titulo'], ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php elseif ($pag === 'projeto'): ?>
        <?php $id = isset($_GET['id']) ? (int)$_GET['id'] : 0; ?>
        <?php if (!isset($projetos[$id])): ?>
            <h2>Erro 404</h2>
            <p>Projeto não encontrado.</p>
        <?php else: ?>
            <h2><?php echo htmlspecialchars($projetos[$id]['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><?php echo htmlspecialchars($projetos[$id]['descricao'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Tecnologias:</strong> <?php echo htmlspecialchars($projetos[$id]['tecnologias'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><a href="<?php echo htmlspecialchars($projetos[$id]['link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank">Ver no GitHub</a></p>
        <?php endif; ?>
    <?php endif; ?>

    <footer>
        <hr>
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8'); ?>. Todos os direitos reservados.</p>
        <p>Entre em contato conosco através do sistema.</p>
    </footer>

</body>
</html>