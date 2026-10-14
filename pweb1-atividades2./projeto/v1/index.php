<?php
$perfil = [
        'nome,' => 'Dan Mendes',
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
        'nivel' => 'Avançado'
    ],
    3 => [
        'habilidade' => 'JavaScript',
        'nivel' => 'Intermediário'
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

$palavra = htmlspecialchars($_GET['palavra'] ?? "inicio");


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