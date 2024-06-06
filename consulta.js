function limparDados() {
    location.reload();
}

function enviarDados() {

    $("#BtConsultar").hide();

    jQuery.extend( jQuery.fn.dataTableExt.oSort, {
        "date-br-pre": function ( a ) {
         if (a == null || a == "") {
          return 0;
         }
         var brDatea = a.split('/');
         return (brDatea[2] + brDatea[1] + brDatea[0]) * 1;
        },
       
        "date-br-asc": function ( a, b ) {
         return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },
       
        "date-br-desc": function ( a, b ) {
         return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
       } );

    var dt_inicial = $("#datepicker_inicial").val();
    var dt_final = $("#datepicker_final").val();
    var todos = $("#todos").val();
    var banco = $("#banco").val();
    var tempoInicio = new Date().getTime();
    var tabela = $('#tabela').DataTable({
        "processing": true,
        "serverSide": false,
        "debug": true,
        "destroy": true,
        "language": {
            url:"pt_br/pt_br.json"
          },
          columnDefs: [
            { type: 'date-br', targets: 3 }
   
          ],
          "order": [[3, 'desc' ]],
        "ajax": {
            "url": "consulta.php",
            "type": "POST",
            "data": {
                "dt_inicial": dt_inicial,
                "dt_final": dt_final,
                "todos": todos,
                "banco": banco
            },
        },
        "initComplete": function(settings, json) {
            var tempoFim = new Date().getTime();
            var tempoCarregamento = tempoFim - tempoInicio;
            var minutos = Math.floor(tempoCarregamento / 60000);
            var segundos = Math.floor((tempoCarregamento % 60000) / 1000);
            var milissegundos = tempoCarregamento % 1000;
            $('#tempoCarregamento').text("Tempo de Carregamento: " + minutos + " min(s) " + segundos + " segs " + milissegundos +" ms");
        },
        "columns": [
            { "data": "ticket_id" },
            { "data": "titulo" },
            { "data": "descricao" },
            { "data": "data_criacao_id" },
            { "data": "tipo_servico_id" },
            { "data": "prioridade" },
            { "data": "status_chamado" }
        ]
    });

    $('#consultaForm').on('submit', function(e) {
        e.preventDefault();
        $('#loading').show();
    });
}