<?php

// Conexão com o Banco SQLite
$database = new SQLite3('bd/tickets.db');

// Função Inverter a Data
function inverteData($data){
    if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    } elseif (count(explode("-",$data)) > 1) {
        return implode("/",array_reverse(explode("-",$data)));
    }
}

// Filtros de busca
$dt_inicial = inverteData($_POST['dt_inicial']);
$dt_final = inverteData($_POST['dt_final']);
$todos_registros = $_POST['todos'];
$banco = $_POST['banco'];

if($banco==1) {

if($dt_inicial=='' and $dt_final=='') {

// Consulta todos os Registros
$query = "SELECT
A.ticket_id,
A.titulo,
A.descricao,
B.data AS data_criacao_id_pt_br,
strftime('%d/%m/%Y', B.data) AS data_criacao_id,
C.nome AS tipo_servico_id,
A.prioridade,
A.status_chamado
FROM Tickets A, Data B, Tipos_de_Servico C
WHERE A.data_criacao_id = B.data_id AND A.tipo_servico_id = C.tipo_servico_id";

} else {

// Consulta todos entre datas
$query = "SELECT
A.ticket_id,
A.titulo,
A.descricao,
B.data AS data_criacao_id_pt_br,
strftime('%d/%m/%Y', B.data) AS data_criacao_id,
C.nome AS tipo_servico_id,
A.prioridade,
A.status_chamado
FROM Tickets A, Data B, Tipos_de_Servico C
WHERE A.data_criacao_id = B.data_id AND A.tipo_servico_id = C.tipo_servico_id AND B.data BETWEEN '$dt_inicial' AND '$dt_final'";

}

$result = $database->query($query);

$data = array();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $data[] = $row;
}

$response = array(
    "data" => $data,
    "execution_time" => $execution_time
);

echo json_encode($response);


} else {

if($dt_inicial=='' and $dt_final=='') {

include("bd/conexao_mongo.php");

} else {

include("bd/conexao_mongo_data.php");

}

}

?>
