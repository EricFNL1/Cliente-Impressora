<?php
$arquivo = $_POST['arquivo'] ?? '';

if (!$arquivo) {
    die("Arquivo não informado.");
}

$api = "http://10.0.0.246:8000/print.php?path=print";

$dados = json_encode(['arquivo' => $arquivo]);

$ch = curl_init($api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($dados)
]);

$resposta = curl_exec($ch);
$erro = curl_error($ch);
curl_close($ch);

if ($erro) {
    echo "Erro ao imprimir: $erro";
} else {
    echo "<pre>Resposta da API:\n$resposta</pre>";
    echo "<a href='index.php'>Voltar</a>";
}
