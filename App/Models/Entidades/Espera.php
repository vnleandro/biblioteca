<?php

namespace App\Models\Entidades;

class Espera
{
    private $id;
    private $livroId;
    private $alunoNaFrente;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLivroId()
    {
        return $this->livroId;
    }

    public function setLivroId($livroId)
    {
        $this->livroId = $livroId;
    }

    public function getAlunoNaFrente()
    {
        return $this->alunoNaFrente;
    }
    
    public function setAlunoNaFrente($alunoNaFrente)
    {
        $this->alunoNaFrente = $alunoNaFrente;
    }

}