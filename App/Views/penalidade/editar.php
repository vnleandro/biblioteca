<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Penalidade</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/penalidade/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['penalidade']->getId(); ?>">

                <div class="form-group">
                    <label for="descricao">Aluno</label>
                    <select class="form-control" name="alunoId"  required>
                        <?php foreach($viewVar['listaAlunos'] as $Aluno): ?>
                            <option value="<?php echo $Aluno->getId(); ?>" <?php echo ( $viewVar['penalidade']->getAluno()->getId() == $Aluno->getId())? "selected" : ""; ?>><?php echo $Aluno->getNome(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="dataInicio">Data Inicio</label>
                    <input type="text"  class="form-control" name="dataInicio" id="dataInicio" placeholder="" value="<?php echo $viewVar['penalidade']->getDataInicio(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="dataTermino">Data Término</label>
                    <input type="text"  class="form-control"  name="dataTermino" id="dataTermino" placeholder="" value="<?php echo $viewVar['penalidade']->getDataTermino(); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/penalidade" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>