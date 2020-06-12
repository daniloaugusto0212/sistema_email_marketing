
<div class="box-content">
	
<?php
   if (isset($_POST['acao'])) {
       $nome = $_POST['nome_lista'];
       $email = $_POST['email_lista'];
       $lista_id = $_POST['lista_id'];

       if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
           Painel::alert('erro','O e-mail informado não é válido!');
       }else{
           $sql = \MySql::conectar()->prepare("INSERT INTO `tb_admin.contatos` VALUES(null,?,?,?)");
           $sql->execute(array($nome,$email,$lista_id));
           Painel::alert('sucesso', 'O contato foi inserido com sucesso!');
       }
   }
   if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);        
    Painel::deletar('tb_admin.contatos',$idExcluir);
    Painel::alertJS('O contato foi excluído com sucesso!');
    Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-contatos');    
    }

?>
<h2><i class="fa fa-pen"></i> Adicionar novo contato</h2>
    <form method="post">
		
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome_lista">
		</div><!--form-group-->

        <div class="form-group">
			<label>E-mail:</label>
			<input type="text" name="email_lista">
		</div><!--form-group-->

        <div class="form-group">
			<label>Lista:</label>
			<select name="lista_id">
            <?php
                $listas = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.listas_email`");
                $listas->execute();
                $listas = $listas->fetchAll();
                foreach ($listas as $key => $value) {               
            ?>
            <option value="<?php echo $value['id'] ?>"><?php echo $value['nome_lista'] ?></option>
                <?php } ?>
            </select>
		</div><!--form-group-->

		<div class="form-group">			
			<input type="submit" name="acao" value="Adicionar Contato!">
		</div><!--form-group-->

	</form>

    <h2><i class="fa fa-pen"></i> Contatos disponíveis</h2>

    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Lista</td>
                <td>#</td>
                           
            </tr>

            <?php
                $contatos = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.contatos`");
                $contatos->execute();
                $contatos = $contatos->fetchAll();
                foreach ($contatos as $key => $value) {
                    $nomeLista = \MySql::conectar()->prepare("SELECT nome_lista FROM `tb_admin.listas_email` WHERE id = $value[lista_id]");
                    $nomeLista->execute();
                    $nomeLista = $nomeLista->fetch()['nome_lista'];
            
            ?>
          
            <tr>
                <td><?php echo $value['nome'] ?></td>
                <td><?php echo $value['email'] ?></td>
                <td><?php echo $nomeLista ?></td>
                <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-contatos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
            </tr>

                <?php } ?>
                
        </table>

</div>