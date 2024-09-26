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
            background-color: #f4f4f4;
        }

        .menu {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .menu a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            border: 1px solid #007BFF;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #007BFF;
            color: #fff;
        }
    </style>
    <title>Menu Principal</title>
</head>
<body>
    <div class="menu">
        <h2>Escolha uma opção:</h2>
        <a href="sla_calculator.php">Calculadora SLA</a>
        <a href="time_difference_calculator.php">Calculadora de Diferença de Horário</a>
		<a href="hora_total.php">Calcular hora total</a>

    </div>
</body>
</html>
