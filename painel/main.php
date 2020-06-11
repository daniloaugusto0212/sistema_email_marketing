<?php
    if(isset($_GET['logout'])){
        Painel::logout();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Painel de controle</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo INCLUDE_PATH; ?>estilo/font-awesome.css" rel="stylesheet"> <!--load all styles -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>estilo/font-awesome.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/jquery-ui.min.css">
    <!--Link para mascara de calendario. Usa-se juntamente com o script no final da código-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css">
</head>
<body>

<base base="<?php echo INCLUDE_PATH_PAINEL; ?>">
<div class="menu">
    <div class="menu-wraper">
        <div class="box-usuario">
        <?php
            if($_SESSION['img'] == ''){              
        ?>
            <div class="avatar-usuario">
                <i class="fa fa-user"></i>
            </div><!--avatar-usuario-->
        <?php }else{ ?>
            <div class="imagem-usuario">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img'];?>">
        <?php } ?>
        </div><!--imagem-usuario-->
            <div class="nome-usuario">
                <p><?php echo $_SESSION['nome']; ?></p>
                <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
            </div><!--nome-usuario-->        
        </div><!--box-usuario-->
    <div class="items-menu">
        <h2>Cadastro</h2>
        <a <?php selecionadoMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-depoimento">Cadastrar Depoimento</a>
        <a <?php selecionadoMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-servico">Cadastrar Serviço</a>
        <a <?php selecionadoMenu('cadastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-slides">Cadastrar Slides</a>
        <h2>Gestão</h2>
        <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-depoimentos">Listar Depoimentos</a>
        <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-servicos">Listar Serviços</a>
        <a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-slides">Listar Slides</a>
        <h2>Administração do Painel</h2>
        <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>editar-usuario">Editar Usuário</a>
        <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-usuario">Adicionar Usuário</a>
        <h2>Configuração Geral</h2>
        <a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>editar-site">Editar Site</a>
        <h2>Gestão de Notícias</h2>
        <a <?php selecionadoMenu('cadastrar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-categorias">Cadastrar Categorias</a>
        <a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-categorias">Gerenciar Categorias</a>
        <a <?php selecionadoMenu('cadastrar-noticia'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-noticia">Cadastrar Notícias</a>
        <a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-noticias">Gerenciar Notícias</a>
        <h2>Gestão de clientes</h2>
        <a <?php selecionadoMenu('cadastrar-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-clientes">Cadastrar Clientes</a>
        <a <?php selecionadoMenu('gerenciar-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-clientes">Gerenciar Clientes</a>
        <h2>Controle Financeiro</h2>       
        <a <?php selecionadoMenu('visualizar-pagamentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>visualizar-pagamentos">Visualizar Pagamentos</a>
        <h2>Controle de Estoque</h2>       
        <a <?php selecionadoMenu('cadastrar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-produtos">Cadastrar Produtos</a>
        <a <?php selecionadoMenu('visualizar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>visualizar-produtos">Visualizar Produtos</a>

        <h2>Gestão de Imóveis</h2>       
        <a <?php selecionadoMenu('cadastrar-empreendimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-empreendimento">Cadastrar Empreendimento</a>
        <a <?php selecionadoMenu('listar-empreendimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-empreendimentos">Listar Empreendimentos</a>

        <h2>Gestão EAD</h2>       
        <a <?php selecionadoMenu('novo-aluno'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>novo-aluno">Novo Aluno</a>
        <a <?php selecionadoMenu('novo-modulo'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>novo-modulo">Novo Módulo</a>
        <a <?php selecionadoMenu('nova-aula'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>nova-aula">Nova Aula</a>

        <h2>E-mail Marketing</h2>       
        <a <?php selecionadoMenu('gerenciar-lista'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-lista">Gerenciar Lista</a>
        <a <?php selecionadoMenu('gerenciar-contatos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-contatos">Gerenciar Contatos</a>
        <a <?php selecionadoMenu('criar-campanha'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>criar-campanha">Criar Campanha</a>
        
    </div><!--items-menu-->
    </div><!--menu-wraper-->
</div><!--menu-->

<header>
    <div class="center">
        <div class="menu-btn">
            <i class="fa fa-bars"></i>
        </div><!--menu-btn-->
       
        <div class="logout">
        <a <?php if (@$_GET['url'] == 'calendario'){?>style="background: #60727a;padding:15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>calendario"><i class="far fa-calendar"></i><span> Calendário</span>  </a>
        <a <?php if (@$_GET['url'] == 'chat'){?>style="background: #60727a;padding:15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>chat"><i class="far fa-comments"></i><span> Chat Online </span>  </a>
        <a <?php if (@$_GET['url'] == ''){?>style="background: #60727a;padding:15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fas fa-home"></i><span>Página Inicial </span>  </a>
            
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>?logout"><span>Sair </span><i class="fas fa-sign-out-alt"></i></a>
        </div><!--logout-->
        <div class="clear"></div><!--clear-->
    </div><!--center-->
</header>
<div class="content">

    <?php 

    Painel::carregarPagina();
    

    ?>

    
</div><!--content-->
<script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script> 
<!--Link para mascara de calendario. Usa-se juntamente com o link de estilo no inicio do código-->
<script  src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
<?php Painel::loadJS(array('jquery-ui.min.js'),'listar-empreendimentos'); ?>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.ajaxform.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.maskMoney.js"></script> 
<script src="<?php echo INCLUDE_PATH ?>js/constants.js"></script> 
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({
    selector:".tinymce",
    plugins: "image",
    height:300
    });</script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/helperMask.js" ></script>    
    <?php Painel::loadJS(array('ajax.js'),'gerenciar-clientes'); ?>
    <?php Painel::loadJS(array('ajax.js'),'cadastrar-clientes'); ?>
    <?php Painel::loadJS(array('ajax.js'),'gerenciar-pagamentos'); ?>
    <?php Painel::loadJS(array('ajax.js'),'editar-cliente'); ?>
    <?php Painel::loadJS(array('controleFinanceiro.js'),'editar-cliente'); ?> 
    <?php Painel::loadJS(array('controleFinanceiro.js'),'gerenciar-pagamentos'); ?>   
    <?php Painel::loadJS(array('empreendimentos.js'),'listar-empreendimentos'); ?>
    <?php Painel::loadJS(array('chat.js'),'chat'); ?>
    <?php Painel::loadJS(array('calendario.js'),'calendario'); ?>
</body>
</html>


