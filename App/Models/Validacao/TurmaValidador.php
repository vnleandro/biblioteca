<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Turma;

class TurmaValidador{

    public function validar(Turma $turma)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($turma->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }
        
        if(empty($turma->getPeriodo()))
        {
            $resultadoValidacao->addErro('periodo',"Período: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}