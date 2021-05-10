<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Penalidade;

class PenalidadeValidador{

    public function validar(Penalidade $penalidade)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($penalidade->getAluno()->getId()))
        {
            $resultadoValidacao->addErro('alunoId',"Aluno: Este campo não pode ser vazio");
        }

        if(empty($penalidade->getDataInicio()))
        {
            $resultadoValidacao->addErro('dataInicio',"Data de Inicio: Este campo não pode ser vazio");
        }
        
        if(empty($penalidade->getDataTerminio()))
        {
            $resultadoValidacao->addErro('dataTermino',"Data de Término: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}