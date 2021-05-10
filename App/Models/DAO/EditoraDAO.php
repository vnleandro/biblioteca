<?php

namespace App\Models\DAO;

use App\Models\Entidades\Editora;

class EditoraDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT id, nome FROM editora WHERE id = $id"
        );

        return $resultado->fetchObject(Editora::class);

    }
    public  function listar()
    {

        $resultado = $this->select(
            'SELECT id, nome FROM editora'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Editora::class);

    }
    public  function getQuantidadeLivros($id)
    {
        if($id) {
            $resultado = $this->select(
                "SELECT count(*) as total FROM livro WHERE editora_id= $id"
            );

            return $resultado->fetch()['total'];
        }

        return false;
    }

    public  function salvar(Editora $editora)
    {
        try {

            $nome           = $editora->getNome();

            return $this->insert(
                'editora',
                ":nome",
                [
                    ':nome'=>$nome
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Editora $editora)
    {
        try {

            $id             = $editora->getId();
            $nome           = $editora->getNome();

            return $this->update(
                'editora',
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

    public function excluir(Editora $editora)
    {
        try {
            $id = $editora->getId();

            return $this->delete('editora',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}