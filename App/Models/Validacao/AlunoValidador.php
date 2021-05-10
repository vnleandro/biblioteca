<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Aluno;

class AlunoValidador{

    public function validar(Aluno $aluno)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($aluno->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }

        if(empty($aluno->getTurma()->getId()))
        {
            $resultadoValidacao->addErro('turmaId',"Turma: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}