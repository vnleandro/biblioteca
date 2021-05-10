<?php

namespace App\Models\Entidades;


class Livro
{
    private $id;
    private $nome;
    private $descricao;
    private $disponivel;
    private $generoId;
    private $autorId;
    private $editoraId;
    private $editora;

    public function __construct()
    {
        $this->editora = new Editora();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDisponivel()
    {
        return $this->disponivel;
    }

    public function setDisponivel($disponivel)
    {
        $this->disponivel = $disponivel;
    }

    public function getGeneroId()
    {
        return $this->generoId;
    }

    public function setGeneroId($generoId)
    {
        $this->generoId = $generoId;
    }

    public function getAutorId()
    {
        return $this->autorId;
    }

    public function setAutorId($autorId)
    {
        $this->autorId = $autorId;
    }

    public function getEditoraId()
    {
        return $this->editoraId;
    }

    public function setEditoraId($editoraId)
    {
        $this->editoraId = $editoraId;
    }

    public function getEditora()
    {
        return $this->editora;
    }

    public function setEditora($editora)
    {
        $this->editora = $editora;
    }

}