<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EditoraDAO;
use App\Models\Entidades\Editora;
use App\Models\Validacao\EditoraValidador;

class EditoraController extends Controller
{
    public function index()
    {
        $editoraDAO = new EditoraDAO();

        self::setViewParam('listaEditoras',$editoraDAO->listar());

        $this->render('/editora/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/editora/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Editora = new Editora();
        $Editora->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $editoraValidador = new EditoraValidador();
        $resultadoValidacao = $editoraValidador->validar($Editora);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/editora/cadastro');
        }

        $editoraDAO = new EditoraDAO();

        $editoraDAO->salvar($Editora);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/editora');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $editoraDAO = new EditoraDAO();

        $editora = $editoraDAO->getById($id);

        if(!$editora){
            Sessao::gravaMensagem("Editora inexistente");
            $this->redirect('/editora');
        }

        self::setViewParam('editora',$editora);

        $this->render('/editora/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Editora = new Editora();
        $Editora->setId($_POST['id']);
        $Editora->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $livroValidador = new EditoraValidador();
        $resultadoValidacao = $livroValidador->validar($Editora);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/editora/edicao/'.$_POST['id']);
        }

        $editoraDAO = new EditoraDAO();

        $editoraDAO->atualizar($Editora);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/editora');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $editoraDAO = new EditoraDAO();

        $editora = $editoraDAO->getById($id);

        if(!$editora){
            Sessao::gravaMensagem("Editora inexistente");
            $this->redirect('/editora');
        }

        self::setViewParam('editora',$editora);

        $this->render('/editora/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $Editora = new Editora();
        $Editora->setId($_POST['id']);

        $editoraDAO = new EditoraDAO();

        if($totalLivros = $editoraDAO->getQuantidadeLivros($_POST['id'])){
            Sessao::gravaMensagem("Esta editora não pode ser excluída pois existem ".$totalLivros." livros vinculados a ela.");
            $this->redirect('/editora/exclusao/'.$_POST['id']);
        }

        if(!$editoraDAO->excluir($editora)){
            Sessao::gravaMensagem("Editora inexistente");
            $this->redirect('/editora');
        }

        Sessao::gravaMensagem("Editora excluida com sucesso!");

        $this->redirect('/editora');

    }
}