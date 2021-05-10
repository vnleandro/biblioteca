<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/armario/cadastro" class="btn btn-success btn-sm">Adicionar</a>
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
            if(!count($viewVar['listaArmarios'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum armario encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Aluno</td>
                        <td class="info">Disponibilidade</td>
                        <td class="info"></td>
                    </tr>
                    <?php
                        foreach($viewVar['listaArmarios'] as $armario) {
                    ?>
                        <tr>
                            <td><?php echo $armario->getAluno()->getNome(); ?></td>
                            <td><?php echo $armario->getDisponivel(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/armario/edicao/<?php echo $armario->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/armario/exclusao/<?php echo $armario->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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