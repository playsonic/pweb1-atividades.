<?php
$perfil = [
        'nome' => 'Dan Mendes',
        'curso' => 'Análise e Desenvolvimento de Sistemas (ADS).',
        'cidade' => 'Boa Viagem - CE',
        'textomim' => 'Sou um estudante de ADS'
];

$habilidades = [
    1 => [
        'habilidade' => 'HTML',
        'nivel' => 'Avançado'
    ],
    2 => [
        'habilidade' => 'CSS',
        'nivel' => 'Intermediário'
    ],
    3 => [
        'habilidade' => 'JavaScript',
        'nivel' => 'Avançado'
    ],
    4 => [
        'habilidade' => 'PHP',
        'nivel' => 'Intermediário'
    ],
    5 => [
        'habilidade' => 'MySQL',
        'nivel' => 'Intermediário'
    ],
    6 => [
        'habilidade' => 'C',
        'nivel' => 'Avançado'
    ],
    7 => [
        'habilidade' => 'Python',
        'nivel' => 'Básico'
    ],
    8 => [
        'habilidade' => 'C++',
        'nivel' => 'Avançado'
    ]
];

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
        'tecnologias' => 'Python31.7, C++',
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

$pag_validas = ['inicio', 'habilidades', 'projetos', 'projeto', 'contato'];
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>