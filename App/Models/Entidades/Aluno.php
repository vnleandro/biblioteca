<?php

namespace App\Models\Entidades;

class Aluno
{
    private $id;
    private $turmaId;
    private $nome;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTurmaId()
    {
        return $this->turmaId;
    }

    public function setTurmaId($turmaId)
    {
        $this->turmaId = $turmaId;
    }

    public function getNome()
    {
        return $this->nome;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

}