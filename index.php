<?php
function converter($numero, $baseOrigem, $baseDestino) {
    switch ($baseOrigem) {
        case 'decimal':
            $decimal = $numero;
            break;
        case 'binario':
            $decimal = bindec($numero);
            break;
        case 'octal':
            $decimal = octdec($numero);
            break;
        case 'hexadecimal':
            $decimal = hexdec($numero);
            break;
        default:
            return "Base de origem inválida.";
    }

    switch ($baseDestino) {
        case 'decimal':
            return $decimal;
        case 'binario':
            return decbin($decimal);
        case 'octal':
            return decoct($decimal);
        case 'hexadecimal':
            return strtoupper(dechex($decimal));
        default:
            return "Base de destino inválida.";
    }
}

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = trim($_POST['numero']);
    $baseOrigem = $_POST['baseOrigem'];
    $baseDestino = $_POST['baseDestino'];
    $resultado = converter($numero, $baseOrigem, $baseDestino);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Conversor de Bases Numéricas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
           background-image: url('binario.jpg'); /* Use uma imagem de alta resolução */
            background-size: cover;
            background-position: center;
            color: #333;
            display: flex;
        }
        .container {
            flex: 1;
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .sidebar {
            width: 300px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin-right: 23px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #006400;
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
            background: #006400;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }
        button:hover {
            background: #006400;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .explicacao {
            margin: 20px auto;
            padding: 20px;
            color: #333;
            font-size: 16px;
            line-height: 1.5;
            text-align: justify;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px;
            background: #006400;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .links a:hover {
            background: #0056b3;
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
            <a href="volume.php">Conversor de Volumes</a>
        </div>
    </div>
    <div class="container">
        <h1><b>Conversor de Bases</b></h1>
        <form method="post">
            <input type="text" name="numero" placeholder="Digite o número" required>
            <select name="baseOrigem" required>
                <option value="">Selecione a base de origem</option>
                <option value="decimal">Decimal</option>
                <option value="binario">Binário</option>
                <option value="octal">Octal</option>
                <option value="hexadecimal">Hexadecimal</option>
            </select>
            <select name="baseDestino" required>
                <option value="">Selecione a base de destino</option>
                <option value="decimal">Decimal</option>
                <option value="binario">Binário</option>
                <option value="octal">Octal</option>
                <option value="hexadecimal">Hexadecimal</option>
            </select>
            <button type="submit">Converter</button>
        </form>

        <?php if ($resultado !== null): ?>
            <h2>Resultado: <?php echo $resultado; ?></h2>
        <?php endif; ?>

        <div class="explicacao">
            <h2><b>Explicações de Conversão</b></h2>
            <p><strong>Decimal para Binário:</strong> Divida o número decimal sucessivamente por 2, anotando o resto de cada divisão. O número binário será formado pelos restos de baixo para cima.</p>
            <p><strong>Binário para Decimal:</strong> Multiplique cada dígito do número binário pelo valor da potência de 2 correspondente, da direita para a esquerda, e some os resultados.</p>
            <p><strong>Decimal para Octal:</strong> Divida o número decimal sucessivamente por 8, anotando o resto de cada divisão. O número octal será formado pelos restos de baixo para cima.</p>
            <p><strong>Octal para Decimal:</strong> Multiplique cada dígito do número octal pelo valor da potência de 8 correspondente, da direita para a esquerda, e some os resultados.</p>
            <p><strong>Decimal para Hexadecimal:</strong> Divida o número decimal sucessivamente por 16, anotando o resto de cada divisão. Os restos são convertidos para os dígitos hexadecimais correspondentes (0-9, A-F).</p>
            <p><strong>Hexadecimal para Decimal:</strong> Multiplique cada dígito hexadecimal pelo valor da potência de 16 correspondente, da direita para a esquerda, e some os resultados.</p>
            <p><strong>Binário para Octal ou Hexadecimal:</strong> Primeiro, converta o número binário para decimal e depois de decimal para octal ou hexadecimal, conforme necessário.</p>
        </div>
    </div>
</body>
</html>
