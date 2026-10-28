# PWEB1 - Atividade 2 

Esta branch contém as resoluções da Atividade 2 da disciplina de Programação Web I.

## 2 Mapa de rotas: o que cada URL mostra e com qual status:
http://localhost:8000/?pag=inicio -> [200]: GET /?pag=inicio -> Requisição bem-sucedida. Renderiza a página inicial com as informações de apresentação.
http://localhost:8000/?pag=habilidades -> [200]: GET /?pag=habilidades -> Requisição bem-sucedida. Renderiza a página listando as habilidades do desenvolvedor.
http://localhost:8000/?pag=projetos -> [200]: GET /?pag=projetos -> Requisição bem-sucedida. Renderiza a página com a lista de todos os projetos.
http://localhost:8000/?pag=projeto&id=1 -> [200]: GET /?pag=projeto&id=1 -> Requisição bem-sucedida. O sistema captura o ID, no caso 1, fornecido na URL e renderiza os detalhes exclusivos daquele projeto.
http://localhost:8000/?pag=projeto&id=2 -> [200]: GET /?pag=projeto&id=2 -> Requisição bem-sucedida. O sistema captura o ID, no caso 2, fornecido na URL e renderiza os detalhes exclusivos daquele projeto.
http://localhost:8000/?pag=projeto&id=3 -> [200]: GET /?pag=projeto&id=3 -> Requisição bem-sucedida. O sistema captura o ID, no caso 3, fornecido na URL e renderiza os detalhes exclusivos daquele projeto.
http://localhost:8000/?formato=json -> [200]: GET /?formato=json -> aqui é a pagina da API JSON, ele fez um get sucedido dá pagina do json


## 3 Saídas do terminal: uma página que existe, uma que não existe, a troca de tema, a API e
o log do servidor, cada uma com a explicação linha por linha;

[::1]:50682 Accepted -> O servidor reconheceu o pedido e aceitou a ligação.
[::1]:50682 [200]: GET /?pag=habilidades -> O navegador solicita a página de habilidades. O código PHP processa a requisição, encontra a página na lista de $pag_validas e devolve o código de estado 200.
[::1]:50682 Closing -> O servidor terminou de enviar os dados e fechou aquela ligação específica.
[::1]:50698 Accepted -> O servidor reconheceu o pedido e aceitou a ligação.
[::1]:50698 [404]: GET /?pag=teste -> Como esta página não existe no array do código PHP, a validação funciona corretamente e força o envio do código de estado 404.
[::1]:50698 Closing -> O servidor terminou de enviar os dados e fechou aquela ligação específica.
[::1]:54786 [200]: GET /?tema=claro -> O usuario clica no link para mudar para o tema claro. O servidor executa o bloco de código que aciona o setcookie para gravar a preferência e devolve 200.
[::1]:54786 Closing -> O servidor terminou de enviar os dados e fechou aquela ligação específica.
[::1]:54796 Accepted -> O servidor reconheceu o pedido e aceitou a ligação.
[::1]:54796 [200]: GET /estilo.css -> Imediatamente a seguir, como a página recarregou com a nova classe no `<body>`, o navegador precisa do ficheiro CSS para aplicar as regras visuais. O servidor entrega o ficheiro CSS com sucesso.
[::1]:54796 Closing -> O servidor terminou de enviar os dados e fechou aquela ligação específica.
[::1]:49272 Accepted -> O servidor reconheceu o pedido e aceitou a ligação.
[::1]:49272 [200]: GET /?tema=escuro -> o servidor grava o cookie a nova preferencia, devolve a página,
[::1]:49272 Closing -> O servidor terminou de enviar os dados e fechou aquela ligação específica.
[::1]:49280 Accepted -> O servidor reconheceu o pedido e aceitou a ligação.
[::1]:49280 [200]: GET /estilo.css -> Navegador descarrega o CSS novamente para pintar o ecrã com as novas cores.
[::1]:49280 Closing -> O servidor terminou de enviar os dados e fechou aquela ligação específica.
[::1]:49292 Accepted -> O servidor reconheceu o pedido e aceitou a ligação.
[::1]:49292 [200]: GET /?formato=json -> O utilizador acede ao link da API. O seu código deteta o `$_GET['formato'] === 'json'`, altera o cabeçalho da página, codifica os arrays em JSON e entrega os dados. Como tudo correu bem, o status é 200.
[::1]:49292 Closing -> O servidor terminou de enviar os dados e fechou aquela ligação específica.
[::1]:49302 Accepted -> O servidor reconheceu o pedido e aceitou a ligação.
[::1]:49302 [200]: GET /favicon.ico -> Esta é uma requisição automática. Sempre que abre um site, o navegador tenta descarregar o favicon.ico para mostrar aquele pequeno ícone no separador do navegador. Como o servidor o encontra, ou o navegador aceita o fallback, devolve 200.
[::1]:49302 Closing -> O servidor terminou de enviar os dados e fechou aquela ligação específica.

## 4 Onde usei cada conceito: as linhas do código em que aparece cada recurso da aula;

```
$perfil = [
    'nome' => 'Dan Mendes',
    'curso' => 'Análise e Desenvolvimento de Sistemas (ADS).',
    // ...
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

```
-> Arrays e Estruturas de Dados que foi vistos em aula.

```
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
``` 
-> O uso do $_GET e do if foram vistos em sala, enquanto as flags JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE foram vistas na atividade anterior

```
$pag = $_GET['pag'] ?? 'inicio';

$tema_solicitado = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'claro';

 -> Os Operador de Coalescência Nula e Requisições foram visto em sala e na atividade.


if (isset($_GET['tema'])) {
    setcookie('tema', $tema, [
        'expires' => time() + (86400 * 30),
        'path' => '/',
        'secure' => true,  
        'httponly' => true, 
        'samesite' => 'Lax'
    ]);
}
```
-> Definição e Envio de Cookies foi visto na atividade.

```
if ($pag === 'projeto') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if (!isset($projetos[$id])) {
        http_response_code(404);
    }
} elseif (!in_array($pag, $pag_validas, true)) {
    http_response_code(404);
}
```
-> Validações com if/else e Respostas HTTP foi visto em aula e na atividade.

## 5 Decisões e dificuldades: por que a lógica fica no topo, por que validar o tema e o que foi mais difícil.

#### Por que a lógica do PHP fica no topo do arquivo?

A lógica precisa ser processada pelo servidor antes que qualquer estrutura de página HTML comece a ser renderizada e enviada para o navegador do usuário. Isso permite alterar cabeçalhos HTTP como header() e setcookie(), tratar redirecionamentos ou bloquear o acesso antes que informações indevidas sejam desenhadas na tela. Isso melhora o fluxo e garante a estabilidade da aplicação.

#### Por que é necessário validar o tema?

A validação é essencial para manter a segurança e a integridade visual do site, atuando em três frentes principais. Primeiramente, ela previne falhas visuais: se um usuário alterar a URL para algo como ?tema=teste, o PHP geraria `<body class="teste">`. Como não existem regras no CSS para essa classe, o site perderia toda a sua formatação. Nesse sentido, a validação,feita através de uma verificação como o in_array, garante que qualquer valor desconhecido seja revertido automaticamente para um padrão seguro, como o tema claro. Além do aspecto visual, a validação é crucial para a segurança contra injeção de código (XSS). Um usuário mal-intencionado poderia forjar um link contendo scripts maliciosos. Se essa informação fosse impressa diretamente no HTML sem o devido tratamento, o script seria executado. Ao forçar que o sistema aceite apenas as opções estritamente predefinidas, bloqueia-se 100% dessas tentativas de injeção. Por fim, esse processo garante a integridade do cookie. Se o código aceitasse um tema inválido, a função setcookie() gravaria essa falha no navegador do usuário, o que deixaria o site completamente quebrado para ele durante todos os 30 dias de validade estipulados para o cookie.

#### Por que a URL ($_GET) tem prioridade sobre o Cookie ($_COOKIE) na definição do tema?

No fluxo HTTP, quando utilizamos a função `setcookie()`, o cookie não é disponibilizado imediatamente na variável global `$_COOKIE` durante aquela mesma requisição. A função apenas envia um cabeçalho para o navegador com a instrução de salvar a informação. O PHP só terá acesso a esse novo cookie na próxima requisição. Portanto, se dependêssemos apenas de ler o `$_COOKIE` no momento em que o usuário clica para trocar o tema, a tela não mudaria de cor instantaneamente. Ao priorizar o `$_GET`, garantimos que a aplicação atualize a cor imediatamente na mesma requisição, enquanto atualiza o cookie em segundo plano para visitas futuras.

#### O que foi mais difícil no desenvolvimento?

A maior dificuldade foi entender a lógica por trás da função isset(). Inicialmente, não compreendi muito bem o seu funcionamento para verificação de variáveis e chaves de arrays, o que me levou a cometer alguns erros estruturais antes de conseguir implementar as checagens corretamente.