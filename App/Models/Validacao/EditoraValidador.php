<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Editora;

class EditoraValidador{

    public function validar(Editora $editora)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($editora->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }
        return $resultadoValidacao;
    }
}