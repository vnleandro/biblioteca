<?php

namespace App\Models\DAO;

use App\Models\Entidades\Autor;

class AutorDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT id, nome FROM autor WHERE id = $id"
        );

        return $resultado->fetchObject(Autor::class);

    }
    public  function listar()
    {

        $resultado = $this->select(
            'SELECT id, nome FROM autor'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Autor::class);

    }

    public  function salvar(Autor $autor)
    {
        try {

            $nome           = $autor->getNome();

            return $this->insert(
                'autor',
                ":nome",
                [
                    ':nome'=>$nome
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Autor $autor)
    {
        try {

            $id             = $autor->getId();
            $nome           = $autor->getNome();

            return $this->update(
                'autor',
                "nome = :nome",
                [
                    ':id'=>$id,
                    ':nome'=>$nome
                ],
                "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Autor $autor)
    {
        try {
            $id = $autor->getId();

            return $this->delete('autor',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}