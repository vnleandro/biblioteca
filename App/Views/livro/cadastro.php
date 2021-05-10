<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Livro</h3>
            
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/livro/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Nome do Livro" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>

                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" name="descricao" placeholder="Descrição do livro" required><?php echo $Sessao::retornaValorFormulario('descricao'); ?></textarea>

                </div>

                <div class="form-group">
                    <label for="disponivel">Disponibilidade</label>
                    <textarea class="form-control" name="disponivel" placeholder="Disponibilidade do livro" required><?php echo $Sessao::retornaValorFormulario('disponivel'); ?></textarea>

                </div>

                <div class="form-group">
                    <label for="descricao">Gênero</label>
                <select class="form-control" name="generoId"  required>
                    <?php foreach($viewVar['listaGeneros'] as $Genero): ?>
                    <option value="<?php echo $Genero->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('generoId') == $Genero->getId())? "selected" : ""; ?>><?php echo $Genero->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Autor</label>
                <select class="form-control" name="autorId"  required>
                    <?php foreach($viewVar['listaAutores'] as $Autor): ?>
                    <option value="<?php echo $Autor->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('autorId') == $Autor->getId())? "selected" : ""; ?>><?php echo $Autor->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Editora</label>
                <select class="form-control" name="editoraId"  required>
                    <?php foreach($viewVar['listaEditoras'] as $Editora): ?>
                    <option value="<?php echo $Editora->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('editoraId') == $Editora->getId())? "selected" : ""; ?>><?php echo $Editora->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>