<?php
function converterMassa($numero, $unidadeOrigem, $unidadeDestino) {
    // Converter o valor para gramas
    switch ($unidadeOrigem) {
        case 'g':
            $gramas = $numero;
            break;
        case 'kg':
            $gramas = $numero * 1000;
            break;
        case 'hg':
            $gramas = $numero * 100;
            break;
        case 'dag':
            $gramas = $numero * 10;
            break;
        case 'dg':
            $gramas = $numero / 10;
            break;
        case 'cg':
            $gramas = $numero / 100;
            break;
        case 'mg':
            $gramas = $numero / 1000;
            break;
        default:
            return "Unidade de origem inválida.";
    }

    // Converter gramas para a unidade desejada
    switch ($unidadeDestino) {
        case 'g':
            return $gramas;
        case 'kg':
            return $gramas / 1000;
        case 'hg':
            return $gramas / 100;
        case 'dag':
            return $gramas / 10;
        case 'dg':
            return $gramas * 10;
        case 'cg':
            return $gramas * 100;
        case 'mg':
            return $gramas * 1000;
        default:
            return "Unidade de destino inválida.";
    }
}

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = trim($_POST['numero']);
    $unidadeOrigem = $_POST['unidadeOrigem'];
    $unidadeDestino = $_POST['unidadeDestino'];
    $resultado = converterMassa($numero, $unidadeOrigem, $unidadeDestino);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Conversor de Massa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-image: url('massa.jpg'); /* Use uma imagem de alta resolução */
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
            color: #8B4500;
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
            background: #8B4500;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }
        button:hover {
            background: #8B4500;
        }
        h2 {
            text-align: center;
            color: #8B4500;
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
            background: #8B4500;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .links a:hover {
            background: #8B4500;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><b>Outros Conversores</b></h2>
        <div class="links">
            <a href="volume.php">Conversor de Volumes</a>
            <a href="area.php">Conversor de Áreas</a>
            <a href="capacidade.php">Conversor de Capacidade</a>
            <a href="binario.php">Conversor de Bases</a>
        </div>
    </div>

    <div class="container">
        <h1><b>Conversor de Massa</b></h1>
        <form method="post">
            <input type="number" step="any" name="numero" placeholder="Digite o valor" required>
            <select name="unidadeOrigem" required>
                <option value="">Selecione a unidade de origem</option>
                <option value="g">Grama (g)</option>
                <option value="kg">Quilograma (kg)</option>
                <option value="hg">Hectograma (hg)</option>
                <option value="dag">Decagrama (dag)</option>
                <option value="dg">Decigrama (dg)</option>
                <option value="cg">Centigrama (cg)</option>
                <option value="mg">Miligrama (mg)</option>
            </select>
            <select name="unidadeDestino" required>
                <option value="">Selecione a unidade de destino</option>
                <option value="g">Grama (g)</option>
                <option value="kg">Quilograma (kg)</option>
                <option value="hg">Hectograma (hg)</option>
                <option value="dag">Decagrama (dag)</option>
                <option value="dg">Decigrama (dg)</option>
                <option value="cg">Centigrama (cg)</option>
                <option value="mg">Miligrama (mg)</option>
            </select>
            <button type="submit">Converter</button>
        </form>

        <?php if ($resultado !== null): ?>
            <h2>Resultado: <?php echo number_format($resultado, 2); ?> <?php echo $unidadeDestino; ?></h2>
        <?php endif; ?>

        <div class="explicacao">
            <h2><b>Explicações de Conversão de Massa</b></h2>
            <p><strong>De quilograma (kg) para grama (g):</strong> Multiplica-se o valor em kg por 1.000, pois 1 kg equivale a 1.000 g.</p>
            <p><strong>De grama (g) para miligrama (mg):</strong> Multiplica-se o valor em g por 1.000, já que 1 g equivale a 1.000 mg.</p>
            <p><strong>De hectograma (hg) para grama (g):</strong> Multiplica-se o valor em hg por 100, pois 1 hg é igual a 100 g.</p>
            <p><strong>De decagrama (dag) para grama (g):</strong> Multiplica-se o valor em dag por 10, pois 1 dag equivale a 10 g.</p>
            <p><strong>De decigrama (dg) para grama (g):</strong> Divide-se o valor em dg por 10, já que 1 dg equivale a 0,1 g.</p>
            <p><strong>De centigrama (cg) para grama (g):</strong> Divide-se o valor em cg por 100, já que 1 cg é igual a 0,01 g.</p>
            <p><strong>De miligrama (mg) para grama (g):</strong> Divide-se o valor em mg por 1.000, pois 1 mg é igual a 0,001 g.</p>
        </div>
    </div>
</body>
</html>
