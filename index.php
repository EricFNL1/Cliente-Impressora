<?php
$host = 'http://10.0.0.246:8000/print.php';
$lista = @file_get_contents($host . '?path=files');
$arquivos = $lista ? json_decode($lista, true) : [];
$mensagem = $_GET['m'] ?? '';
?>

<h2>Upload de Arquivo para Impressão</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="arquivo" required>
    <button type="submit">Enviar</button>
</form>

<?php if ($mensagem): ?>
    <p><strong><?= htmlspecialchars($mensagem) ?></strong></p>
<?php endif; ?>

<hr>

<h2>Arquivos disponíveis para imprimir</h2>
<ul>
<?php foreach ($arquivos as $arquivo): ?>
    <li>
        <?= htmlspecialchars($arquivo) ?>
        <form action="imprimir.php" method="post" style="display:inline">
            <input type="hidden" name="arquivo" value="<?= htmlspecialchars($arquivo) ?>">
            <button type="submit">Imprimir</button>
        </form>
    </li>
<?php endforeach; ?>
</ul>
