<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/aluno/cadastro" class="btn btn-success btn-sm">Adicionar</a>
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
            if(!count($viewVar['listaAlunos'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum aluno encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Nome</td>
                        <td class="info">Turma</td>
                        <td class="info"></td>
                    </tr>
                    <?php
                        foreach($viewVar['listaAlunos'] as $aluno) {
                    ?>
                        <tr>
                            <td><?php echo $aluno->getNome(); ?></td>
                            <td><?php echo $aluno->getTurma()->getNome(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/aluno/edicao/<?php echo $aluno->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/aluno/exclusao/<?php echo $aluno->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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