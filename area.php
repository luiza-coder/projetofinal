<?php
function converterArea($numero, $unidadeOrigem, $unidadeDestino) {
    switch ($unidadeOrigem) {
        case 'km²':
            $metrosQuadrados = $numero * 1000000; // 1 km² = 1.000.000 m²
            break;
        case 'hm²':
            $metrosQuadrados = $numero * 10000; // 1 hm² = 10.000 m²
            break;
        case 'dam²':
            $metrosQuadrados = $numero * 100; // 1 dam² = 100 m²
            break;
        case 'dm²':
            $metrosQuadrados = $numero / 100; // 1 dm² = 0.01 m²
            break;
        case 'cm²':
            $metrosQuadrados = $numero / 10000; // 1 cm² = 0.0001 m²
            break;
        case 'mm²':
            $metrosQuadrados = $numero / 1000000; // 1 mm² = 0.000001 m²
            break;
        default:
            return "Unidade de origem inválida.";
    }

    switch ($unidadeDestino) {
        case 'km²':
            return $metrosQuadrados / 1000000;
        case 'hm²':
            return $metrosQuadrados / 10000;
        case 'dam²':
            return $metrosQuadrados / 100;
        case 'dm²':
            return $metrosQuadrados * 100;
        case 'cm²':
            return $metrosQuadrados * 10000;
        case 'mm²':
            return $metrosQuadrados * 1000000;
        default:
            return "Unidade de destino inválida.";
    }
}

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = trim($_POST['numero']);
    $unidadeOrigem = $_POST['unidadeOrigem'];
    $unidadeDestino = $_POST['unidadeDestino'];
    $resultado = converterArea($numero, $unidadeOrigem, $unidadeDestino);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Conversor de Área</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-image: url('matrematica.jpg'); /* Use uma imagem de alta resolução */
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
            color: #B8860B;
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
            background: #B8860B;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }
        button:hover {
            background: #B8860B;
        }
        h2 {
            text-align: center;
            color: #B8860B;
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
            background: #B8860B;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .links a:hover {
            background: #B8860B;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><b>Outros Conversores</b></h2>
        <div class="links">
            <a href="volume.php">Conversor de Volumes</a>
            <a href="capacidade.php">Conversor de Capacidade</a>
            <a href="massa.php">Conversor de Massas</a>
            <a href="binario.php">Conversor de Bases</a>
        </div>
    </div>

    <div class="container">
        <h1><b>Conversor de Área</b></h1>
        <form method="post">
            <input type="number" step="any" name="numero" placeholder="Digite o valor" required>
            <select name="unidadeOrigem" required>
                <option value="">Selecione a unidade de origem</option>
                <option value="km²">Quilômetro Quadrado (km²)</option>
                <option value="hm²">Hectômetro Quadrado (hm²)</option>
                <option value="dam²">Decâmetro Quadrado (dam²)</option>
                <option value="dm²">Decímetro Quadrado (dm²)</option>
                <option value="cm²">Centímetro Quadrado (cm²)</option>
                <option value="mm²">Milímetro Quadrado (mm²)</option>
            </select>
            <select name="unidadeDestino" required>
                <option value="">Selecione a unidade de destino</option>
                <option value="km²">Quilômetro Quadrado (km²)</option>
                <option value="hm²">Hectômetro Quadrado (hm²)</option>
                <option value="dam²">Decâmetro Quadrado (dam²)</option>
                <option value="dm²">Decímetro Quadrado (dm²)</option>
                <option value="cm²">Centímetro Quadrado (cm²)</option>
                <option value="mm²">Milímetro Quadrado (mm²)</option>
            </select>
            <button type="submit">Converter</button>
        </form>

        <?php if ($resultado !== null): ?>
            <h2>Resultado: <?php echo number_format($resultado, 2); ?> <?php echo $unidadeDestino; ?></h2>
        <?php endif; ?>

        <div class="explicacao">
            <h2><b>Explicações de Conversão de Área</b></h2>
            <p><strong>De quilômetros quadrados (km²) para metros quadrados (m²):</strong> Multiplica-se o valor em km² por 1.000.000.</p>
            <p><strong>De metros quadrados (m²) para centímetros quadrados (cm²):</strong> Multiplica-se o valor em m² por 10.000.</p>
            <p><strong>De centímetros quadrados (cm²) para milímetros quadrados (mm²):</strong> Multiplica-se o valor em cm² por 100.</p>
            <p><strong>De decâmetro quadrado (dam²) para metros quadrados (m²):</strong> Multiplica-se o valor em dam² por 100.</p>
            <p><strong>De hectômetro quadrado (hm²) para metros quadrados (m²):</strong> Multiplica-se o valor em hm² por 10.000.</p>
            <p><strong>De decímetro quadrado (dm²) para metros quadrados (m²):</strong> Divide-se o valor em dm² por 100.</p>
        </div>
    </div>
</body>
</html>
