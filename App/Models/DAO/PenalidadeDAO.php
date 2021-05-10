<?php

namespace App\Models\DAO;

use App\Models\Entidades\Penalidade;

class PenalidadeDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT p.id as idPenalidade,
                    a.id as idAluno 
                    p.dataInicio, 
                    p.dataTermino, 
             FROM penalidade as p
             INNER JOIN aluno as a ON p.alunoId = a.id
             WHERE p.id = $id"
        );

        $dataSetPenalidades = $resultado->fetch();

        if($dataSetPenalidades) {
            $Penalidade = new Penalidade();
            $Penalidade->setId($dataSetPenalidades['idPenalidade']);
            $Penalidade->setDataInicio($dataSetPenalidades['dataInicio']);
            $Penalidade->setDataTermino($dataSetPenalidades['dataTermino']);
            $Penalidade->getAluno()->setId($dataSetPenalidades['idAluno']);

            return $Penalidade;
        }

        return false;
    }

    public  function listar()
    {

            $resultado = $this->select(
                'SELECT  p.id as idPenalidade, 
                              p.dataInicio, 
                              p.dataTermino, 
                              a.id as idAluno 
                              FROM penalidade as p
                      INNER JOIN aluno as a ON p.alunoId = a.id 
                      '
            );
            $dataSetPenalidades = $resultado->fetchAll();

            if($dataSetPenalidades) {

                $listaPenalidades = [];

                foreach($dataSetPenalidades as $dataSetPenalidade) {
                    $Penalidade = new Penalidade();
                    $Penalidade->setId($dataSetPenalidade['idPenalidade']);
                    $Penalidade->setDataInicio($dataSetPenalidade['dataInicio']);
                    $Penalidade->setDataTermino($dataSetPenalidade['dataTermino']);
                    $Penalidade->getAluno()->setIdAluno($dataSetPenalidade['idAluno']);

                    $listaPenalidades[] = $Penalidade;
                }

                return $listaPenalidades;
            }

        return false;
    }

    public  function salvar(Penalidade $penalidade) 
    {
        try {

            $id           = $penalidade->getId();
            $dataInicio   = $penalidade->getDataInicio();
            $dataTermino  = $penalidade->getDataTermino();
            $alunoId      = $penalidade->getAluno()->getId();

            return $this->insert(
                'penalidade',
                ":id,:dataInicio,:dataTermino,:alunoId",
                [
                    ':id'=>$id,
                    ':dataInicio'=>$dataInicio,
                    ':dataTermino'=>$dataTermino,
                    ':alunoId'=>$alunoId,
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Penalidade $penalidade) 
    {
        try {

            $id             = $penalidade->getId();
            $dataInicio     = $penalidade->getDataInicio();
            $dataTermino    = $penalidade->getDataTermino();
            $alunoId        = $penalidade->getAluno()->getId();

            return $this->update(
                'penalidade',
                "dataInicio = :dataInicio, dataTermino = :dataTermino, alunoId = :alunoId",
                [
                    ':id'=>$id,
                    ':dataInicio'=>$dataInicio,
                    ':dataTermino'=>$dataTermino,
                    ':alunoId'=> $alunoId,
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Penalidade $penalidade)
    {
        try {
            $id = $penalidade->getId();

            return $this->delete('penalidade',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}