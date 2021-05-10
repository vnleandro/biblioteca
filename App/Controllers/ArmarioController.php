<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AlunoDAO;
use App\Models\DAO\ArmarioDAO;
use App\Models\Entidades\Armario;
use App\Models\Validacao\ArmarioValidador;

class ArmarioController extends Controller
{
    public function index()
    {
        $armarioDAO = new ArmarioDAO();

        self::setViewParam('listaArmarios',$armarioDAO->listar());

        $this->render('/armario/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $alunoDAO = new AlunoDAO();
        self::setViewParam('listaAlunos',$alunoDAO->listar());
        $this->render('/armario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Armario = new Armario();
        $Armario->setDisponivel($_POST['disponivel']);
        $Armario->getAluno()->setId($_POST['alunoId']);

        Sessao::gravaFormulario($_POST);

        $armarioValidador = new ArmarioValidador();
        $resultadoValidacao = $armarioValidador->validar($Armario);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/armario/cadastro');
        }

        $armarioDAO = new ArmarioDAO();

        $armarioDAO->salvar($Armario);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/armario');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $armarioDAO = new ArmarioDAO();

        $armario = $armarioDAO->getById($id);

        if(!$armario){
            Sessao::gravaMensagem("Armario inexistente");
            $this->redirect('/armario');
        }

        $alunoDAO = new AlunoDAO();
        self::setViewParam('listaAlunos',$alunoDAO->listar());
        self::setViewParam('armario',$armario);
        $this->render('/armario/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Armario = new Armario();
        $Armario->setId($_POST['id']);
        $Armario->setDisponivel($_POST['disponivel']);
        $Armario->getAluno()->setId($_POST['alunoId']);

        Sessao::gravaFormulario($_POST);

        $armarioValidador = new ArmarioValidador();
        $resultadoValidacao = $armarioValidador->validar($Armario);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/armario/edicao/'.$_POST['id']);
        }

        $armarioDAO = new ArmarioDAO();

        $armarioDAO->atualizar($Armario);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/armario');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $armarioDAO = new ArmarioDAO();

        $armario = $armarioDAO->getById($id);

        if(!$armario){
            Sessao::gravaMensagem("Armario inexistente");
            $this->redirect('/armario');
        }

        self::setViewParam('armario',$armario);

        $this->render('/armario/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Armario = new Armario();
        $Armario->setId($_POST['id']);

        $armarioDAO = new ArmarioDAO();

        if(!$armarioDAO->excluir($Armario)){
            Sessao::gravaMensagem("Armario inexistente");
            $this->redirect('/armario');
        }

        Sessao::gravaMensagem("Armario excluido com sucesso!");

        $this->redirect('/armario');

    }
}