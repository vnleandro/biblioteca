<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Espera</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/espera/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['espera']->getId(); ?>">

                <div class="form-group">
                    <label for="descricao">Livro</label>
                    <select class="form-control" name="livroId"  required>
                        <?php foreach($viewVar['listaLivros'] as $Livro): ?>
                            <option value="<?php echo $Livro->getId(); ?>" <?php echo ( $viewVar['espera']->getLivro()->getId() == $Livro->getId())? "selected" : ""; ?>><?php echo $Livro->getNome(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="alunoNaFrente">Aluno na Frente</label>
                    <input type="text"  class="form-control" name="alunoNaFrente" id="alunoNaFrente" placeholder="" value="<?php echo $viewVar['espera']->getAlunoNaFrente(); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/espera" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>