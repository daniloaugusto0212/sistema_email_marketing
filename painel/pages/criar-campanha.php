<div class="box-content">
<?php
    if (isset($_POST['acao'])) {
        $assunto = $_POST['assunto'];
        $conteudo = $_POST['conteudo'];

        $contatos = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.contatos` WHERE lista_id = ?");
        $contatos->execute(array($_POST['lista_id']));
        $contatos = $contatos->fetchAll();
               
        foreach ($contatos as $key => $value) {
            $mail = new \Email('smtp.hostinger.com.br','contato@sitedan.com.br','681015','Danilo Augusto'); 
            $mail->formatarEmail(array('assunto'=>$assunto,'corpo'=>$conteudo));
            $email_atual = $value['email'];
            $mail->addAdress($email_atual,$value['nome']);
            $mail->enviarEmail();
            sleep(1);
       
    }
    Painel::alert('sucesso','Campanha enviada com sucesso!');
    }
?>
	<h2><i class="fa fa-pen"></i> Adicionar nova lista</h2>
   
    <form method="post">
		
		<div class="form-group">
        <label>Escolha a lista:</label>
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
			<label>Assunto:</label>
			<input type="text" name="assunto" id="">
		</div>

		<div class="form-group">
			<label>Texto do E-mail:</label>
			<textarea class="tinymce" name="conteudo"></textarea>
		</div>

        <div class="form-group">			
			<input type="submit" name="acao" value="Disparar!">
		</div><!--form-group-->

	</form>