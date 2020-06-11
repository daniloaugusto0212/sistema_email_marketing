<?php
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $cliente = Painel::select('tb_admin.clientes','id = ?',array($id));    
    }else{
        Painel::alert('erro','Você precisa passar o parametro ID.');
        die();
    }

    $clienteNome = MySql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $id ");
    $clienteNome->execute();
    $clienteNome =$clienteNome->fetch()['nome'];
?>
<div class="box-content">
<h2><i class="fas fa-user-edit"></i>Pagamentos de <b><?php echo $clienteNome; ?></b> </h2><br>
<?php
    if (isset($_GET['email'])) {
        //Queremos enviar um e-amil avisando o atraso
        $parcela_id = (int)$_GET['parcela'];
        $cliente_id = (int)$_GET['email'];
        if (isset($_COOKIE['cliente_'.$cliente_id])) {
            //Não enviar o e-mail, apos já foi enviado
            Painel::alert('erro', 'Você já enviou um e-mail cobrando desse cliente! Enviar somente 7 dias após o envio anterior.');
        }else{
            //podemos enviar o e-mail
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE id = $parcela_id");
            $sql->execute();
            $infoFinanceiro = $sql->fetch();
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.clientes` WHERE id = $cliente_id");
            $sql->execute();
            $infoCliente = $sql->fetch();
            $corpoEmail = "Olá $infoCliente[nome], você está com um saldo pendente de $infoFinanceiro[valor] com o vencimento em $infoFinanceiro[vencimento]. Entre em contato para quitar sua parcela!";
            $email = new Email('smtp.hostinger.com.br','contato@dansol.com.br', '681015', 'Danilo');
            $email->addAdress($infoCliente['email'],$infoCliente['nome']);
            $email->formatarEmail(array('assunto'=>'Cobrança', 'corpo'=>$corpoEmail));
            $email->enviarEmail();
            Painel::alert('sucesso', "E-mail enviado com sucesso!");
            setcookie('cliente_'.$cliente_id,'true',time()+(60*60*24*7),'/');
        }
    }
    
    if(isset($_GET['pago'])){
        $hoje = date('Y-m-d');
        $sql = MySql::conectar()->prepare("UPDATE `tb_admin.financeiro` SET status = 1, pago = ? WHERE id = ?");        
        $sql->execute(array($hoje,$_GET['pago']));       
        Painel::alert('sucesso','O pagamento foi quitado com sucesso!');
        
    }
?>  

   
<h2><i class="fas fa-money-check-alt"></i> Pendentes</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome do pagamento</td>               
                <td>Cliente</td>
                <td>Valor</td>
                <td>Vencimento</td>
                <td>Enviar e-mail</td>
                <td>Marcar Pago</td>
            </tr>

            <?php
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 0 AND cliente_id = $id ORDER BY vencimento ASC");
                $sql->execute();
                $pendentes = $sql->fetchAll();

                foreach ($pendentes as $key => $value) {
                    $clienteNome = MySql::conectar()->prepare("SELECT `nome`,`id` FROM `tb_admin.clientes` WHERE id = $value[cliente_id] ");
                    $clienteNome->execute();
                    $info = $clienteNome->fetch();
                    $clienteNome = $info['nome'];
                    $idCliente = $info['id'].
                    $style ="";
                    if (strtotime(date('Y-m-d')) >= strtotime($value['vencimento'])) {
                        $style = 'style="background:#ff7070;font-weight:bold;"';
                    }
                    ?>
                <tr <?php echo $style; ?> >
                    <td> <?php echo $value['nome'];?> </td>
                    <td> <?php echo $clienteNome;?> </td>
                    <td><?php echo $value['valor'];?></td>
                    <td><?php echo date('d/m/Y',strtotime($value['vencimento']));?></td>
                    <td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-pagamentos?id=<?php echo $value['id'] ?>&email=<?php echo $info['id'];?>&parcela=<?php echo $value['id']; ?>"><i class="fa fa-envelope" ></i> Email</a></td>
                    <td><a style="background:#00bfa5;" class="btn"  href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-pagamentos?id=<?php echo $idCliente ?>&pago=<?php echo $value['id'];?>"><i class="fa fa-check"></i> Pago</a></td>
                    
                </tr>
                <?php } ?>
            

            
        </table>
    </div><!--wraper-table-->
    

    <h2><i class="fas fa-money-check-alt"></i> Concluídos</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome do pagamento</td>
               
                <td>Cliente</td>
                <td>Valor</td>
                <td>Vencimento</td>
                <td>Pago</td>
                
                
            </tr>

            <?php
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 1 AND cliente_id = $id ORDER BY vencimento ASC");
                $sql->execute();
                $pendentes = $sql->fetchAll();

                foreach ($pendentes as $key => $value) {
                    $clienteNome = MySql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id] ");
                    $clienteNome->execute();
                    $clienteNome =$clienteNome->fetch()['nome'];
                   
                    ?>
                <tr >
                    <td> <?php echo $value['nome'];?> </td>
                    <td> <?php echo $clienteNome;?> </td>
                    <td><?php echo $value['valor'];?></td>
                    <td><?php echo date('d/m/Y',strtotime($value['vencimento']));?></td>
                    <td><?php echo date('d/m/Y',strtotime($value['pago']));?></td>
                                   
                    
                </tr>
                <?php } ?>
            

            
        </table>
    </div><!--wraper-table-->
    </div><!--box-content-->