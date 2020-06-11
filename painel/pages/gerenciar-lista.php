
<div class="box-content">
	<h2><i class="fa fa-pen"></i> Adicionar nova lista</h2>
    <?php
    if(isset($_POST['acao'])){
        $nome_lista = $_POST['nome_lista'];
        $sql = \MySql::conectar()->prepare("INSERT INTO `tb_admin.listas_email` VALUES(null,?)");
        $sql->execute(array($nome_lista));
        Painel::alert('sucesso','A lista foi criada com sucesso!');
    }

?>
    <form method="post">
		
		<div class="form-group">
			<label>Nome da lista:</label>
			<input type="text" name="nome_lista">
		</div><!--form-group-->

		<div class="form-group">			
			<input type="submit" name="acao" value="Criar Lista!">
		</div><!--form-group-->

	</form>

    <h2><i class="fa fa-pen"></i> Listas disponíveis</h2>

    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td>#</td>
                           
            </tr>
            <?php
                $listas = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.listas_email`");
                $listas->execute();
                $listas = $listas->fetchAll();
                foreach ($listas as $key => $value) {
               
            ?>
            <tr>
                <td><?php echo $value['nome_lista'] ?></td>
                <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
            </tr>
                <?php } ?>
        </table>

</div>