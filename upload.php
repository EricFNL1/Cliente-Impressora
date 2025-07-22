<?php
$host = 'http://10.0.0.246:8000/print.php?path=upload';

if (!isset($_FILES['arquivo'])) {
    header('Location: index.php?m=Arquivo não enviado');
    exit;
}

$tmp = $_FILES['arquivo']['tmp_name'];
$nome = $_FILES['arquivo']['name'];

$post = ['arquivo' => new CURLFile($tmp, null, $nome)];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $host);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$res = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    header("Location: index.php?m=Erro no upload: $err");
} else {
    header("Location: index.php?m=Arquivo enviado com sucesso");
}
