<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\GeneroDAO;
use App\Models\Entidades\Genero;
use App\Models\Validacao\GeneroValidador;

class GeneroController extends Controller
{
    public function index()
    {
        $generoDAO = new GeneroDAO();

        self::setViewParam('listaGeneros',$generoDAO->listar());

        $this->render('/genero/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/genero/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Genero = new Genero();
        $Genero->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $generoValidador = new GeneroValidador();
        $resultadoValidacao = $generoValidador->validar($Genero);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/genero/cadastro');
        }

        $generoDAO = new GeneroDAO();

        $generoDAO->salvar($Genero);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/genero');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $generoDAO = new GeneroDAO();

        $genero = $generoDAO->getById($id);

        if(!$genero){
            Sessao::gravaMensagem("Genero inexistente");
            $this->redirect('/genero');
        }

        self::setViewParam('genero',$genero);

        $this->render('/genero/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Genero = new Genero();
        $Genero->setId($_POST['id']);
        $Genero->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $livroValidador = new GeneroValidador();
        $resultadoValidacao = $livroValidador->validar($Genero);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/genero/edicao/'.$_POST['id']);
        }

        $generoDAO = new GeneroDAO();

        $generoDAO->atualizar($Genero);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/genero');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $generoDAO = new GeneroDAO();

        $genero = $generoDAO->getById($id);

        if(!$genero){
            Sessao::gravaMensagem("Genero inexistente");
            $this->redirect('/genero');
        }

        self::setViewParam('genero',$genero);

        $this->render('/genero/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $Genero = new Genero();
        $Genero->setId($_POST['id']);

        $generoDAO = new GeneroDAO();

        if($totalLivros = $generoDAO->getQuantidadeLivros($_POST['id'])){
            Sessao::gravaMensagem("Este genero não pode ser excluído pois existem ".$totalLivros." livros vinculados a ele.");
            $this->redirect('/genero/exclusao/'.$_POST['id']);
        }

        if(!$generoDAO->excluir($genero)){
            Sessao::gravaMensagem("Genero inexistente");
            $this->redirect('/genero');
        }

        Sessao::gravaMensagem("Genero excluido com sucesso!");

        $this->redirect('/genero');

    }
}