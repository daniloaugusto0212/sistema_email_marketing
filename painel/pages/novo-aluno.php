
<div class="box-content">
    <h2><i class="fas fa-file-alt"></i> Adicionar Aluno</h2>

    <form  method="post" > 
        <?php
            if (isset($_POST['acao'])) {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $senhaConfirm = $_POST['senhaConfirm'];
                if ($senha != $senhaConfirm) {
                    Painel::alert("erro","As senhas não coincidem!");
                }else{
                    $sql = \MySql::conectar()->prepare("INSERT INTO `tb_admin.alunos` VALUES(null,?,?,?,?)");
                    $sql->execute(array($nome,$email,$senha,$senhaConfirm));
                    Painel::alert("sucesso","O Aluno foi cadastrado com sucesso!");
                }               
            }
        ?>

        <div class="form-group">
            <label>Nome do Aluno: </label>
            <input type="text" name="nome" required>
        </div><!--form-group-->

        <div class="form-group">
            <label>E-mail: </label>
            <input type="text" name="email">
        </div><!--form-group-->

        <div class="form-group">
            <label>Senha: </label>
            <input type="password" name="senha" required>
        </div><!--form-group-->

        <div class="form-group">
            <label>Confirmação de Senha: </label>
            <input type="password" name="senhaConfirm" required>
        </div><!--form-group-->

               
        <div class="form-group"> 
                    
            <input type="submit" name="acao" value="Cadastrar Aluno!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->