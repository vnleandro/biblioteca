<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\LivroDAO;
use App\Models\DAO\EsperaDAO;
use App\Models\Entidades\Espera;
use App\Models\Validacao\EsperaValidador;

class EsperaController extends Controller
{
    public function index()
    {
        $esperaDAO = new EsperaDAO();

        self::setViewParam('listaEsperas',$esperaDAO->listar());

        $this->render('/espera/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $livroDAO = new LivroDAO();
        self::setViewParam('listaLivros',$livroDAO->listar());
        $this->render('/espera/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Espera = new Espera();
        $Espera->setAlunoNaFrente($_POST['alunoNaFrente']);
        $Espera->getLivro()->setId($_POST['livroId']);

        Sessao::gravaFormulario($_POST);

        $esperaValidador = new EsperaValidador();
        $resultadoValidacao = $esperaValidador->validar($Espera);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/espera/cadastro');
        }

        $esperaDAO = new EsperaDAO();

        $esperaDAO->salvar($Espera);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/espera');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $esperaDAO = new EsperaDAO();

        $espera = $esperaDAO->getById($id);

        if(!$espera){
            Sessao::gravaMensagem("Não há fila de espera");
            $this->redirect('/espera');
        }

        $livroDAO = new LivroDAO();
        self::setViewParam('listaLivros',$livroDAO->listar());
        self::setViewParam('espera',$espera);
        $this->render('/espera/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()
    {

        $Espera = new Espera();
        $Espera->setId($_POST['id']);
        $Espera->setAlunoNaFrente($_POST['alunoNaFrente']);
        $Espera->getLivro()->setId($_POST['livroId']);

        Sessao::gravaFormulario($_POST);

        $esperaValidador = new EsperaValidador();
        $resultadoValidacao = $esperaValidador->validar($Espera);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/espera/edicao/'.$_POST['id']);
        }

        $esperaDAO = new EsperaDAO();

        $esperaDAO->atualizar($Espera);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/espera');

    }
    
    public function exclusao($params)
    {
        $id = $params[0];

        $esperaDAO = new EsperaDAO();

        $espera = $esperaDAO->getById($id);

        if(!$espera){
            Sessao::gravaMensagem("Não há fila de espera");
            $this->redirect('/espera');
        }

        self::setViewParam('espera',$espera);

        $this->render('/espera/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $Espera = new Espera();
        $Espera->setId($_POST['id']);

        $esperaDAO = new EsperaDAO();

        if(!$esperaDAO->excluir($Espera)){
            Sessao::gravaMensagem("Não há fila de espera");
            $this->redirect('/espera');
        }

        Sessao::gravaMensagem("Fila de espera excluida com sucesso!");

        $this->redirect('/espera');

    }
}