<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f7fa; /* Fundo cinza claro para um visual corporativo */
        }

        .calculator {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            border-left: 6px solid #4CAF50; /* Barra lateral verde para dar destaque */
        }

        h2 {
            color: #0E213F; /* Azul escuro */
            margin-bottom: 20px;
            font-size: 1.75rem; /* Aumenta o tamanho da fonte para maior legibilidade */
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
    <title>Calculadora de Diferença de Horário</title>
</head>
<body>
    <div class="calculator">
        <h2>Calculadora de Diferença de Horário</h2>
        <p class="description">
            Esta ferramenta ajuda a calcular de forma precisa o tempo que decorreu entre dois horários especificados. Útil para monitorar o tempo gasto em atividades ou processos com base em horários de início e fim.
        </p>

        <?php
        $difference = "";
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Função para converter o horário no formato HH:MM em minutos
            function timeToMinutes($time) {
                $parts = explode(':', $time);
                return ($parts[0] * 60) + $parts[1];
            }

            // Função para converter minutos em formato HH:MM
            function minutesToTime($minutes) {
                $hours = floor($minutes / 60);
                $mins = $minutes % 60;
                return sprintf('%02d:%02d', $hours, $mins);
            }

            $start_time = $_POST["start_time"];
            $end_time = $_POST["end_time"];

            // Verifica se os horários estão no formato correto
            if (preg_match('/^[0-9]{2}:[0-9]{2}$/', $start_time) && preg_match('/^[0-9]{2}:[0-9]{2}$/', $end_time)) {
                // Converte os horários para minutos
                $start_minutes = timeToMinutes($start_time);
                $end_minutes = timeToMinutes($end_time);

                // Calcula a diferença
                $diff_minutes = $end_minutes - $start_minutes;

                // Se a diferença for negativa, ajusta para o próximo dia
                if ($diff_minutes < 0) {
                    $diff_minutes += 24 * 60;
                }

                // Converte a diferença de volta para o formato HH:MM
                $difference = minutesToTime($diff_minutes);
            } else {
                $error = "Por favor, insira horários válidos no formato HH:MM.";
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="start_time">Hora Inicial (HH:MM):</label>
            <input type="text" name="start_time" id="start_time" placeholder="08:00" maxlength="5" pattern="[0-9]{2}:[0-9]{2}" oninput="autoInsertColon(this)" required>
            <label for="end_time">Hora Final (HH:MM):</label>
            <input type="text" name="end_time" id="end_time" placeholder="12:00" maxlength="5" pattern="[0-9]{2}:[0-9]{2}" oninput="autoInsertColon(this)" required>
            <button type="submit" name="calculate_diff">Calcular Diferença</button>
        </form>

        <?php if ($difference): ?>
            <div class="result">
                Diferença: <?php echo $difference; ?>
            </div>
        <?php elseif ($error): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

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
    </div>
</body>
</html>
