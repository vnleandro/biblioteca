<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Livro;

class LivroValidador{

    public function validar(Livro $livro)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($livro->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }

        if(empty($livro->getDescricao()))
        {
            $resultadoValidacao->addErro('descricao',"Descrição: Este campo não pode ser vazio");
        }

        if(empty($livro->getDisponivel()))
        {
            $resultadoValidacao->addErro('disponivel',"Disponibilidade: Este campo não pode ser vazio");
        }

        if(empty($livro->getGenero()->getId()))
        {
            $resultadoValidacao->addErro('generoId',"Genero: Este campo não pode ser vazio");
        }

        if(empty($livro->getAutor()->getId()))
        {
            $resultadoValidacao->addErro('autorId',"Autor: Este campo não pode ser vazio");
        }

        if(empty($livro->getEditora()->getId()))
        {
            $resultadoValidacao->addErro('editoraId',"Editora: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}