<?php

//Mostrar erros no navegador
//error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
    // Conexão com o banco de dados SQLite
    $db = new SQLite3('../bd/tickets.db');

    // Número total de registros a serem inseridos
    $total_registros = 60000;

    // Número de registros a serem inseridos em cada lote
    $tamanho_lote = 1000; // Pode ajustar conforme necessário

    //Inserir os Tipos de Serviço
    $sql = "INSERT INTO Tipos_de_Servico (tipo_servico_id, nome) VALUES (1, 'Suporte Técnico')";
    $db->exec($sql);

    $sql = "INSERT INTO Tipos_de_Servico (tipo_servico_id, nome) VALUES (2, 'Atendimento ao Cliente')";
    $db->exec($sql);

    $sql = "INSERT INTO Tipos_de_Servico (tipo_servico_id, nome) VALUES (3, 'Assistência Financeira')";
    $db->exec($sql);

    $sql = "INSERT INTO Tipos_de_Servico (tipo_servico_id, nome) VALUES (4, 'Suporte a Vendas')";
    $db->exec($sql);

    // Array de tipos de serviço para seleção aleatória
    $tipos_de_servico = array("Suporte Técnico", "Atendimento ao Cliente", "Assistência Financeira", "Suporte a Vendas");

    // Array de prioridades para seleção aleatória
    $prioridades = array("Alta", "Média", "Baixa");

    // Iniciar transação
    $db->exec('BEGIN');

    //Iniciar Contador
    $contador = 0;

    // Loop para inserir dados em lotes
    for ($i = 1; $i <= $total_registros; $i++) {

        $contador++;

        // Gere uma data aleatória no formato 'YYYY-MM-DD'
        $data_aleatoria = date("Y-m-d", mt_rand(strtotime("2000-01-01"), strtotime("2023-12-31")));

        // Selecione aleatoriamente um tipo de serviço
        $tipo_servico_aleatorio = $tipos_de_servico[array_rand($tipos_de_servico)];

        // Selecione aleatoriamente uma prioridade
        $prioridade_aleatoria = $prioridades[array_rand($prioridades)];

        // Inserir dados na tabela "Data"
        $sql = "INSERT INTO Data (data) VALUES ('$data_aleatoria')";
        $db->exec($sql);

        // Obtém o ID da data inserida
        $data_id = $db->lastInsertRowID();

        // Inserir dados na tabela "Tickets"
        $titulo = "Ticket #" . $i;
        $descricao = "Descrição do Ticket #" . $i;
        $tipo_servico_id = rand(1, count($tipos_de_servico));
        $prioridade = $prioridade_aleatoria;
      
        //Status do Ticket
        $numero_aleatorio = rand(1, 3);

        if($numero_aleatorio==1) {
            $status = 'Aberto';
        } else if($numero_aleatorio==2) {
            $status = 'Em Andamento';
        } else if($numero_aleatorio==3) {
            $status = 'Fechado';
        }


        $sql = "INSERT INTO Tickets (titulo, descricao, data_criacao_id, tipo_servico_id, prioridade, status_chamado)
                VALUES ('$titulo', '$descricao', $data_id, $tipo_servico_id, '$prioridade', '$status')";
        $db->exec($sql);

        // Inserir dados na tabela "Clientes" (simulando uma associação aleatória)
        $cliente_id = rand(1, 1000); // Suponha que existam 1000 clientes
        $cliente_nome = "Cliente #" . $cliente_id;

        $sql = "INSERT INTO Clientes (cliente_id, nome, email, telefone) VALUES ($cliente_id, '$cliente_nome', 'teste@teste.com.br', '559999999')";
        $db->exec($sql);

        // Inserir dados na tabela "Funcionários" (simulando uma associação aleatória)
        $funcionario_id = rand(1, 100); // Suponha que existam 100 funcionários
        $funcionario_nome = "Funcionário #" . $funcionario_id;

        $sql = "INSERT INTO Funcionarios (funcionario_id, nome, email) VALUES ($funcionario_id, '$funcionario_nome', 'teste@teste.com.br')";
        $db->exec($sql);

        // Inserir dados na tabela "Comentarios" (exemplo de um comentário por ticket)
        $comentario = "Comentário para o Ticket #" . $i;

        $sql = "INSERT INTO Comentarios (texto, data_criacao_id, ticket_id, funcionario_id)
                VALUES ('$comentario', $data_id, $i, $funcionario_id)";
        $db->exec($sql);

        // Commit da transação a cada lote
        if ($i % $tamanho_lote === 0) {
            $db->exec('COMMIT');
            $db->exec('BEGIN');
        }

        echo $contador;
        echo "<br>";

    }

    // Commit final
    $db->exec('COMMIT');

    echo "Registros inseridos com sucesso.";

    // Fechar a conexão com o banco de dados
    $db->close();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
