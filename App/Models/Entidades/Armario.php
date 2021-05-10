<?php

namespace App\Models\Entidades;

class Armario
{
    private $id;
    private $alunoId;
    private $disponivel;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAlunoId()
    {
        return $this->alunoId;
    }

    public function setAlunoId($alunoId)
    {
        $this->alunoId = $alunoId;
    }

    public function getDisponivel()
    {
        return $this->disponivel;
    }
    
    public function setDisponivel($disponivel)
    {
        $this->disponivel = $disponivel;
    }

}