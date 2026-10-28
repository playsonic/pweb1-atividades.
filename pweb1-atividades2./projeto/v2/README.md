# PWEB1 - Atividade 2 

Esta branch contém as resoluções da Atividade 4 (versão 2 do projeto) da disciplina de Programação Web I.

---

## 2. As Classes (Estrutura)

### Classe: `Projeto`

| Atributo / Método | Tipo/Retorno | Visibilidade | Descrição |
| --- | --- | --- | --- |
| `$titulo` | `string` | `private` | Armazena o título do projeto. |
| `$descricao` | `string` | `private` | Armazena a descrição do projeto. |
| `$tecnologias` | `string` | `private` | Armazena as tecnologias utilizadas. |
| `$link` | `string` | `private` | Armazena a URL do projeto (ex: GitHub). |
| `__construct()` | `void` | `public` | Inicializa o objeto e valida se o título não está em branco. |
| `getTitulo()` | `string` | `public` | Retorna o valor do título. |
| `getDescricao()` | `string` | `public` | Retorna o valor da descrição. |
| `getTecnologias()` | `string` | `public` | Retorna o valor das tecnologias. |
| `getLink()` | `string` | `public` | Retorna o valor do link. |
| `paraArray()` | `array` | `public` | Converte os atributos privados em um array associativo (útil para a API JSON). |

### Classe: `Perfil`

| Atributo / Método | Tipo/Retorno | Visibilidade | Descrição |
| --- | --- | --- | --- |
| `$nome` | `string` | `private` | Armazena o nome do dono do portfólio. |
| `$curso` | `string` | `private` | Armazena o curso atual. |
| `$campus` | `string` | `private` | Armazena a instituição/campus. |
| `$cidade` | `string` | `private` | Armazena a cidade de residência. |
| `$apresentacao` | `string` | `private` | Texto curto de apresentação. |
| `$habilidades` | `array` | `private` | Lista de habilidades (strings). |
| `$projetos` | `array` | `private` | Array associativo de objetos da classe `Projeto`. |
| `__construct()` | `void` | `public` | Inicializa o perfil e exige no mínimo 5 habilidades. |
| `adicionarProjeto()` | `void` | `public` | Recebe um objeto `Projeto` e o adiciona ao array `$projetos`. |
| `getProjeto($id)` | `Projeto` | `public` | Busca e retorna um projeto pelo `$id`. Lança erro se não existir. |
| `getNome()`... | `string` | `public` | Getters diversos para retornar as informações pessoais. |
| `getHabilidades()` | `array` | `public` | Retorna a lista de habilidades. |
| `getProjetos()` | `array` | `public` | Retorna o array de objetos `Projeto`. |
| `paraArray()` | `array` | `public` | Converte o perfil inteiro (incluindo os projetos) em array para o JSON. |

---

## 3. Antes e Depois: O tratamento de Erro 404

**Trecho da versão v1 - Abordagem Procedural e Arrays:**

```
$id = $_GET['id'] ?? 0;
if (!isset($projetos[$id])) {
    http_response_code(404);
    $pagina = 'nao-encontrado';
    $titulo = 'Projeto não encontrado';
} else {
    $projetoAtual = $projetos[$id];
}

<h2><?php echo $projetoAtual['titulo']; ?></h2>

```

**Trecho da versão atual (v2 - Orientação a Objetos e Exceções):**

```
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
try {
    $projetoAtual = $perfil->getProjeto($id);
    $titulo = $projetoAtual->getTitulo();
} catch (Exception $e) {
    http_response_code(404);
    $pagina = 'nao-encontrado';
    $titulo = $e->getMessage();
}

<h2><?php echo htmlspecialchars($projetoAtual->getTitulo(), ENT_QUOTES, 'UTF-8'); ?></h2>

```

**O que mudou e o que melhorou:**

1. **Encapsulamento junto com Segurança:** Na v1, acessávamos chaves de array do (`['titulo']`) que estava sujeitas a erros de digitação e injeção de HTML. Na v2, chamamos métodos (`getTitulo()`) combinados com `htmlspecialchars()`, protegendo contra ataques.
2. **Delegação de Responsabilidade:** Na v2, a lógica que verifica se o projeto existe não fica solta no código principal, ela foi delegada para o método `getProjeto()` da classe `Perfil`.
3. **Tratamento de Exceções:** Usar `try/catch` captura os erros lançados pelas classes de forma muito mais elegante do que vários `if/else`.

---

## 4. As Classes se Recusam: Testes de Validação (Exceções)

Ao tentar criar objetos com dados inválidos, as classes utilizam o método construtor (`__construct`) para validar as informações antes de salvar na memória. Se as regras de negócio não forem atendidas, elas lançam uma exceção (`InvalidArgumentException`) que interrompe a execução, impedindo que o objeto passe a existir com um estado inválido e a segurando o código.

### Erro 1: Validação da classe Perfil
```
Fatal error: Uncaught InvalidArgumentException: O perfil precisa de 5 ou mais habilidades. in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades2./projeto/v2/index.php:57 
Stack trace: 
#0 /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades2./projeto/v2/index.php(126): Perfil->__construct() 
#1 {main} thrown in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades2./projeto/v2/index.php on line 57

```

* O erro vem pois foi lançado pelo método `__construct` da classe `Perfil`. O erro ocorreu porque, tentamos instanciar o `new Perfil(...)` passando um array com menos habilidades do que o mínimo exigido. Então, o objeto não existiu pois o teste `if (count($habilidades) < 5)` identificou a falha e disparou a exceção. Isso aborta o script antes que o PHP consiga alocar a variável `$perfil` na memória, evitando que o portfólio seja renderizado faltando dados obrigatórios.

### Erro 2: Validação da classe Projeto

```
Fatal error: Uncaught InvalidArgumentException: O projeto precisa de um título. in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades2./projeto/v2/index.php:11 
Stack trace: 
#0 /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades2./projeto/v2/index.php(149): Projeto->__construct() 
#1 {main} thrown in /home/dan/Faculdade/Aulas/Programação Web 1/pweb1-atividades2./projeto/v2/index.php on line 11

```

* O erro vem pois foi Lançado pelo método `__construct` da classe `Projeto`, originado pela tentativa de criar o projeto na linha 149. Então, o objeto não existiu pois o construtor executou o teste `if (trim($titulo) === '')` e percebeu que o título enviado estava vazio ou só tinha espaços. Ao lançar a exceção, o código parou instantaneamente. Isso impede que comandos como `$this->titulo = $titulo;` sejam executados, garantindo que seja matematicamente impossível existir um "projeto sem nome" dentro do sistema.

---

## 5. Saídas do Terminal (Testando as Rotas)


Abaixo estão os resultados reais capturados do servidor local e via `curl` ao testarmos diferentes cenários da aplicação.

### 1. Um projeto que existe (ID válido)

**Log do Servidor:**
```text
[Wed Oct 28 20:35:07 2026] [::1]:59172 [200]: GET /?pag=projeto&id=1

```

* Ao acessar um ID válido, o método `$perfil->getProjeto(1)` encontra a chave no array e devolve o objeto `Projeto`. O script flui normalmente, monta a estrutura HTML com os dados (título, descrição, link) e o servidor devolve o código de sucesso **HTTP 200 OK**.

### 2. Um projeto que NÃO existe (ID inválido)


```text
[Wed Oct 28 20:35:35 2026] [::1]:40928 [404]: GET /?pag=projeto&id=5

```

* Ao buscar o ID 5, o método percebe que ele não existe no array e lança uma `InvalidArgumentException`. O bloco `catch` intercepta esse erro e executa a função nativa `http_response_code(404)`. O servidor devolve corretamente o status **HTTP 404 Not Found**, e a página renderiza a mensagem de erro amigável na tela.

### 3. A API (Saída JSON)

**Comando no Terminal (`curl`):**

```bash
curl -i "http://localhost:8000/?formato=json"

```

**Resposta do Servidor:**

```http
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 28 Oct 2026 23:36:25 GMT
Connection: close
X-Powered-By: PHP/8.5.12
Content-Type: application/json; charset=utf-8

{
    "nome": "Dan Mendes",
    "curso": "Análise e Desenvolvimento de Sistemas (ADS).",
    "campus": "ifce - Campus Boa Viagem",
    "cidade": "Boa Viagem - CE",
    "apresentacao": "Sou um estudante de ADS",
    "habilidades": [
        "HTML", "CSS", "JavaScript", "PHP", "MySQL", "C", "Python", "C++"
    ],
    "projetos": {
        "1": {
            "titulo": "Sistema Pedidos",
            "descricao": "Um sistema para gerenciar pedidos.",
            "tecnologias": "JavaScript, HTML, CSS",
            "link": "[https://github.com/playsonic/sistema-pedidos-eng-reversa.git](https://github.com/playsonic/sistema-pedidos-eng-reversa.git)"
        },
        "2": {
            "titulo": "Desenvolvimento Back-end com Node.js e TypeScript",
            "descricao": "Desenvolvimento em Backend.",
            "tecnologias": "TypeScript, Dockerfile",
            "link": "[https://github.com/playsonic/Desenvolvimento-Back-end-com-Node.js-TypeScript.git](https://github.com/playsonic/Desenvolvimento-Back-end-com-Node.js-TypeScript.git)"
        }
    }
}

```

*  Ao receber `?formato=json`, o sistema entra na condição inicial do arquivo. Ele injeta o cabeçalho `Content-Type: application/json` (como visto na resposta do `curl`), pede para a classe `Perfil` converter seus atributos privados e projetos em um array (através do método `paraArray()`, imprime tudo formato JSON legível e dá um `exit`, cancelando a renderização do HTML.

---

## 6. Respostas às Perguntas Técnicas

**a) Por que `json_encode($perfil)` devolve `{}` (um objeto vazio)?**
A função nativa `json_encode` do PHP só consegue ler e serializar atributos que sejam `public`. Como todos os atributos da classe `Perfil` (nome, curso, habilidades) foram declarados como `private` (privados), a função enxerga o objeto como se estivesse vazio e retorna `{}`. Para resolver isso, foi criada a função `paraArray()`, que acessa os dados privados internamente e devolve um array nativo que o `json_encode` consegue interpretar.

**b) Os objetos `$perfil` e `$projeto` continuam na memória do servidor depois que a página é enviada? Por quê?**
**Não.** O PHP utiliza uma arquitetura sem estado. Toda vez que um usuário acessa uma página, o PHP levanta toda a memória do zero, executa o script do topo até o fim, envia o HTML pronto para o navegador e imediatamente destrói todos os objetos, variáveis e libera a memória RAM. Na próxima requisição, o `$perfil` e os `$projetos` serão recriados novamente pela função `new`.

**c) Por que os atributos são `private`, e não `public`?**
Para garantir o **Encapsulamento**. Se os atributos fossem públicos, qualquer parte externa do código poderia alterá-los diretamente de forma perigosa, burlando as regras de negócio e validações. Deixando-os como `private`, a única forma de acessar seus valores é através dos métodos "getters", e a única forma de definir seus estados iniciais é passando pelos testes rigorosos dos construtores.