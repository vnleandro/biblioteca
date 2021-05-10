<?php

namespace App\Models\DAO;

use App\Models\Entidades\Genero;

class GeneroDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT id, nome FROM autor WHERE id = $id"
        );

        return $resultado->fetchObject(Genero::class);

    }
    public  function listar()
    {

        $resultado = $this->select(
            'SELECT id, nome FROM genero'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Genero::class);

    }

    public  function salvar(Genero $genero)
    {
        try {

            $nome           = $genero->getNome();

            return $this->insert(
                'genero',
                ":nome",
                [
                    ':nome'=>$nome
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Genero $genero)
    {
        try {

            $id             = $genero->getId();
            $nome           = $genero->getNome();

            return $this->update(
                'genero',
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

    public function excluir(Genero $genero)
    {
        try {
            $id = $genero->getId();

            return $this->delete('genero',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}