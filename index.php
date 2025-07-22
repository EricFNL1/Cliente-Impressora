<?php
$api = "http://10.0.0.246:8000/print.php?path=files";
$arquivos = json_decode(file_get_contents($api), true);
?>

<h2>Arquivos disponíveis</h2>
<ul>
    <?php foreach ($arquivos as $arquivo): ?>
        <li>
            <?= htmlspecialchars($arquivo) ?>
            <form action="requisicao.php" method="post" style="display:inline">
                <input type="hidden" name="arquivo" value="<?= htmlspecialchars($arquivo) ?>">
                <button type="submit">Imprimir</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
