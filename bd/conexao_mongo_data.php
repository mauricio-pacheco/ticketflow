<?php

// Conexão MongoDB
$mongoDbConnection = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Banco e Coleção
$database = "Tickets";
$collection = "tickets";

// ID a ser buscado
$searchId = "654fbbedfb72be6d96145562";

// Query para buscar os dados da coleção com o ID específico
$query = new MongoDB\Driver\Query(['_id' => new MongoDB\BSON\ObjectID($searchId)]);
$cursor = $mongoDbConnection->executeQuery("$database.$collection", $query);

// Inicializa o array e guarda os resultados
$results = ['data' => []];

foreach ($cursor as $document) {
    $data = $document->data;

    foreach ($data as $ticket) {
        $result = [
            'ticket_id' => $ticket->ticket_id,
            'titulo' => $ticket->titulo,
            'descricao' => $ticket->descricao,
            'data_criacao_id_pt_br' => ($ticket->data_criacao_id) ? date('Y-m-d', strtotime(str_replace('/', '-', $ticket->data_criacao_id))) : "N/A",
            'data_criacao_id' => ($ticket->data_criacao_id) ? date('d/m/Y', strtotime(str_replace('/', '-', $ticket->data_criacao_id))) : "N/A",
            'tipo_servico_id' => $ticket->tipo_servico_id,
            'prioridade' => $ticket->prioridade,
            'status_chamado' => $ticket->status_chamado,
        ];

        $results['data'][] = $result;
    }
}

// Filtro no resultado final do JSON entre as datas 01/01/2020 a 31/12/2023
$filteredResults = ['data' => []];
$startDate = strtotime($dt_inicial);
$endDate = strtotime($dt_final);

foreach ($results['data'] as $result) {
    $ticketDate = strtotime($result['data_criacao_id']);
    if ($ticketDate >= $startDate && $ticketDate <= $endDate) {
        $filteredResults['data'][] = $result;
    }
}

$jsonData = json_encode($filteredResults, JSON_PRETTY_PRINT);

echo $jsonData;
?>
