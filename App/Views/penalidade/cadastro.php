<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Penalidade</h3>
            
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/penalidade/salvar" method="post" id="form_cadastro">
                
                <div class="form-group">
                    <label for="descricao">Aluno</label>
                <select class="form-control" name="alunoId"  required>
                    <?php foreach($viewVar['listaAlunos'] as $Aluno): ?>
                    <option value="<?php echo $Aluno->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('alunoId') == $Aluno->getId())? "selected" : ""; ?>><?php echo $Aluno->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                    <label for="dataInicio">Data Inicio</label>
                    <input type="text" class="form-control"  name="dataInicio" placeholder="Data de Início" value="<?php echo $Sessao::retornaValorFormulario('dataInicio'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="dataTermino">Data Término</label>
                    <input type="text" class="form-control" name="dataTermino" placeholder="Data de Término" value="<?php echo $Sessao::retornaValorFormulario('dataTermino'); ?>" required>

                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>