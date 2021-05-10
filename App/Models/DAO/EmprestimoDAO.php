<?php

namespace App\Models\DAO;

use App\Models\Entidades\Livro;

class EmprestimoDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT e.id as idEmprestimo,
                    a.id as idAluno,
                    l.id as idLivro,
                    e.demprestimo as dataEmprestimo, 
                    e.dlimite, 
                    e.ddevolvido as dataDevolvido 
             FROM emprestimo as e
             INNER JOIN aluno as a ON a.alunoId = a.id
             WHERE e.id = $id"
        );

        $dataSetEmprestimos = $resultado->fetch();

        if($dataSetEmprestimos) {
            $Emprestimo = new Emprestimo();
            $Emprestimo->setId($dataSetEmprestimos['idEmprestimo']);
            $Emprestimo->getAluno()->setId($dataSetEmprestimos['idAluno']);
            $Emprestimo->getLivro()->setId($dataSetEmprestimos['idLivro']);
            $Emprestimo->setDataEmprestimo($dataSetEmprestimos['dataEmprestimo']);
            $Emprestimo->setDataLimite($dataSetEmprestimos['dataLimite']);
            $Emprestimo->setDataDevolvido($dataSetEmprestimos['dataDevolvido']);

            return $Emprestimo;
        }

        return false;
    }

    public  function listar()
    {

            $resultado = $this->select(
                'SELECT e.id as idEmprestimo, 
                        a.id as idAluno, 
                        l.id as idLivro,
                        e.demprestimo as dataEmprestimo, 
                        e.dlimite, 
                        e.ddevolvido as dataDevolvido
                 FROM emprestimo as e
                 INNER JOIN aluno as a ON a.alunoId = a.id
                 WHERE e.id = $id'
            );

            $dataSetEmprestimos = $resultado->fetchAll();

            if($dataSetEmprestimos) {

                $listaEmprestimos = [];

                foreach($dataSetEmprestimos as $dataSetEmprestimo) {
                    $Emprestimo = new Emprestimo();
                    $Emprestimo->setId($dataSetEmprestimo['idEmprestimo']);
                    $Emprestimo->getAluno()->setIdAluno($dataSetEmprestimo['idAluno']);
                    $Emprestimo->getLivro()->setIdLivro($dataSetEmprestimo['idLivro']);
                    $Emprestimo->setDataEmprestimo($dataSetEmprestimo['dataEmprestimo']);
                    $Emprestimo->setDataLimite($dataSetEmprestimo['dataLimite']);
                    $Emprestimo->setDataDevolvido($dataSetEmprestimo['dataDevolvido']);

                    $listaEmprestimos[] = $Emprestimo;
                }

                return $listaEmprestimos;
            }

        return false;
    }

    public  function salvar(Emprestimo $emprestimo) 
    {
        try {

            $alunoId        = $emprestimo->getAluno()->getId();
            $livroId        = $emprestimo->getLivro()->getId();
            $dataEmprestimo = $emprestimo->getDataEmprestimo();
            $dataLimite     = $emprestimo->getDataLimite();
            $dataDevolvido  = $emprestimo->getDataDevolvido();

            return $this->insert(
                'emprestimo',
                ":alunoId,:livroId,:dataEmprestimo,:dataLimite,:dataDevolvido",
                [
                    ':alunoId'=>$alunoId,
                    ':livroId'=>$livroId,
                    ':dataEmprestimo'=>$dataEmprestimo,
                    ':dataLimite'=>$dataLimite,
                    ':dataDevolvido'=>$dataDevolvido,
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Emprestimo $emprestimo) 
    {
        try {

            $id             = $emprestimo->getId();
            $alunoId        = $emprestimo->getAluno()->getId();
            $livroId        = $emprestimo->getLivro()->getId();
            $dataEmprestimo = $emprestimo->getDataEmprestimo();
            $dataLimite     = $emprestimo->getDataLimite();
            $dataDevolvido  = $emprestimo->getDataDevolvido();

            return $this->update(
                'emprestimo',
                "alunoId = :alunoId, livroId = :livroId, dataEmprestimo = :dataEmprestimo, dataLimite = :dataLimite, dataDevolvido = :dataDevolvido",
                [
                    ':id'=>$id,
                    ':alunoId'=>$alunoId,
                    ':livroId'=>$livroId,
                    ':dataEmprestimo'=>$dataEmprestimo,
                    ':dataLimite'=>$dataLimite,
                    ':dataDevolvido'=> $dataDevolvido,
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Emprestimo $emprestimo)
    {
        try {
            $id = $emprestimo->getId();

            return $this->delete('emprestimo',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}