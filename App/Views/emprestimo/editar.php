<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Emprestimo</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/emprestimo/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['emprestimo']->getId(); ?>">

                <div class="form-group">
                    <label for="descricao">Aluno</label>
                    <select class="form-control" name="alunoId"  required>
                        <?php foreach($viewVar['listaAlunos'] as $Aluno): ?>
                            <option value="<?php echo $Aluno->getId(); ?>" <?php echo ( $viewVar['emprestimo']->getAluno()->getId() == $Aluno->getId())? "selected" : ""; ?>><?php echo $Aluno->getNome(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Livro</label>
                    <select class="form-control" name="livroId"  required>
                        <?php foreach($viewVar['listaLivros'] as $Livro): ?>
                            <option value="<?php echo $Livro->getId(); ?>" <?php echo ( $viewVar['emprestimo']->getLivro()->getId() == $Livro->getId())? "selected" : ""; ?>><?php echo $Livro->getNome(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="dataEmprestimo">Data de Emprestimo</label>
                    <input type="text"  class="form-control" name="dataEmprestimo" id="dataEmprestimo" placeholder="" value="<?php echo $viewVar['emprestimo']->getDataEmprestimo(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="dataLimite">Data Limite</label>
                    <input type="text"  class="form-control" name="dataLimite" id="dataLimite" placeholder="" value="<?php echo $viewVar['emprestimo']->getDataLimite(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="dataDevolvido">Data de Devolução</label>
                    <input type="text"  class="form-control" name="dataDevolvido" id="dataDevolvido" placeholder="" value="<?php echo $viewVar['emprestimo']->getDataDevolvido(); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/emprestimo" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>