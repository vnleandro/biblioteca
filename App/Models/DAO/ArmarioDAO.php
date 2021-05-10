<?php

namespace App\Models\DAO;

use App\Models\Entidades\Armario;

class ArmarioDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            // C = CABINET (ARMARIO EM INGLES)
            "SELECT c.id as idArmario,
                    c.disponivel as disponivelArmario,
                    a.id as idAluno, 
             FROM armario as c
             INNER JOIN aluno as a ON c.alunoId = a.id
             WHERE c.id = $id"
        );

        $dataSetArmarios = $resultado->fetch();

        if($dataSetArmarios) {
            $Armario = new Armario();
            $Armario->setId($dataSetArmarios['idArmario']);
            $Armario->setDisponivel($dataSetArmarios['disponivel']);
            $Armario->getAluno()->setId($dataSetArmarios['idAluno']);

            return $Armario;
        }

        return false;
    }

    public  function listar()
    {
            $resultado = $this->select(
                // C = CABINET (ARMARIO EM INGLES)
                'SELECT  c.id as idArmario, 
                              c.disponivel as disponivelArmario, 
                              a.nome as nomeAluno 
                              FROM armario as c
                      INNER JOIN aluno as a ON c.alunoId = a.id 
                      '
            );
            $dataSetArmarios = $resultado->fetchAll();

            if($dataSetArmarios) {

                $listaArmarios = [];

                foreach($dataSetArmarios as $dataSetArmario) {
                    $Armario = new Armario();
                    $Armario->setId($dataSetArmario['idArmario']);
                    $Armario->getEditora()->setNome($dataSetArmario['nomeAluno']);
                    $Armario->getDisponivel()->setDisponivel($dataSetArmario['disponivel']);

                    $listaArmarios[] = $Armario;
                }

                return $listaArmarios;
            }

        return false;
    }

    public  function salvar(Armario $armario) 
    {
        try {

            $alunoId         = $armario->getAluno()->getId();
            $disponivel      = $armario->getDisponivel();

            return $this->insert(
                'armario',
                ":alunoId,:disponivel",
                [
                    ':alunoId'=>$alunoId,
                    ':disponivel'=>$disponivel,
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Armario $armario) 
    {
        try {

            $id             = $armario->getId();
            $alunoId        = $armario->getAluno()->getId();
            $disponivel     = $armario->getDisponivel();

            return $this->update(
                'armario',
                "alunoId = :alunoId, disponivel = :disponivel",
                [
                    ':id'=>$id,
                    ':alunoId'=> $alunoId,
                    ':disponivel'=> $disponivel,
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Armario $armario)
    {
        try {
            $id = $armario->getId();

            return $this->delete('armario',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}