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
       
       $real = $_REQUEST['din'] ?? 0;

        $inicio = date("m-d-Y", strtotime("-10 days"));
        $fim = date("m-d-Y");

        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=31&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,cotacaoVenda,dataHoraCotacao';
        
        $dados = json_decode(file_get_contents($url), true);

        var_dump($dados);

        //$cotacao = is_double($dados["value"][0]["cotacaoCompra"]);
        $cotacao = $dados["value"][0]["cotacaoCompra"];
        
        $dolar = $real / $cotacao;


        echo "Cotação do dolar hoje: <b>\$ $cotacao</b>";
        echo "<hr>";
        echo "Então, meus R\$ <b>" . number_format($real, 2, ",", ".") . "</b> reais, equivalem a US$ <b>" . number_format($dolar, 2, ".", ",") . "</b> dolar";
        echo "<hr>";

        //Formatação de moedas com internacionlização
        // intl (internalization PHP)
        $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

        echo "Real  " . numfmt_format_currency($padrao, $real, "BRL") . "<br>";
        echo "Dolar " . numfmt_format_currency($padrao, $dolar, "USD");
    ?>
        <button onclick = "javascript:history.go(-1)">&#x7870 Voltar</button>

    </main>
</body>
</html>
