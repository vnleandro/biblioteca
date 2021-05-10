<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AlunoDAO;
use App\Models\DAO\PenalidadeDAO;
use App\Models\Entidades\Penalidade;
use App\Models\Validacao\PenalidadeValidador;

class PenalidadeController extends Controller
{
    public function index()
    {
        $penalidadeDAO = new PenalidadeDAO();

        self::setViewParam('listaPenalidades',$penalidadeDAO->listar());

        $this->render('/penalidade/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $alunoDAO = new AlunoDAO();
        self::setViewParam('listaAlunos',$alunoDAO->listar());
        $this->render('/penalidade/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Penalidade = new Penalidade();
        $Penalidade->setDataInicio($_POST['dataInicio']);
        $Penalidade->setDataTermino($_POST['dataTermino']);
        $Penalidade->getAluno()->setId($_POST['alunoId']);

        Sessao::gravaFormulario($_POST);

        $penalidadeValidador = new PenalidadeValidador();
        $resultadoValidacao = $penalidadeValidador->validar($Penalidade);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/penalidade/cadastro');
        }

        $penalidadeDAO = new PenalidadeDAO();

        $penalidadeDAO->salvar($Penalidade);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/penalidade');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $penalidadeDAO = new PenalidadeDAO();

        $penalidade = $penalidadeDAO->getById($id);

        if(!$penalidade){
            Sessao::gravaMensagem("Penalidade inexistente");
            $this->redirect('/penalidade');
        }

        $alunoDAO = new AlunoDAO();
        self::setViewParam('listaAlunos',$alunoDAO->listar());
        self::setViewParam('penalidade',$penalidade);
        $this->render('/penalidade/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Penalidade = new Penalidade();
        $Penalidade->setId($_POST['id']);
        $Penalidade->setDataInicio($_POST['dataInicio']);
        $Penalidade->setDataTermino($_POST['dataTermino']);
        $Penalidade->getAluno()->setId($_POST['alunoId']);

        Sessao::gravaFormulario($_POST);

        $penalidadeValidador = new PenalidadeValidador();
        $resultadoValidacao = $penalidadeValidador->validar($Penalidade);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/penalidade/edicao/'.$_POST['id']);
        }

        $penalidadeDAO = new PenalidadeDAO();

        $penalidadeDAO->atualizar($Penalidade);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/penalidade');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $penalidadeDAO = new PenalidadeDAO();

        $penalidade = $penalidadeDAO->getById($id);

        if(!$penalidade){
            Sessao::gravaMensagem("Penalidade inexistente");
            $this->redirect('/penalidade');
        }

        self::setViewParam('penalidade',$penalidade);

        $this->render('/penalidade/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Penalidade = new Penalidade();
        $Penalidade->setId($_POST['id']);

        $penalidadeDAO = new PenalidadeDAO();

        if(!$penalidadeDAO->excluir($Penalidade)){
            Sessao::gravaMensagem("Penalidade inexistente");
            $this->redirect('/penalidade');
        }

        Sessao::gravaMensagem("Penalidade excluida com sucesso!");

        $this->redirect('/penalidade');

    }
}