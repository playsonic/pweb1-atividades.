<?php
$usuarioLogado = $_COOKIE['usuario_logado'] ?? 'não';

if ($usuarioLogado === 'true') {
    echo "Bem-vindo ao dashboard!";
} else {
    echo "Acesso negado. Faça o login primeiro.";
}
