<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor Moeda</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main>
    <?php
        $cotacao = 5.33;
        $real = $_POST['din'] ?? 0;
        $dolar = $real / $cotacao;
        echo "Cotação do dolar hoje: <b>\$ $cotacao</b>";
        echo "<hr>";
        echo "Então, meus R\$ <b>" . number_format($real, 2, ",", ".") . "</b> reais, equivalem a US$ <b>" . number_format($dolar, 2, ".", ",") . "</b> dolar";
        echo "<hr>";

        //Formatação de moedas com internacionlização
        // intl (internalization PHP)
        try {
            $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

            echo "Real  " . numfmt_format_currency($padrao, $real, "BRL") . "<br>";
            echo "Dolar " . numfmt_format_currency($padrao, $dolar, "USD");
        } catch (\Throwable $e) {
            echo 'numfmt_create("pt_BR", NumberFormatter::CURRENCY) -> Não é aceito na Vercel!!';
        }

       
    ?>
        <button onclick = "javascript:history.go(-1)">&#x7870 Voltar</button>

    </main>
</body>
</html>