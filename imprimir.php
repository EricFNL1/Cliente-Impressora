<?php
$arquivo = $_POST['arquivo'] ?? '';

if (!$arquivo) {
    header('Location: index.php?m=Arquivo inválido');
    exit;
}

$host = 'http://10.0.0.246:8000/print.php?path=print';
$dados = json_encode(['arquivo' => $arquivo]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $host);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$res = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    header("Location: index.php?m=Erro ao imprimir: $err");
} else {
    header("Location: index.php?m=Impressão enviada com sucesso");
}
