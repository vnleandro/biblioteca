<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>">Vinicius Leandro Almeida dos Santos</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php if($viewVar['nameController'] == "HomeController") { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>" >Home</a>
                </li>
                <li <?php if($viewVar['nameController'] == "AlunoController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/aluno" >Lista de Alunos</a>
                </li>
                <li <?php if($viewVar['nameController'] == "ArmarioController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/armario" >Lista de Armários</a>
                </li>
                <li <?php if($viewVar['nameController'] == "AutorController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/autor" >Lista de Autores</a>
                </li>
                <li <?php if($viewVar['nameController'] == "EditoraController" && $viewVar['nameAction'] == "cadastro") { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/editora" >Lista de Editoras</a>
                </li>
                <li <?php if($viewVar['nameController'] == "EmprestimoController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/emprestimo" >Lista de Empréstimos</a>
                </li>
                <li <?php if($viewVar['nameController'] == "EsperaController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/espera" >Lista de Espera por Livros</a>
                </li>
                <li <?php if($viewVar['nameController'] == "GeneroController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/genero" >Lista de Gêneros Literários</a>
                </li>
                <li <?php if($viewVar['nameController'] == "LivroController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/livro" >Lista de Livros</a>
                </li>
                <li <?php if($viewVar['nameController'] == "PenalidadeController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/penalidade" >Lista de Penalidades Aplicadas</a>
                </li>
                <li <?php if($viewVar['nameController'] == "TurmaController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> class="active" <?php } ?>>
                    <a href="http://<?php echo APP_HOST; ?>/turma" >Lista de Turmas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
