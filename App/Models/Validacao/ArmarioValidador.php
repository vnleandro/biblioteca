<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Armario;

class ArmarioValidador{

    public function validar(Armario $armario)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($armario->getDisponivel()))
        {
            $resultadoValidacao->addErro('disponivel',"Disponibilidade: Este campo não pode ser vazio");
        }

        if(empty($armario->getAluno()->getId()))
        {
            $resultadoValidacao->addErro('alunoId',"Aluno: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}