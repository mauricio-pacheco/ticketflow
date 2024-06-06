<!DOCTYPE html>
<html>
<head>
<script src="consulta.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
</head>
<body>
    <div class="container">
        <br>
        <h2>Análise de Consulta de Dados (SQL vs NoSQL)</h2>
        <br>
        <form id="consultaForm">
        <table>
            <thead>
                <tr>
                    <th><input type="text" id="datepicker_inicial" class="form-control" placeholder="Data Inicial" name="dt_inicial"></th>
                    <th><input type="text" id="datepicker_final" class="form-control" placeholder="Data Final" name="dt_final"></th>
                    <th><div style="width: 22px"></div></th>
                    <th>
                    <input class="form-check-input" type="checkbox" name="todos" value="todos" id="todos">
                    <label class="form-check-label">
                        Todos os Registros
                    </label>
                    </th>
                    <th><div style="width: 10px"></div></th>
                    <th>
                    <select class="form-select" name="banco" id="banco" class="form-control" style="height: 38px">
                    <option value="1">SQLite (SQL)</option>
                    <option value="2">MongoDB (NoSQL)</option>
                    </select>    
                    </th>
                    <th><button type="submit" class="btn btn-primary" id="BtConsultar" onclick="enviarDados()">Consultar</button></th>
                    <th><button type="submit" class="btn btn-primary" id="BtLimpar" style="" onclick="limparDados()">Limpar Dados</button></th>
                </tr>
            </thead>
        </table>
        </form>
        <br>
        <table id="tabela" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Data Criação</th>
                    <th>Tipo de Serviço</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    
        <div id="tempoCarregamento" style="font-weight: bold"></div>

        <p align="right"><i>Maurício Pacheco</i></p>
    </div>

    <script>
    $(document).ready(function() {
    $('#todos').on('change', function() {
        if ($(this).is(':checked')) {
            $('#datepicker_inicial').val(''); // Define o valor do campo de entrada como vazio
            $('#datepicker_final').val(''); // Define o valor do campo de entrada como vazio
        }
    });
    });
    $(document).ready(function() {
        $("#datepicker_inicial").datepicker({
        format: 'dd/mm/yyyy',    // Formato da data
        language: 'pt-BR',      // Idioma (português do Brasil)
        autoclose: true         // Fechar o datepicker ao selecionar uma data
        });
        $("#datepicker_final").datepicker({
        format: 'dd/mm/yyyy',    // Formato da data
        language: 'pt-BR',      // Idioma (português do Brasil)
        autoclose: true         // Fechar o datepicker ao selecionar uma data
        });    
    });
    </script>  
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    
</body>
</html>
