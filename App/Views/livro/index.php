<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/livro/cadastro" class="btn btn-success btn-sm">Adicionar</a>
        <hr>
    </div>
    <div class="col-md-12">
        <?php if($Sessao::retornaMensagem()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $Sessao::retornaMensagem(); ?>
            </div>
        <?php } ?>

        <?php
            if(!count($viewVar['listaLivros'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum livro encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Nome</td>
                        <td class="info">Descrição</td>
                        <td class="info">Disponível</td>
                        <td class="info">Gênero</td>
                        <td class="info">Autor</td>
                        <td class="info">Editora</td>
                        <td class="info"></td>
                    </tr>
                    <?php
                        foreach($viewVar['listaLivros'] as $livro) {
                    ?>
                        <tr>
                            <td><?php echo $livro->getNome(); ?></td>
                            <td><?php echo $livro->getDescricao(); ?></td>
                            <td><?php echo $livro->getDisponivel(); ?></td>
                            <td><?php echo $livro->getGenero()->getNome(); ?></td>
                            <td><?php echo $livro->getAutor()->getNome(); ?></td>
                            <td><?php echo $livro->getEditora()->getNome(); ?></td>>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/livro/edicao/<?php echo $livro->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/livro/exclusao/<?php echo $livro->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        <?php
            }
        ?>
    </div>
</div>
</div>