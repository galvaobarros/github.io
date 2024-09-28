<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f9f9f9;
        }

        .calculator {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #0E213F; /* Azul escuro */
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        button {
            padding: 12px;
            background-color: #4CAF50; /* Verde do tema */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            width: 48%;
            margin-right: 4%;
        }

        .reset-button {
            background-color: #DC3545;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f4f8;
            border-radius: 4px;
            text-align: center;
            font-size: 1.2rem;
            color: #0E213F;
        }

        .info {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #666;
            background-color: #e9f4ff;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
    </style>
    <title>Calculadora SLA</title>
</head>
<body>
    <div class="calculator">
        <h2>Calculadora SLA</h2>

        <?php
        session_start();

        // Inicializa o total acumulado se não existir na sessão
        if (!isset($_SESSION['total_sla_minutes'])) {
            $_SESSION['total_sla_minutes'] = 0;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["calculate"])) {
                // Recebe o tempo do formulário
                $input_time = isset($_POST["time"]) ? $_POST["time"] : '';

                if (!empty($input_time)) {
                    // Extrai horas e minutos
                    $time_parts = explode(':', $input_time);

                    // Verifica se há horas e minutos definidos
                    $input_hours = isset($time_parts[0]) ? intval($time_parts[0]) : 0;
                    $input_minutes = isset($time_parts[1]) ? intval($time_parts[1]) : 0;

                    // Converte tudo para minutos e acumula
                    $_SESSION['total_sla_minutes'] += $input_hours * 60 + $input_minutes;
                }
            } elseif (isset($_POST["reset"])) {
                // Limpa o total de horas
                $_SESSION['total_sla_minutes'] = 0;
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="time">Insira o tempo (HH:MM):</label>
            <input type="text" name="time" id="time" placeholder="00:00" maxlength="5" pattern="[0-9]{2}:[0-9]{2}" oninput="autoInsertColon(this)">
            <div style="display: flex; justify-content: space-between;">
                <button type="submit" name="calculate">Calcular</button>
                <button type="submit" class="reset-button" name="reset">Limpar</button>
            </div>
        </form>

        <div class="result">
            SLA acumulado: <?php echo sprintf("%02d:%02d", floor($_SESSION['total_sla_minutes'] / 60), $_SESSION['total_sla_minutes'] % 60); ?>
        </div>

        <div class="info">
            Esta calculadora serve para acumular o tempo entre cada nota de chamado. Posteriormente, você pode calcular o total na aba "Calcular Hora Total".
        </div>

        <script>
            function autoInsertColon(input) {
                // Adiciona ':' após 2 números
                if (input.value.length === 2 && !input.value.includes(':')) {
                    input.value += ':';
                }
            }
        </script>
    </div>
</body>
</html>
