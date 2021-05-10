<?php

namespace App\Models\DAO;

use App\Models\Entidades\Aluno;

class AlunoDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT a.id as idAluno,
                    t.id as idTurma,
                    a.nome as nomeAluno,
             FROM aluno as a
             INNER JOIN turma as t ON a.turmaId = t.id
             WHERE a.id = $id"
        );

        $dataSetAlunos = $resultado->fetch();

        if($dataSetAlunos) {
            $Aluno = new Aluno();
            $Aluno->setId($dataSetAlunos['idAluno']);
            $Aluno->setNome($dataSetAlunos['nomeAluno']);
            $Aluno->getTurma()->setNome($dataSetAlunos['nomeTurma']);
            $Aluno->getTurma()->setId($dataSetAlunos['idTurma']);

            return $Aluno;
        }

        return false;
    }

    public  function listar()
    {

            $resultado = $this->select(
                'SELECT  a.id as idAluno, 
                              a.nome as nomeAluno, 
                              t.nome as nomeTurma 
                              FROM aluno as a
                      INNER JOIN turma as t ON a.turmaId = t.id 
                      '
            );
            $dataSetAlunos = $resultado->fetchAll();

            if($dataSetAlunos) {

                $listaAlunos = [];

                foreach($dataSetAlunos as $dataSetAluno) {
                    $Aluno = new Aluno();
                    $Aluno->setId($dataSetAluno['idAluno']);
                    $Aluno->setNome($dataSetAluno['nomeAluno']);
                    $Aluno->getTurma()->setNome($dataSetAluno['nomeTurma']);

                    $listaAlunos[] = $Aluno;
                }

                return $listaAlunos;
            }

        return false;
    }

    public  function salvar(Aluno $aluno) 
    {
        try {

            $nome           = $aluno->getNome();
            $turmaId        = $aluno->getTurma()->getId();

            return $this->insert(
                'aluno',
                ":nome,:turmaId",
                [
                    ':nome'=>$nome,
                    ':turmaId'=>$turmaId,
                ]
            );

        } catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Aluno $aluno) 
    {
        try {

            $id             = $aluno->getId();
            $nome           = $aluno->getNome();
            $turmaId        = $aluno->getTurma()->getId();

            return $this->update(
                'aluno',
                "nome = :nome, turmaId = :turmaId",
                [
                    ':id'=>$id,
                    ':nome'=>$nome,
                    ':turmaId'=> $turmaId,
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Aluno $aluno)
    {
        try {
            $id = $aluno->getId();

            return $this->delete('aluno',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}