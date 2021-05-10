<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AlunoDAO;
use App\Models\DAO\LivroDAO;
use App\Models\DAO\EmprestimoDAO;
use App\Models\Entidades\Emprestimo;
use App\Models\Validacao\EmprestimoValidador;

class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimoDAO = new EmprestimoDAO();

        self::setViewParam('listaEmprestimos',$emprestimoDAO->listar());

        $this->render('/emprestimo/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $alunoDAO = new AlunoDAO();
        self::setViewParam('listaAlunos',$alunoDAO->listar());
        $this->render('/emprestimo/cadastro');

        $livroDAO = new LivroDAO();
        self::setViewParam('listaLivros',$livroDAO->listar());
        $this->render('/emprestimo/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Emprestimo = new Emprestimo();
        $Emprestimo->setDataEmprestimo($_POST['dataEmprestimo']);
        $Emprestimo->setDataLimite($_POST['dataLimite']);
        $Emprestimo->setDataDevolvido($_POST['dataDevolvido']);
        $Emprestimo->getAluno()->setId($_POST['alunoId']);
        $Emprestimo->getLivro()->setId($_POST['livroId']);

        Sessao::gravaFormulario($_POST);

        $emprestimoValidador = new EmprestimoValidador();
        $resultadoValidacao = $emprestimoValidador->validar($Emprestimo);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/emprestimo/cadastro');
        }

        $emprestimoDAO = new EmprestimoDAO();

        $emprestimoDAO->salvar($Emprestimo);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/emprestimo');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $emprestimoDAO = new EmprestimoDAO();

        $emprestimo = $emprestimoDAO->getById($id);

        if(!$emprestimo){
            Sessao::gravaMensagem("Emprestimo inexistente");
            $this->redirect('/emprestimo');
        }

        $alunoDAO = new AlunoDAO();
        self::setViewParam('listaAlunos',$alunoDAO->listar());
        self::setViewParam('emprestimo',$emprestimo);
        $this->render('/emprestimo/editar');

        $livroDAO = new LivroDAO();
        self::setViewParam('listaLivros',$livroDAO->listar());
        self::setViewParam('emprestimo',$emprestimo);
        $this->render('/emprestimo/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Emprestimo = new Emprestimo();
        $Emprestimo->setId($_POST['id']);
        $Emprestimo->setDataEmprestimo($_POST['dataEmprestimo']);
        $Emprestimo->setDataLimite($_POST['dataLimite']);
        $Emprestimo->setDataDevolvido($_POST['dataDevolvido']);
        $Emprestimo->getAluno()->setId($_POST['alunoId']);
        $Emprestimo->getLivro()->setId($_POST['livroId']);

        Sessao::gravaFormulario($_POST);

        $eEmprestimoValidador = new EmprestimoValidador();
        $resultadoValidacao = $emprestimoValidador->validar($Emprestimo);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/emprestimo/edicao/'.$_POST['id']);
        }

        $emprestimoDAO = new EmprestimoDAO();

        $emprestimoDAO->atualizar($Emprestimo);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/emprestimo');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $emprestimoDAO = new EmprestimoDAO();

        $emprestimo = $emprestimoDAO->getById($id);

        if(!$emprestimo){
            Sessao::gravaMensagem("Emprestimo inexistente");
            $this->redirect('/emprestimo');
        }

        self::setViewParam('emprestimo',$emprestimo);

        $this->render('/emprestimo/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Emprestimo = new Emprestimo();
        $Emprestimo->setId($_POST['id']);

        $emprestimoDAO = new EmprestimoDAO();

        if(!$emprestimoDAO->excluir($Emprestimo)){
            Sessao::gravaMensagem("Emprestimo inexistente");
            $this->redirect('/emprestimo');
        }

        Sessao::gravaMensagem("Emprestimo finalizado com sucesso!");

        $this->redirect('/emprestimo');

    }
}