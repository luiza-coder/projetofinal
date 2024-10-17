<?php   
function converterVolume($numero, $unidadeOrigem, $unidadeDestino) {
    switch ($unidadeOrigem) {
        case 'quilômetros cúbicos':
            $metrosCubicos = $numero * 1e9; // 1 km³ = 1.000.000.000 m³
            break;
        case 'hectômetros cúbicos':
            $metrosCubicos = $numero * 1e6; // 1 hm³ = 1.000.000 m³
            break;
        case 'decâmetros cúbicos':
            $metrosCubicos = $numero * 1000; // 1 dam³ = 1.000 m³
            break;
        case 'metros cúbicos':
            $metrosCubicos = $numero;
            break;
        case 'decímetros cúbicos':
            $metrosCubicos = $numero / 1000; // 1 dm³ = 0.001 m³
            break;
        case 'centímetros cúbicos':
            $metrosCubicos = $numero / 1e6; // 1 cm³ = 0.000001 m³
            break;
        case 'milímetros cúbicos':
            $metrosCubicos = $numero / 1e9; // 1 mm³ = 0.000000001 m³
            break;
        default:
            return "Unidade de origem inválida.";
    }

    switch ($unidadeDestino) {
        case 'quilômetros cúbicos':
            return $metrosCubicos / 1e9;
        case 'hectômetros cúbicos':
            return $metrosCubicos / 1e6;
        case 'decâmetros cúbicos':
            return $metrosCubicos / 1000;
        case 'metros cúbicos':
            return $metrosCubicos;
        case 'decímetros cúbicos':
            return $metrosCubicos * 1000;
        case 'centímetros cúbicos':
            return $metrosCubicos * 1e6;
        case 'milímetros cúbicos':
            return $metrosCubicos * 1e9;
        default:
            return "Unidade de destino inválida.";
    }
}

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = trim($_POST['numero']);
    $unidadeOrigem = $_POST['unidadeOrigem'];
    $unidadeDestino = $_POST['unidadeDestino'];
    $resultado = converterVolume($numero, $unidadeOrigem, $unidadeDestino);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Volume</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-image: url('agua escura.jpg'); /* Use uma imagem de alta resolução */
            background-size: cover; /* Cobrir toda a área */
            background-position: center; /* Centralizar a imagem */
            color: #333;
            display: flex;
        }
        .container {
            flex: 1;
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.8); /* Fundo branco com transparência */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #3A5FCD;
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
            background: #3A5FCD;
        }
        h2 {
            text-align: center;
            color: #3A5FCD;
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
            background: rgba(255, 255, 255, 0.8); /* Fundo da barra lateral com transparência */
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
            background: #3A5FCD;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><b>Outros Conversores</b></h2>
        <div class="links">
            <a href="capacidade.php">Conversor de Capacidade</a>
            <a href="area.php">Conversor de Áreas</a>
            <a href="massa.php">Conversor de Massas</a>
            <a href="binario.php">Conversor de Bases</a>
        </div>
    </div>

    <div class="container">
        <h1><b>Conversor de Volume</b></h1>
        <form method="post">
            <input type="number" step="any" name="numero" placeholder="Digite o valor" required>
            <select name="unidadeOrigem" required>
                <option value="">Selecione</option>
                <option value="quilômetros cúbicos">Quilômetros Cúbicos</option>
                <option value="hectômetros cúbicos">Hectômetros Cúbicos</option>
                <option value="decâmetros cúbicos">Decâmetros Cúbicos</option>
                <option value="metros cúbicos">Metros Cúbicos</option>
                <option value="decímetros cúbicos">Decímetros Cúbicos</option>
                <option value="centímetros cúbicos">Centímetros Cúbicos</option>
                <option value="milímetros cúbicos">Milímetros Cúbicos</option>
            </select>
            <select name="unidadeDestino" required>
                <option value="">Selecione</option>
                <option value="quilômetros cúbicos">Quilômetros Cúbicos</option>
                <option value="hectômetros cúbicos">Hectômetros Cúbicos</option>
                <option value="decâmetros cúbicos">Decâmetros Cúbicos</option>
                <option value="metros cúbicos">Metros Cúbicos</option>
                <option value="decímetros cúbicos">Decímetros Cúbicos</option>
                <option value="centímetros cúbicos">Centímetros Cúbicos</option>
                <option value="milímetros cúbicos">Milímetros Cúbicos</option>
            </select>
            <button type="submit">Converter</button>
        </form>

        <?php if ($resultado !== null): ?>
            <h2>Resultado: <?php echo number_format($resultado, 2); ?> <?php echo $unidadeDestino; ?></h2>
        <?php endif; ?><br>

        <h2><b>Explicação sobre Conversão de Volume</b></h2>
        <div class="explicacao">
            <p>
                Para converter volumes, você deve primeiro entender que as unidades de volume são baseadas em potências de 10. 
                A unidade de referência é o metro cúbico (m³), que pode ser expandido ou reduzido para outras unidades cúbicas como 
                decâmetros cúbicos (dam³), centímetros cúbicos (cm³), e milímetros cúbicos (mm³).
            </p>
            <p>
                Para converter entre unidades, a ideia principal é trazer o valor de origem para metros cúbicos (m³) e, em seguida, convertê-lo
                para a unidade de destino. Por exemplo, se você deseja converter de quilômetros cúbicos (km³) para centímetros cúbicos (cm³), o processo
                é o seguinte:
            </p>
            <ol>
                <li>Converter quilômetros cúbicos (km³) para metros cúbicos (m³) multiplicando por 1.000.000.000 (ou 1e9).</li>
                <li>Depois, converter metros cúbicos para centímetros cúbicos (cm³) multiplicando o valor resultante por 1.000.000 (ou 1e6).</li>
            </ol>
            <p>
                Um exemplo prático: Se você tem 2 quilômetros cúbicos (km³) e deseja converter para centímetros cúbicos (cm³), o cálculo seria:
            </p>
            <pre>2 km³ * 1.000.000.000 = 2.000.000.000 m³</pre>
            <pre>2.000.000.000 m³ * 1.000.000 = 2.000.000.000.000.000 cm³</pre>
            <p>
                Esse conceito pode ser aplicado para qualquer conversão de volume dentro do sistema métrico, e o código PHP acima faz isso de forma automática, realizando as conversões com base nas unidades que você selecionar.
            </p>
        </div>
    </div>
</body>
</html>
