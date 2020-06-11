
<div class="box-content">
    <h2><i class="fas fa-file-alt"></i> Adicionar Módulo</h2>

    <form  method="post" > 
        <?php
            if (isset($_POST['acao'])) {
                $nome = $_POST['nome']; 
               
                $sql = \MySql::conectar()->prepare("INSERT INTO `tb_admin.modulos` VALUES(null,?)");
                $sql->execute(array($nome));
                Painel::alert("sucesso","O Módulo foi cadastrado com sucesso!");                        
            }
        ?>

        <div class="form-group">
            <label>Nome do Módulo: </label>
            <input type="text" name="nome" required>
        </div><!--form-group-->

       
        <div class="form-group"> 
                    
            <input type="submit" name="acao" value="Cadastrar Módulo!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->