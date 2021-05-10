<?php

namespace App\Models\DAO;

use App\Models\Entidades\Turma;

class TurmaDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT id, nome, periodo FROM turma WHERE id = $id"
        );

        return $resultado->fetchObject(Turma::class);

    }
    public  function listar()
    {

        $resultado = $this->select(
            'SELECT id, nome, periodo FROM turma'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Turma::class);

    }

    public  function salvar(Turma $turma)
    {
        try {

            $nome           = $turma->getNome();

            return $this->insert(
                'turma',
                ":nome",
                ":periodo",
                [
                    ':nome'=>$nome,
                    ':periodo'=>$periodo
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Turma $turma)
    {
        try {

            $id             = $turma->getId();
            $nome           = $turma->getNome();
            $periodo        = $periodo->getPeriodo();

            return $this->update(
                'turma',
                "nome = :nome",
                "periodo = :periodo",
                [
                    ':id'=>$id,
                    ':nome'=>$nome,
                    ':periodo'=>$periodo,
                ],
                "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Turma $turma)
    {
        try {
            $id = $turma->getId();

            return $this->delete('turma',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}