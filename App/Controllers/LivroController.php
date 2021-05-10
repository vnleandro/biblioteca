<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\GeneroDAO;
use App\Models\DAO\AutorDAO;
use App\Models\DAO\EditoraDAO;
use App\Models\DAO\LivroDAO;
use App\Models\Entidades\Livro;
use App\Models\Validacao\LivroValidador;

class LivroController extends Controller
{
    public function index()
    {
        $livroDAO = new LivroDAO();

        self::setViewParam('listaLivros',$livroDAO->listar());

        $this->render('/livro/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $generoDAO = new GeneroDAO();
        self::setViewParam('listaGeneros',$generoDAO->listar());

        $autorDAO = new AutorDAO();
        self::setViewParam('listaAutores',$autorDAO->listar());

        $editoraDAO = new EditoraDAO();
        self::setViewParam('listaEditoras',$editoraDAO->listar());

        $this->render('/livro/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Livro = new Livro();
        $Livro->setNome($_POST['nome']);
        $Livro->setDescricao($_POST['descricao']);
        $Livro->setDisponivel($_POST['disponivel']);
        $Livro->getGenero()->setId($_POST['generoId']);
        $Livro->getAutor()->setId($_POST['autorId']);
        $Livro->getEditora()->setId($_POST['editoraId']);

        Sessao::gravaFormulario($_POST);

        $livroValidador = new LivroValidador();
        $resultadoValidacao = $livroValidador->validar($Livro);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/livro/cadastro');
        }

        $livroDAO = new LivroDAO();

        $livroDAO->salvar($Livro);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/livro');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $livroDAO = new LivroDAO();

        $livro = $livroDAO->getById($id);

        if(!$produto){
            Sessao::gravaMensagem("Livro inexistente");
            $this->redirect('/livro');
        }

        $generoDAO = new GeneroDAO();
        self::setViewParam('listaGeneros',$generoDAO->listar());

        $autorDAO = new AutorDAO();
        self::setViewParam('listaAutores',$autorDAO->listar());

        $editoraDAO = new EditoraDAO();
        self::setViewParam('listaEditoras',$editoraDAO->listar());

        self::setViewParam('livro',$livro);
        $this->render('/livro/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Livro = new Livro();
        $Livro->setId($_POST['id']);
        $Livro->setNome($_POST['nome']);
        $Livro->setDisponivel($_POST['disponivel']);
        $Livro->getGenero()->setId($_POST['generoId']);
        $Livro->getAutor()->setId($_POST['autorId']);
        $Livro->getEditora()->setId($_POST['editoraId']);

        Sessao::gravaFormulario($_POST);

        $livroValidador = new LivroValidador();
        $resultadoValidacao = $livroValidador->validar($Livro);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/livro/edicao/'.$_POST['id']);
        }

        $livroDAO = new LivroDAO();

        $livroDAO->atualizar($Livro);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/livro');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $livroDAO = new LivroDAO();

        $livro = $livroDAO->getById($id);

        if(!$livro){
            Sessao::gravaMensagem("Livro inexistente");
            $this->redirect('/livro');
        }

        self::setViewParam('livro',$livro);

        $this->render('/livro/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Livro = new Livro();
        $Livro->setId($_POST['id']);

        $livroDAO = new LivroDAO();

        if(!$livroDAO->excluir($Livro)){
            Sessao::gravaMensagem("Livro inexistente");
            $this->redirect('/livro');
        }

        Sessao::gravaMensagem("Livro excluido com sucesso!");

        $this->redirect('/livro');

    }
}