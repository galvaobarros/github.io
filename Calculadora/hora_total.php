<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de SLA - VERT Analytics</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .sla-calculator {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            border-left: 6px solid #4CAF50; /* Barra lateral verde */
        }

        h2 {
            color: #0E213F; /* Azul escuro */
            margin-bottom: 20px;
            font-size: 1.75rem;
        }

        p.description {
            color: #555;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        button {
            padding: 12px;
            background-color: #4CAF50; /* Verde */
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f4f8;
            border-radius: 6px;
            text-align: center;
            font-size: 1.3rem;
            color: #0E213F;
            border-left: 6px solid #4CAF50;
        }

        .error {
            color: #FF0000;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<?php
// Função para calcular o percentual de SLA preenchido
function calcularSLA($totalHorasSLA, $horasCorridas) {
    // Extrai as horas e minutos do formato hh:mm
    $horasMinutos = explode(':', $horasCorridas);

    // Se o formato não estiver correto, define horas e minutos como 0
    $horas = isset($horasMinutos[0]) ? intval($horasMinutos[0]) : 0;
    $minutos = isset($horasMinutos[1]) ? intval($horasMinutos[1]) : 0;

    // Converte as horas e minutos para minutos totais
    $horasCorridas = $horas + ($minutos / 60);

    // Verifica se as horas corridas não ultrapassam o total de horas do SLA
    $horasCorridas = min($horasCorridas, $totalHorasSLA);

    // Calcula o percentual de SLA preenchido
    $percentualSLA = ($horasCorridas / $totalHorasSLA) * 100;

    return $percentualSLA;
}

// Inicializa as variáveis
$totalHorasSLA = 0;
$horasCorridas = '';
$percentualSLA = 0;

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores do formulário
    $totalHorasSLA = isset($_POST["totalHorasSLA"]) ? intval($_POST["totalHorasSLA"]) : 0;
    $horasCorridas = isset($_POST["horasCorridas"]) ? $_POST["horasCorridas"] : '';

    // Calcula o percentual de SLA preenchido usando a função
    $percentualSLA = calcularSLA($totalHorasSLA, $horasCorridas);
}
?>

<div class="sla-calculator">
    <h2>Calculadora de SLA</h2>
    <p class="description">
        Esta calculadora ajuda a calcular com precisão a porcentagem do SLA (Service Level Agreement) com base no tempo corrido em relação às horas contratadas. 
        Útil para verificar o cumprimento do SLA acordado em contratos de serviços.
    </p>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="totalHorasSLA">Digite o total de horas do SLA:</label>
        <input type="number" name="totalHorasSLA" id="totalHorasSLA" value="<?php echo $totalHorasSLA; ?>" required>

        <label for="horasCorridas">Digite as horas corridas (hh:mm):</label>
        <input type="text" name="horasCorridas" id="horasCorridas" placeholder="hh:mm" value="<?php echo $horasCorridas; ?>" maxlength="5" pattern="[0-9]{2}:[0-9]{2}" oninput="autoInsertColon(this)" required>

        <button type="submit">Calcular SLA</button>
    </form>

    <script>
        function autoInsertColon(input) {
            if (input.value.length === 2 && !input.value.includes(':')) {
                input.value += ':';
            }
            input.value = input.value.replace(/[^\d:]/g, '');
            if (input.value.length > 5) {
                input.value = input.value.substring(0, 5);
            }
        }
    </script>

    <?php
    // Exibe o resultado se o formulário foi enviado
    if ($percentualSLA > 0) {
        echo "<div class='result'>Percentual de SLA preenchido: " . number_format($percentualSLA, 2) . "%</div>";
    }
    ?>
</div>

</body>
</html>
