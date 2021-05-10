<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\TurmaDAO;
use App\Models\DAO\AlunoDAO;
use App\Models\Entidades\Aluno;
use App\Models\Validacao\AlunoValidador;

class AlunoController extends Controller
{
    public function index()
    {
        $alunoDAO = new AlunoDAO();

        self::setViewParam('listaAlunos',$alunoDAO->listar());

        $this->render('/aluno/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $turmaDAO = new TurmaDAO();
        self::setViewParam('listaTurmas',$turmaDAO->listar());
        $this->render('/aluno/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Aluno = new Aluno();
        $Aluno->setNome($_POST['nome']);
        $Aluno->getTurma()->setId($_POST['turmaId']);

        Sessao::gravaFormulario($_POST);

        $alunoValidador = new AlunoValidador();
        $resultadoValidacao = $alunoValidador->validar($Aluno);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/aluno/cadastro');
        }

        $alunoDAO = new AlunoDAO();

        $alunoDAO->salvar($Aluno);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/aluno');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $alunoDAO = new AlunoDAO();

        $aluno = $alunoDAO->getById($id);

        if(!$aluno){
            Sessao::gravaMensagem("Aluno inexistente");
            $this->redirect('/aluno');
        }

        $turmaDAO = new TurmaDAO();
        self::setViewParam('listaTurmas',$turmaDAO->listar());
        self::setViewParam('aluno',$aluno);
        $this->render('/aluno/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Aluno = new Aluno();
        $Aluno->setId($_POST['id']);
        $Aluno->setNome($_POST['nome']);
        $Aluno->getTurma()->setId($_POST['turmaId']);

        Sessao::gravaFormulario($_POST);

        $alunoValidador = new AlunoValidador();
        $resultadoValidacao = $alunoValidador->validar($Aluno);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/aluno/edicao/'.$_POST['id']);
        }

        $alunoDAO = new AlunoDAO();

        $alunoDAO->atualizar($Aluno);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/aluno');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $alunoDAO = new AlunoDAO();

        $aluno = $alunoDAO->getById($id);

        if(!$aluno){
            Sessao::gravaMensagem("Aluno inexistente");
            $this->redirect('/aluno');
        }

        self::setViewParam('aluno',$aluno);

        $this->render('/aluno/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Aluno = new Aluno();
        $Aluno->setId($_POST['id']);

        $alunoDAO = new AlunoDAO();

        if(!$alunoDAO->excluir($Aluno)){
            Sessao::gravaMensagem("Aluno inexistente");
            $this->redirect('/aluno');
        }

        Sessao::gravaMensagem("Aluno excluido com sucesso!");

        $this->redirect('/aluno');

    }
}