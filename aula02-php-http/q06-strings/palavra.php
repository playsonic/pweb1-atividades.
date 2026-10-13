<?php
$palavra = $_GET['palavra'] ?? "Ceara";
$tamanhopalavra = mb_strlen($palavra);

echo "<p>Palavra: $palavra</p>"; 
echo "<p>strlen: " . strlen($palavra) . "</p>"; 
echo "<p>mb_strlen: $tamanhopalavra </p>"; 
echo "<p>strtoupper: ". strtoupper($palavra) . "</p>";
echo "<p>mb_strtoupper: " . mb_strtoupper($palavra) . "</p>";

if ($tamanhopalavra <= 5) {
$tamanho = "palavra curta";
} else {
$tamanho = "palavra longa";
}


echo "<p>É uma $tamanho</p>"?>