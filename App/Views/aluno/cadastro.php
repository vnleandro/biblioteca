<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Aluno</h3>
            
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/aluno/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Nome do Aluno" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Turma</label>
                <select class="form-control" name="turmaId"  required>
                    <?php foreach($viewVar['listaTurmas'] as $Turma): ?>
                    <option value="<?php echo $Turma->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('turmaId') == $Turma->getId())? "selected" : ""; ?>><?php echo $Turma->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>