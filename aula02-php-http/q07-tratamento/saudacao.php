<?php
$nome = $_GET['nome'] ?? "Visitante";
echo "Olá, " . htmlspecialchars($nome);