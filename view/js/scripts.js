$(window).on('load', function() {
    url = window.origin + '/testeBdr/';
    
    function listarTarefas() {
        $.ajax({
            type: 'GET',
            dataType: "json",
            cache: false,
            contentType:"application/json",    
            url: url + 'tarefas',
            success: function(data) {
                conteudo = '';
                if(data) {
                    $('#listarTarefas').html('');
                    count = 1;
                    
                    data.map(function (e) {
                        conteudo += '<tr>';
                        conteudo += '<td>' + count + '</td>';
                        conteudo += '<td>' + e.titulo + '</td>';
                        conteudo += '<td>' + e.descricao + '</td>';
                        conteudo += '<td>' + e.prioridade + '</td>';
                        conteudo += '<td class="text-right"><button type="button" data-tarefa="' + e.id + '" class="btn btn-warning mr-1 BtnAlterar" data-toggle="modal" data-target="#alterar">Alterar</button>';
                        conteudo += '<button type="button" data-tarefa="' + e.id + '" class="btn btn-danger BtnExcluir">Excluir</button></td>';
                        conteudo += '<tr>';
                        
                        count++;
                    });
                }
                if(conteudo == '') {
                    conteudo = '<tr><td colspan="4">Não há tarefas para listar.</td></tr>';
                }
                $('#listarTarefas').append(conteudo);
            }
        });
    }
    listarTarefas();
    
    $(document).on('click', '.cadastrarTarefa', function() {
        
        data = {'titulo': $('#titulo').val(),
                'descricao': $('#descricao').val(),
                'prioridade': $('#prioridade').val()}
        
        $.ajax({
            type: 'POST',
            dataType: "json",
            cache: false,
            contentType:"application/json",    
            url: url + 'tarefas',
            data: JSON.stringify(data),
            success: function(data) {
                if(data) {
                    listarTarefas();
                    $('#titulo').val('');
                    $('#descricao').val('');
                    $('#prioridade').val('');
                    $('#cadastrar').modal('hide');
                }
            }
        });
    });
    
    $(document).on('click', '.BtnAlterar', function() {
        id = $(this).attr('data-tarefa');
        console.log(id);
        $.ajax({
            type: 'GET',
            dataType: "json",
            cache: false,
            contentType:"application/json",    
            url: url + 'tarefa/' + id,
            success: function(data) {
                
                if(data) {
                    $('#idTarefa').val(data.id);
                    
                    $('#tituloAlterar').val(data.titulo);
                    $('#descricaoAlterar').val(data.descricao);
                    $('#prioridadeAlterar').val(data.prioridade);
                }
            }
        });
    });
    
    $(document).on('click', '.salvarAlteracao', function() {
        id = $('#idTarefa').val();
        
        data = {'titulo': $('#tituloAlterar').val(),
                'descricao': $('#descricaoAlterar').val(),
                'prioridade': $('#prioridadeAlterar').val()}
        
        $.ajax({
            type: 'PUT',
            dataType: "json",
            cache: false,
            contentType:"application/json",    
            url: url + 'tarefas/' + id,
            data: JSON.stringify(data),
            success: function(data) {
                if(data) {
                    listarTarefas();
                    $('#alterar').modal('hide');
                }
            }
        });
    });
    
    $(document).on('click', '.BtnExcluir', function() {
        id = $(this).attr('data-tarefa');
        
        $.ajax({
            type: 'DELETE',
            dataType: "json",
            cache: false,
            contentType:"application/json",    
            url: url + 'tarefas/' + id,
            success: function() {
                listarTarefas();
            }
        });
    });
});