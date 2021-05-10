<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Emprestimo</h3>
            
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/emprestimo/salvar" method="post" id="form_cadastro">
                
                <div class="form-group">
                    <label for="descricao">Aluno</label>
                <select class="form-control" name="alunoId"  required>
                    <?php foreach($viewVar['listaAlunos'] as $Aluno): ?>
                    <option value="<?php echo $Aluno->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('alunoId') == $Aluno->getId())? "selected" : ""; ?>><?php echo $Aluno->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Livro</label>
                <select class="form-control" name="livroId"  required>
                    <?php foreach($viewVar['listaLivros'] as $Livro): ?>
                    <option value="<?php echo $Livro->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('livroId') == $Livro->getId())? "selected" : ""; ?>><?php echo $Livro->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                
                <div class="form-group">
                    <label for="dataEmprestimo">Data de Empréstimo</label>
                    <input type="text" class="form-control"  name="dataEmprestimo" placeholder="Data de Empréstimo" value="<?php echo $Sessao::retornaValorFormulario('dataEmprestimo'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="dataLimite">Data Limite</label>
                    <input type="text" class="form-control"  name="dataLimite" placeholder="Data Limite" value="<?php echo $Sessao::retornaValorFormulario('dataLimite'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="dataDevolvido">Data de Devolução</label>
                    <input type="text" class="form-control"  name="dataDevolvido" placeholder="Data de Devolução" value="<?php echo $Sessao::retornaValorFormulario('dataDevolvido'); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>