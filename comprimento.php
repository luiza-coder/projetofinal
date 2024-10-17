<?php
function converterComprimento($numero, $unidadeOrigem, $unidadeDestino) {
    switch ($unidadeOrigem) {
        case 'metros':
            $metros = $numero;
            break;
        case 'quilômetros':
            $metros = $numero * 1000;
            break;
        case 'centímetros':
            $metros = $numero / 100;
            break;
        case 'milhas':
            $metros = $numero * 1609.34;
            break;
        default:
            return "Unidade de origem inválida.";
    }

    switch ($unidadeDestino) {
        case 'metros':
            return $metros;
        case 'quilômetros':
            return $metros / 1000;
        case 'centímetros':
            return $metros * 100;
        case 'milhas':
            return $metros / 1609.34;
        default:
            return "Unidade de destino inválida.";
    }
}

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = trim($_POST['numero']);
    $unidadeOrigem = $_POST['unidadeOrigem'];
    $unidadeDestino = $_POST['unidadeDestino'];
    $resultado = converterComprimento($numero, $unidadeOrigem, $unidadeDestino);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   
    <title>Conversor de Comprimento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-image: url('prisma.jpg'); /* Altere para uma imagem desejada */
            background-size: cover;
            background-position: center;
            color: #333;
            display: flex;
        }
        .container {
            flex: 1;
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #473C8B;
            margin-bottom: 20px;
        }
        form {
            margin: 0 auto 20px auto;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #3A5FCD;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }
        button:hover {
            background: #473C8B;
        }
        h2 {
            text-align: center;
            color: #473C8B;
        }
        .explicacao {
            margin: 20px auto;
            padding: 20px;
            color: #333;
            font-size: 16px;
            line-height: 1.5;
            text-align: justify;
        }
        .sidebar {
            width: 300px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }
        .links {
            text-align: left;
            margin-top: 20px;
        }
        .links a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background: #3A5FCD;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .links a:hover {
            background: #473C8B;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><b>Outros Conversores</b></h2>
        <div class="links">
            <a href="volume.php">Conversor de Volume</a>
            <a href="capacidade.php">Conversor de Capacidade</a>
            <a href="area.php">Conversor de Áreas</a>
            <a href="massa.php">Conversor de Massas</a>
            <a href="binario.php">Conversor de Bases</a>
            <a href="temperatura.php">Conversor de Temperaturas</a>
        </div>
    </div>

    <div class="container">
        <h1><b>Conversor de Comprimento</b></h1>
        <form method="post">
            <input type="number" step="any" name="numero" placeholder="Digite o valor" required>
            <select name="unidadeOrigem" required>
                <option value="">Selecione a unidade de origem</option>
                <option value="metros">Metros</option>
                <option value="quilômetros">Quilômetros</option>
                <option value="centímetros">Centímetros</option>
                <option value="milhas">Milhas</option>
            </select>
            <select name="unidadeDestino" required>
                <option value="">Selecione a unidade de destino</option>
                <option value="metros">Metros</option>
                <option value="quilômetros">Quilômetros</option>
                <option value="centímetros">Centímetros</option>
                <option value="milhas">Milhas</option>
            </select>
            <button type="submit">Converter</button>
        </form>

        <?php if ($resultado !== null): ?>
            <h2>Resultado: <?php echo number_format($resultado, 2); ?> <?php echo $unidadeDestino; ?></h2>
        <?php endif; ?>

        <h2><b>Explicação sobre Conversão de Comprimento</b></h2>
        <div class="explicacao">
            <p>
                Para converter comprimentos, você deve entender que as unidades de comprimento são baseadas no sistema métrico. 
                A unidade de referência é o metro (m), que pode ser expandido ou reduzido para outras unidades de comprimento.
            </p>
            <p>
                Para converter entre unidades, você deve trazer o valor de origem para metros (m) e, em seguida, convertê-lo
                para a unidade de destino. Por exemplo, se você deseja converter de quilômetros (km) para metros (m), o processo
                é o seguinte:
            </p>
            <ol>
                <li>Converter quilômetros (km) para metros (m) multiplicando por 1.000.</li>
                <li>Depois, converter metros para a unidade de destino dividindo pelo fator de conversão correspondente.</li>
            </ol>
            <p>
                Esse conceito pode ser aplicado para qualquer conversão de comprimento dentro do sistema métrico, e o código PHP acima faz isso de forma automática, realizando as conversões com base nas unidades que você selecionar.
            </p>
        </div>
    </div>
</body>
</html>
