<?php

namespace App\Models\Entidades;

use DateTime;

class Penalidade
{
    private $id;
    private $alunoId;
    private $dataInicio;
    private $dataTermino;


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

    public function getDataInicio()
    {
        return new DateTime($this->dataInicio);
    }

    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;
    }

    public function getDataTermino()
    {
        return new DateTime($this->dataTermino);
    }

    public function setDataTermino($dataTermino)
    {
        $this->dataTermino = $dataTermino;
    }

}