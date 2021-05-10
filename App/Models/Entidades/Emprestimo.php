<?php

namespace App\Models\Entidades;

use DateTime;

class Emprestimo
{
    private $id;
    private $alunoId;
    private $livroId;
    private $dataEmprestimo;
    private $dataLimite;
    private $dataDevolvido;

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

    public function getLivroId()
    {
        return $this->livroId;
    }

    public function setLivroId($livroId)
    {
        $this->livroId = $livroId;
    }

    public function getDataEmprestimo()
    {
        return new DateTime($this->dataEmprestimo);
    }

    public function setDataEmprestimo($dataEmprestimo)
    {
        $this->dataEmprestimo = $dataEmprestimo;
    }

    public function getDataLimite()
    {
        return new DateTime($this->dataLimite);
    }

    public function setDataLimite($dataLimite)
    {
        $this->dataLimite = $dataLimite;
    }

    public function getDataDevolvido()
    {
        return new DateTime($this->dataDevolvido);
    }

    public function setDataDevolvido($dataDevolvido)
    {
        $this->dataDevolvido = $dataDevolvido;
    }

}