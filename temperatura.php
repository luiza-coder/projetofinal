<?php
function converterTemperatura($numero, $unidadeOrigem, $unidadeDestino) {
    switch ($unidadeOrigem) {
        case 'celsius':
            if ($unidadeDestino == 'fahrenheit') {
                return ($numero * 9/5) + 32;
            } elseif ($unidadeDestino == 'kelvin') {
                return $numero + 273.15;
            }
            return $numero; // Celsius para Celsius

        case 'fahrenheit':
            if ($unidadeDestino == 'celsius') {
                return ($numero - 32) * 5/9;
            } elseif ($unidadeDestino == 'kelvin') {
                return ($numero - 32) * 5/9 + 273.15;
            }
            return $numero; // Fahrenheit para Fahrenheit

        case 'kelvin':
            if ($unidadeDestino == 'celsius') {
                return $numero - 273.15;
            } elseif ($unidadeDestino == 'fahrenheit') {
                return ($numero - 273.15) * 9/5 + 32;
            }
            return $numero; // Kelvin para Kelvin

        default:
            return "Unidade de origem inválida.";
    }
}

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = trim($_POST['numero']);
    $unidadeOrigem = $_POST['unidadeOrigem'];
    $unidadeDestino = $_POST['unidadeDestino'];
    $resultado = converterTemperatura($numero, $unidadeOrigem, $unidadeDestino);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Conversor de Temperatura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-image: url('temp.jpg'); /* Altere para uma imagem desejada */
            background-size: cover;
            background-position: center;
            color: #A52A2A;
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
            color: #D2691E;
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
            background: #A52A2A;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }
        button:hover {
            background: #A52A2A;
        }
        h2 {
            text-align: center;
            color: #D2691E;
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
            background: #A52A2A;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .links a:hover {
            background: 210 105 30;
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
            <a href="comprimento.php">Conversor de Comprimentos</a>
        </div>
    </div>

    <div class="container">
        <h1><b>Conversor de Temperatura</b></h1>
        <form method="post">
            <input type="number" step="any" name="numero" placeholder="Digite a temperatura" required>
            <select name="unidadeOrigem" required>
                <option value="">Selecione a unidade de origem</option>
                <option value="celsius">Celsius</option>
                <option value="fahrenheit">Fahrenheit</option>
                <option value="kelvin">Kelvin</option>
            </select>
            <select name="unidadeDestino" required>
                <option value="">Selecione a unidade de destino</option>
                <option value="celsius">Celsius</option>
                <option value="fahrenheit">Fahrenheit</option>
                <option value="kelvin">Kelvin</option>
            </select>
            <button type="submit">Converter</button>
        </form>

        <?php if ($resultado !== null): ?>
            <h2>Resultado: <?php echo number_format($resultado, 2); ?> °<?php echo strtoupper(substr($unidadeDestino, 0, 1)); ?></h2>
        <?php endif; ?>

        <h2><b>Explicação sobre Conversão de Temperatura</b></h2>
        <div class="explicacao">
            <p>
                Para converter temperaturas, você deve entender as diferenças entre as escalas de temperatura. 
                As escalas mais comuns são Celsius (°C), Fahrenheit (°F) e Kelvin (K).
            </p>
            <p>
                Para converter entre estas unidades, você pode usar as fórmulas apropriadas:
            </p>
            <ol>
                <li>Celsius para Fahrenheit: \( °F = (°C \times \frac{9}{5}) + 32 \)</li>
                <li>Celsius para Kelvin: \( K = °C + 273.15 \)</li>
                <li>Fahrenheit para Celsius: \( °C = (°F - 32) \times \frac{5}{9} \)</li>
                <li>Kelvin para Celsius: \( °C = K - 273.15 \)</li>
                <li>Fahrenheit para Kelvin: \( K = (°F - 32) \times \frac{5}{9} + 273.15 \)</li>
                <li>Kelvin para Fahrenheit: \( °F = (K - 273.15) \times \frac{9}{5} + 32 \)</li>
            </ol>
            <p>
                Esse conceito pode ser aplicado para qualquer conversão de temperatura, e o código PHP acima realiza essas conversões automaticamente com base nas unidades selecionadas.
            </p>
        </div>
    </div>
</body>
</html>
