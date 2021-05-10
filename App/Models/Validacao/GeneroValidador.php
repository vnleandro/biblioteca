<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Genero;

class GeneroValidador{

    public function validar(Genero $genero)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($genero->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}