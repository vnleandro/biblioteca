<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AutorDAO;
use App\Models\Entidades\Autor;
use App\Models\Validacao\AutorValidador;

class AutorController extends Controller
{
    public function index()
    {
        $autorDAO = new AutorDAO();

        self::setViewParam('listaAutores',$autorDAO->listar());

        $this->render('/autor/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/autor/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Autor = new Autor();
        $Autor->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $autorValidador = new AutorValidador();
        $resultadoValidacao = $autorValidador->validar($Autor);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/autor/cadastro');
        }

        $autorDAO = new AutorDAO();

        $autorDAO->salvar($Autor);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/autor');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $autorDAO = new AutorDAO();

        $autor = $autorDAO->getById($id);

        if(!$autor){
            Sessao::gravaMensagem("Autor inexistente");
            $this->redirect('/autor');
        }

        self::setViewParam('autor',$autor);
        $this->render('/autor/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Autor = new Autor();
        $Autor->setId($_POST['id']);
        $Autor->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $autorValidador = new AutorValidador();
        $resultadoValidacao = $autorValidador->validar($Autor);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/autor/edicao/'.$_POST['id']);
        }

        $autorDAO = new AutorDAO();

        $autorDAO->atualizar($Autor);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/autor');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $autorDAO = new AutorDAO();

        $autor = $autorDAO->getById($id);

        if(!$autor){
            Sessao::gravaMensagem("Autor inexistente");
            $this->redirect('/autor');
        }

        self::setViewParam('autor',$autor);

        $this->render('/autor/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Autor = new Autor();
        $Autor->setId($_POST['id']);

        $autorDAO = new AutorDAO();

        if(!$autorDAO->excluir($Autor)){
            Sessao::gravaMensagem("Autor inexistente");
            $this->redirect('/autor');
        }

        Sessao::gravaMensagem("Autor excluido com sucesso!");

        $this->redirect('/autor');

    }
}