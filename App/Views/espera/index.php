<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/espera/cadastro" class="btn btn-success btn-sm">Adicionar</a>
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
            if(!count($viewVar['listaEsperas'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhuma espera encontrada</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Livro</td>
                        <td class="info">Aluno na Frente</td>
                        <td class="info"></td>
                    </tr>
                    <?php
                        foreach($viewVar['listaEsperas'] as $espera) {
                    ?>
                        <tr>
                            <td><?php echo $espera->getLivro()->getNome(); ?></td>
                            <td><?php echo $espera->getAlunoNaFrente(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/espera/edicao/<?php echo $espera->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/espera/exclusao/<?php echo $espera->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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