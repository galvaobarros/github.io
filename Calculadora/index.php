<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Estilização do menu */
        .menu {
            background-color: #0E213F; /* Azul escuro do tema */
            width: 20%;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        /* Logo dentro do menu */
        .menu img {
            max-width: 80%;
            margin-bottom: 20px;
        }

        .menu h2 {
            color: #4CAF50; /* Verde do texto "VERT" */
            font-size: 1.5rem;
            margin-bottom: 20px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }

        .menu a {
            display: block;
            padding: 12px 0;
            margin: 10px 0;
            text-decoration: none;
            font-size: 1.1rem;
            color: #fff;
            background-color: #4CAF50;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color: #388E3C; /* Verde escuro ao passar o mouse */
        }

        .content {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        /* Layout responsivo */
        @media (max-width: 768px) {
            .menu {
                width: 30%;
            }
        }

        @media (max-width: 480px) {
            .menu {
                width: 40%;
            }

            .menu a {
                font-size: 1rem;
            }
        }

    </style>
    <title>Calculadora SLA - Menu</title>
</head>
<body>

    <div class="menu">
        <!-- Incorporação da logo (ajuste o caminho da imagem) -->
        <img src="Logo/logo_vert.png" alt="Logo da Vert Analytics">

        <h2>Menu</h2>
        <a href="#" onclick="loadPage('sla_calculator.php')">Somar Horas</a>
        <a href="#" onclick="loadPage('time_difference_calculator.php')">Calculadora de Diferença de Horário</a>
        <a href="#" onclick="loadPage('hora_total.php')">Calcular Total de SLA</a>
    </div>

    <div class="content">
        <iframe id="calculatorFrame" src="sla_calculator.php"></iframe>
    </div>

    <script>
        function loadPage(page) {
            document.getElementById('calculatorFrame').src = page;
        }
    </script>

</body>
</html>
