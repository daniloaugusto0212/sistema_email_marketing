<?php
    $mes = isset($_GET['mes']) ? (int)$_GET['mes'] : date('m', time());
    $ano = isset($_GET['ano']) ? (int)$_GET['ano'] : date('Y', time());

    // $mes = date('m',time());
    // $ano = date('Y',time());

    if ($mes > 12) {
        $mes = 12;
    }
    if ($mes < 1) {
        $mes = 1;
    }

    $numeroDias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);    
    $diaInicialdoMes = date('N', strtotime("$ano-$mes-01"));
    $diaDeHoje = date('d',time());
    $diaDeHoje = "$ano-$mes-$diaDeHoje"; 
    switch ($mes) {
        case '1':
            $nomeMes = 'Janeiro';
            break;

        case '2':
            $nomeMes = 'Fevereiro';
            break;

        case '3':
            $nomeMes = 'Março';
        break;

        case '4':
            $nomeMes = 'Abril';
            break;

        case '5':
            $nomeMes = 'Maio';
            break;

        case '6':
            $nomeMes = 'Junho';
        break;

        case '7':
            $nomeMes = 'Julho';
            break;

        case '8':
            $nomeMes = 'Agosto';
            break;

        case '9':
            $nomeMes = 'Setembro';
            break;

        case '10':
            $nomeMes = 'Outubro';
            break;

        case '11':
            $nomeMes = 'Novembro';
            break;

        case '12':
            $nomeMes = 'Dezembro';
            break;
                            
    }  
      
   
?>
<div class="box-content">
    <h2><i class="far fa-calendar"></i> Calendário e Agenda | <strong><?php echo $nomeMes ?>/<?php echo $ano ?></strong>  <a class="posterior" href=""><p>>>>></p></a> <a class="anterior" href="<?php echo INCLUDE_PATH_PAINEL ?>calendario?"><p><<<<</p></a></h2>    
    
        
    
    

    <table class="calendario-table" >
        <tr>
            <td>Domingo</td>
            <td>Segunda</td>
            <td>Terça</td>            
            <td>Quarta</td>
            <td>Quinta</td>
            <td>Sexta</td>
            <td>Sábado</td>
        </tr>

        <?php
            $n = 1;
            $z = 0;
            $numeroDias+=$diaInicialdoMes;
            while ($n <= $numeroDias) {
                if ($diaInicialdoMes == 7 && $z != $diaInicialdoMes) {
                    $z = 7;
                    $n = 8;
                }
                if ($n % 7 == 1) {
                    echo '<tr>';
                }
                if ($z >= $diaInicialdoMes) {
                    $dia = $n - $diaInicialdoMes;
                    if ($dia < 10) {
                        $dia = str_pad($dia, strlen($dia)+1, "0", STR_PAD_LEFT);
                    }
                    $atual = "$ano-$mes-$dia";
                    if($atual != $diaDeHoje){
                        echo '<td dia="'.$atual.'" >'.$dia.'</td>';
                    }else{
                        echo '<td dia="'.$atual.'" class="day-selected">'.$dia.'</td>';
                    }
                }else{
                    echo "<td></td>";
                    $z++;
                }
                if ($n % 7 == 0) {
                    echo '</tr>';
                }
                $n++;
            }
        ?>
    </table>

    <form action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/calendario.php" method="post">
    <div class="card-title">Adicionar tarefa para: <?php echo $dia ?> de <?php echo $nomeMes ?> de <?php echo $ano ?></div>
        <input type="text" name="tarefa" required>
        <input type="hidden" name="data" value="<?php echo date('Y-m-d') ?>">
        <input type="hidden" name="acao" value="inserir">
        <input type="submit" value="Cadastrar!">
    </form>

    <div class="box-tarefas">
        <div class="card-title">Tarefas de: <?php echo $dia ?> de <?php echo $nomeMes ?> de <?php echo $ano ?></div>        
        <?php
          $pegarTarefas = MySql::conectar()->prepare("SELECT * FROM `tb_admin.agenda` WHERE data = '$diaDeHoje' ORDER BY id DESC");
          $pegarTarefas->execute();
          $pegarTarefas = $pegarTarefas->fetchAll();
          foreach ($pegarTarefas as $key => $value) {
                        
        ?>
        <div class="box-tarefas-single">
                <h2><i class="fas fa-rocket"></i> <?php echo $value['tarefa'] ?></h2>
        </div><!--box-tarefas-single-->
        <?php } ?>
        <div class="clear"></div>
    </div><!--box-taefas-->
    

 </div>   
    