<?php

namespace App\Models\DAO;

use App\Models\Entidades\Espera;

class EsperaDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT id, idLivro, alunoNaFrente FROM espera WHERE id = $id"
        );

        return $resultado->fetchObject(Espera::class);

    }
    public  function listar()
    {

        $resultado = $this->select(
            'SELECT id, idLivro, alunoNaFrente FROM espera'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Espera::class);

    }

    public  function salvar(Espera $espera)
    {
        try {

            $idLivro           = $espera->getIdLivro();

            return $this->insert(
                'espera',
                ":alunoNaFrente",
                [
                    ':idLivro'=>$idLivro,
                    ':alunoNaFrente'=>$alunoNaFrente
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Espera $espera)
    {
        try {

            $id             = $espera->getId();
            $idLivro        = $espera->getIdLivro();
            $alunoNaFrente  = $espera->getAlunoNaFrente();

            return $this->update(
                'espera',
                "idLivro = :idLivro",
                "alunoNaFrente = :alunoNaFrente",
                [
                    ':id'=>$id,
                    ':idLivro'=>$idLivro,
                    ':alunoNaFrente'=>$alunoNaFrente,
                ],
                "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Espera $espera)
    {
        try {
            $id = $espera->getId();

            return $this->delete('espera',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}