<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/penalidade/cadastro" class="btn btn-success btn-sm">Adicionar</a>
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
            if(!count($viewVar['listaPenalidades'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhuma penalidade encontrada</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Aluno</td>
                        <td class="info">Data de Início</td>
                        <td class="info">Data de Término</td>
                        <td class="info"></td>
                    </tr>
                    <?php
                        foreach($viewVar['listaPenalidades'] as $penalidade) {
                    ?>
                        <tr>
                            <td><?php echo $livro->getAluno()->getId(); ?></td>
                            <td><?php echo $livro->getDataInicio(); ?></td>
                            <td>R$ <?php echo $livro->getDataTermino(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/penalidade/edicao/<?php echo $penalidade->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/penalidade/exclusao/<?php echo $penalidade->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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