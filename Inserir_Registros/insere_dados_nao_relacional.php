<?php


// Função para gerar uma string aleatória para o ID
function generateRandomId() {
    return bin2hex(random_bytes(12));
}

// Função para gerar uma data aleatória
function generateRandomDate() {
    $startDate = strtotime('2000-01-01');
    $endDate = strtotime('2023-12-31');
    
    $randomTimestamp = mt_rand($startDate, $endDate);

    return date("Y-m-d", $randomTimestamp);
}

// Função para gerar um objeto de ticket aleatório
function generateRandomTicket() {

    // Array com as 4 strings
    $categorias = ["Suporte Técnico", "Atendimento ao Cliente", "Assistência Financeira", "Suporte a Vendas"];

    // Embaralhar as strings
    shuffle($categorias);
    $categoriaAleatoria = reset($categorias);

    // Array com as 3 strings
    $prioridades = ["Baixa", "Média", "Alta",];
    
    // Embaralhar as strings
    shuffle($prioridades);
    $prioridadesAleatoria = reset($prioridades);

    // Array com as 3 strings
    $status = ["Fechado", "Em Andamento", "Aberto",];
    
    // Embaralhar as strings
    shuffle($status);
    $statusAleatoria = reset($status);

    return [
        "ticket_id" => generateRandomId(),
        "titulo" => "Ticket #" . mt_rand(1, 100000),
        "descricao" => "Descrição do Ticket #" . mt_rand(1, 100000),
        "data_criacao_id" => generateRandomDate(),
        "tipo_servico_id" => $categoriaAleatoria,
        "prioridade" => $prioridadesAleatoria,
        "status_chamado" => $statusAleatoria
    ];
}

// Número de objetos a serem adicionados
$numObjects = 59999;

// Carrega o JSON original
$json = '[
    {
        "_id": {
            "$oid": "654fbbedfb72be6d96145562"
        },
        "data": [
            {
                "ticket_id": "654b8e98f7b8a6c8fb404403",
                "titulo": "Ticket #654b8e98f7b8a6c8fb404403",
                "descricao": "teste 1",
                "data_criacao_id": {
                    "$date": "1970-01-01T00:00:00.000Z"
                },
                "tipo_servico_id": "Atendimento",
                "prioridade": null,
                "status_chamado": null
            }
        ]
    }
]';

// Converte o JSON para um array associativo
$data = json_decode($json, true);

// Adiciona novos objetos randomicos
for ($i = 0; $i < $numObjects; $i++) {
    $data[0]["data"][] = generateRandomTicket();
}

// Converte o array associativo de volta para JSON
$newJson = json_encode($data, JSON_PRETTY_PRINT);

// Salva o novo JSON em um arquivo
file_put_contents('novo_arquivo.json', $newJson);

echo "Script concluído. Novo arquivo gerado: novo_arquivo.json\n";
?>
