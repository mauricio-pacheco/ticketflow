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
            'data_criacao_id_pt_br' => ($ticket->data_criacao_id) ? date('Y-m-d', strtotime($ticket->data_criacao_id->{'$date'})) : "N/A",
            'data_criacao_id' => $ticket->data_criacao_id,
            'tipo_servico_id' => $ticket->tipo_servico_id,
            'prioridade' => $ticket->prioridade,
            'status_chamado' => $ticket->status_chamado,
        ];

        // Inverte a data
        if ($result['data_criacao_id']) {
            $result['data_criacao_id'] = date('d/m/Y', strtotime($ticket->data_criacao_id));
        }

        $results['data'][] = $result;
    }
}

$jsonData = json_encode($results, JSON_PRETTY_PRINT);

echo $jsonData;
?>
