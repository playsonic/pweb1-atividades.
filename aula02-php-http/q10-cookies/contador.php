<?php
// 1. Lê o cookie 'visitas'. Se não existir, assume o valor padrão 0.
$visitas = isset($_COOKIE['visitas']) ? (int)$_COOKIE['visitas'] : 0;

// 2. Soma 1 à quantidade de visitas
$visitas++;


setcookie('visitas', $visitas, time() + 3600);
echo "Você visitou esta página $visitas vez(es).";
?>