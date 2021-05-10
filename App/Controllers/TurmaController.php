<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\TurmaDAO;
use App\Models\Entidades\Turma;
use App\Models\Validacao\TurmaValidador;

class TurmaController extends Controller
{
    public function index()
    {
        $turmaDAO = new TurmaDAO();

        self::setViewParam('listaTurmas',$turmaDAO->listar());

        $this->render('/turma/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/turma/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Turma = new Turma();
        $Turma->setNome($_POST['nome']);
        $Turma->setPeriodo($_POST['periodo']);

        Sessao::gravaFormulario($_POST);

        $turmaValidador = new TurmaValidador();
        $resultadoValidacao = $turmaValidador->validar($Turma);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/turma/cadastro');
        }

        $turmaDAO = new TurmaDAO();

        $turmaDAO->salvar($Turma);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/turma');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $turmaDAO = new TurmaDAO();

        $turma = $turmaDAO->getById($id);

        if(!$turma){
            Sessao::gravaMensagem("Turma inexistente");
            $this->redirect('/turma');
        }

        self::setViewParam('turma',$turma);
        $this->render('/turma/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Turma = new Turma();
        $Turma->setId($_POST['id']);
        $Turma->setNome($_POST['nome']);
        $Turma->setPeriodo($_POST['periodo']);

        Sessao::gravaFormulario($_POST);

        $turmaValidador = new TurmaValidador();
        $resultadoValidacao = $turmaValidador->validar($Turma);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/turma/edicao/'.$_POST['id']);
        }

        $turmaDAO = new TurmaDAO();

        $turmaDAO->atualizar($Turma);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/turma');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $turmaDAO = new TurmaDAO();

        $turma = $turmaDAO->getById($id);

        if(!$turma){
            Sessao::gravaMensagem("Turma inexistente");
            $this->redirect('/turma');
        }

        self::setViewParam('turma',$turma);

        $this->render('/turma/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Turma = new Turma();
        $Turma->setId($_POST['id']);

        $turmaDAO = new TurmaDAO();

        if(!$turmaDAO->excluir($Turma)){
            Sessao::gravaMensagem("Turma inexistente");
            $this->redirect('/turma');
        }

        Sessao::gravaMensagem("Turma excluida com sucesso!");

        $this->redirect('/turma');

    }
}