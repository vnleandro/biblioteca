<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/emprestimo/cadastro" class="btn btn-success btn-sm">Adicionar</a>
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
            if(!count($viewVar['listaEmprestimos'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum emprestimo encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Aluno</td>
                        <td class="info">Livro</td>
                        <td class="info">Data de Empréstimo</td>
                        <td class="info">Data Limite</td>
                        <td class="info">Data de Devolução</td>
                        <td class="info"></td>
                    </tr>
                    <?php
                        foreach($viewVar['listaEmprestimos'] as $emprestimo) {
                    ?>
                        <tr>                            
                            <td><?php echo $emprestimo->getAluno()->getId(); ?></td>
                            <td><?php echo $emprestimo->getLivro()->getId(); ?></td>
                            <td><?php echo $emprestimo->getDataEmprestimo(); ?></td>
                            <td><?php echo $emprestimo->getDataLimite(); ?></td>
                            <td><?php echo $emprestimo->getDataDevolvido(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/emprestimo/edicao/<?php echo $emprestimo->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/emprestimo/exclusao/<?php echo $emprestimo->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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