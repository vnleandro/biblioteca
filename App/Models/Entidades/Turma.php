<?php

namespace App\Models\Entidades;

class Turma
{
    private $id;
    private $nome;
    private $periodo;

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

    public function getPeriodo()
    {
        return $this->periodo;
    }
    
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }

}