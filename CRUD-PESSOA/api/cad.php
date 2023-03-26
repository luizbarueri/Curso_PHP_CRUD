<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>
        <h2><a href="./index.html">Home</a><a href="#">Sobre</a></h2>
    </p>
    <header>
        <h1>Resultado do processamento</h1>
    </header>
    <main>
        <?php
            $lista = ["Luiz", "Ana", "Pedro"];
            $achou = false;
            foreach ($lista as $key => $value) {
                echo "$value <br>";
                echo '------------------------------------------------------------------------------------------';
            } 
            $nome = $_POST['nome'] ?? "Nome inválido";
            $sobrenome = $_POST['sobrenome'] ?? "Sobrenome inválido";
            date_default_timezone_set("America/Sao_Paulo");
            echo "Hoje é dia " . date("d/M/Y");
            echo "<br>";
            echo " e a hora atual é " . date("G:i:s T");
            echo "<br>";
            echo '------------------------------------------------------------------------------------------';
            
            foreach ($lista as $key => $value) {
               if ($nome == $value) {
                    echo "Olá <strong>$nome $sobrenome</strong>, bem vindo a este site.\u{1f30e}";
                    echo "<br>";
                    $achou = true;
                }
            }
            if ($achou == false) {echo "<strong>$nome</strong> não encontrado na lista!";}        
    
            echo "<br>";      
            echo '------------------------------------------------------------------------------------------';
            echo '------------------------------------------------------------------------------------------';
            echo "<br>";
            echo "Poderia usar também o '$'_REQUEST <br>";
            //echo var_dump($_REQUEST['nome'] , $_REQUEST['sobrenome']);
            echo "<br>";
            echo "<br>";

           
        ?>
    </main>
    <p><a href="javascript:history.go(-1)">Voltar para a página anterior</a></p>

</body>
</html>
