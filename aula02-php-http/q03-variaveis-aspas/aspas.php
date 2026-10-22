<?php
$nome = "Maria";
$curso = "ADS";
$semestre = 2;
?>
<p><?php echo "Aluna: " . $nome; ?></p>
<p><?php echo "Aluna: $nome"; ?></p>
<p><?php echo 'Aluna: $nome'; ?></p>
<p><?php echo "Cursa o {$semestre}º semestre de $curso"; ?></p>
<p><?php echo $nome . $curso; ?></p>
<p>Atalho: <?= $nome ?></p>
