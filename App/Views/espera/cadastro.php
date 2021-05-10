<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Espera</h3>
            
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/espera/salvar" method="post" id="form_cadastro">
                
                <div class="form-group">
                    <label for="descricao">Livro</label>
                <select class="form-control" name="livroId"  required>
                    <?php foreach($viewVar['listaLivros'] as $Livro): ?>
                    <option value="<?php echo $Livro->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('livroId') == $Livro->getId())? "selected" : ""; ?>><?php echo $Livro->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                    <label for="alunoNaFrente">Aluno na Frente</label>
                    <input type="text" class="form-control"  name="alunoNaFrente" placeholder="Aluno na Frente" value="<?php echo $Sessao::retornaValorFormulario('alunoNaFrente'); ?>" required>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>