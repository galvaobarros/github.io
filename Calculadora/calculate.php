<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe as horas do formulário
    $input_hours = isset($_POST["hours"]) ? $_POST["hours"] : 0;

    // Se desejar, você pode adicionar lógica para calcular o SLA aqui
    // Exemplo simples: SLA = horas inseridas * 2 (apenas para ilustração)
    $sla_hours = $input_hours * 2;

    // Exibe o resultado
    echo "SLA calculado: $sla_hours horas";
}
?>
