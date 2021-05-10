<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Espera;

class EsperaLivroValidador{

    public function validar(Espera $espera)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($espera->getLivro()->getId()))
        {
            $resultadoValidacao->addErro('livroId',"Livro: Este campo não pode ser vazio");
        }

        if(empty($espera->getAlunoNaFrente()))
        {
            $resultadoValidacao->addErro('alunoNaFrente',"Aluno na Frente: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}