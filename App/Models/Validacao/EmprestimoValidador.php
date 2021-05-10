<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Emprestimo;

class EmprestimoValidador{

    public function validar(Emprestimo $emprestimo)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($emprestimo->getAluno()->getId()))
        {
            $resultadoValidacao->addErro('alunoId',"Aluno: Este campo não pode ser vazio");
        }

        if(empty($emprestimo->getLivro()->getId()))
        {
            $resultadoValidacao->addErro('livroId',"Livro: Este campo não pode ser vazio");
        }

        if(empty($emprestimo->getDataEmprestimo()))
        {
            $resultadoValidacao->addErro('dataEmprestimo',"Data de Empréstimo: Este campo não pode ser vazio");
        }
        
        if(empty($emprestimo->getDataLimite()))
        {
            $resultadoValidacao->addErro('dataLimite',"Data Limite: Este campo não pode ser vazio");
        }

        if(empty($emprestimo->getDataDevolvido()))
        {
            $resultadoValidacao->addErro('dataDevolvido',"Data de Devolução: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}