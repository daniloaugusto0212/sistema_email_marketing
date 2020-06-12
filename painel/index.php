<?php
    ini_set('max_execution_time','0'); //Tempo infinito para execução do script
    ini_set('memory_limit', '-1'); //Uso de memória sem limite

    ob_start();
    include('../config.php');

    if(Painel::logado() == false){
        include('login.php');
    }else{
        include('main.php');
    }

    ob_end_flush();
?>