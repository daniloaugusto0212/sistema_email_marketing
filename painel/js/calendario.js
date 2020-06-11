$(function(){
    
    $('td[dia]').click(function(){
        $('td').removeClass('day-selected')
        $(this).addClass('day-selected')
        var novoDia = $(this).attr('dia').split('-')        
        switch (novoDia[1]) {
            case '1':
                var nomeMes = 'Janeiro';
                break;
    
            case '2':
                var nomeMes = 'Fevereiro';
                break;
    
            case '3':
                var nomeMes = 'Março';
            break;
    
            case "04":
                var nomeMes = 'Abril';
                break;
    
            case '5':
                var nomeMes = 'Maio';
                break;
    
            case '6':
                var nomeMes = 'Junho';
            break;
    
            case '7':
                var nomeMes = 'Julho';
                break;
    
            case '8':
                var nomeMes = 'Agosto';
                break;
    
            case '9':
                var nomeMes = 'Setembro';
                break;
    
            case '10':
                var nomeMes = 'Outubro';
                break;
    
            case '11':
                var nomeMes = 'Novembro';
                break;
    
            case '12':
                var nomeMes = 'Dezembro';
                break;
                                
        }  
        novoDia = novoDia[2] + ' de ' + nomeMes + ' de ' + novoDia[0]        
        trocarDatas($(this).attr('dia'), novoDia)
        aplicarEventos($(this).attr('dia'));
    })

    $('form').ajaxForm({
        dataType:'json',
        success:function(data){
            $('.box-alert').remove();
            $('form .card-title').after('<div class="box-alert sucesso">Evendo adicionado com sucesso!</div>')
            $('.box-tarefas .card-title').after('<div class="box-tarefas-single"><h2><i class="fas fa-rocket"></i>'+data.tarefa+' </h2></div>')
            $('form')[0].reset();
            
        }
    })

    function trocarDatas(nformatado, formatado) {
        $('input[name=data]').attr('value', nformatado)
        $('form .card-title').html('Adicionar tarefa para: '+ formatado)
        $('.box-tarefas .card-title').html('Tarefas de: '+ formatado)
    }

    function aplicarEventos(data) {
        $('.box-tarefas-single').remove()
        $.ajax({
            url: include_path+'ajax/calendario.php',
            method:'post',
            data:{'data':data, 'acao': 'puxar'}
        }).done(function (data) {
            $('.box-tarefas .card-title').after(data)
        })
    }
})