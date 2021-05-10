<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Autor;

class AutorValidador{

    public function validar(Autor $autor)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($autor->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}