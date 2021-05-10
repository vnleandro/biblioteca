<?php

namespace App\Models\DAO;

use App\Models\Entidades\Livro;

class LivroDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT l.id as idLivro,
                    g.id as idGenero,
                    a.id as idAutor,
                    e.id as idEditora,
                    l.nome as nomeLivro,
                    l.descricao,
                    l.disponivel,
                    a.nome as nomeAutor 
                    e.nome as nomeEditora 
             FROM livro as l
             INNER JOIN editora as e ON l.editora_id = e.id
             WHERE l.id = $id"
        );

        $dataSetLivros = $resultado->fetch();

        if($dataSetLivros) {
            $Livro = new Livro();
            $Livro->setId($dataSetLivros['idLivro']);
            $Livro->setNome($dataSetLivros['nomeLivro']);
            $Livro->setDescricao($dataSetLivros['descricao']);
            $Livro->setDisponivel($dataSetLivros['disponivel']);
            $Livro->getGenero()->setId($dataSetLivros['idGenero']);
            $Livro->getAutor()->setNome($dataSetLivros['nomeAutor']);
            $Livro->getAutor()->setId($dataSetLivros['idAutor']);
            $Livro->getEditora()->setNome($dataSetLivros['nomeEditora']);
            $Livro->getEditora()->setId($dataSetLivros['idEditora']);

            return $Livro;
        }

        return false;
    }

    public  function listar()
    {

            $resultado = $this->select(
                'SELECT  l.id as idLivro, 
                              l.nome as nomeLivro, 
                              l.disponivel,
                              a.nome as nomeAutor, 
                              e.nome as nomeEditora 
                              FROM livro as l
                      INNER JOIN editora as e ON l.editora_id = e.id 
                      '
            );
            $dataSetLivros = $resultado->fetchAll();

            if($dataSetLivros) {

                $listaLivros = [];

                foreach($dataSetLivros as $dataSetLivro) {
                    $Livro = new Livro();
                    $Livro->setId($dataSetLivro['idLivro']);
                    $Livro->setNome($dataSetLivro['nomeLivro']);
                    $Livro->setDisponivel($dataSetLivro['disponivel']);
                    $Livro->getAutor()->setNome($dataSetLivro['nomeAutor']);
                    $Livro->getEditora()->setNome($dataSetLivro['nomeEditora']);

                    $listaLivros[] = $Livro;
                }

                return $listaLivros;
            }

        return false;
    }

    public  function salvar(Livro $livro) 
    {
        try {

            $nome        = $livro->getNome();
            $descricao   = $livro->getDescricao();
            $disponivel  = $livro->getDisponivel();
            $generoId    = $livro->getGenero()->getId();
            $autorId     = $livro->getAutor()->getId();
            $editoraId   = $livro->getEditora()->getId();

            return $this->insert(
                'livro',
                ":nome,:descricao,:disponivel,:generoId,:autorId,:editoraId",
                [
                    ':nome'=>$nome,
                    ':descricao'=>$descricao,
                    ':disponivel'=>$disponivel,
                    ':generoId'=>$generoId,
                    ':autorId'=>$autorId,
                    ':editoraId'=>$editoraId,
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Livro $livro) 
    {
        try {

            $id          = $livro->getId();
            $nome        = $livro->getNome();
            $descricao   = $livro->getDescricao();
            $disponivel  = $livro->getDisponivel();
            $generoId    = $livro->getGenero()->getId();
            $autorId     = $livro->getAutor()->getId();
            $editoraId   = $livro->getEditora()->getId();

            return $this->update(
                'livro',
                "nome = :nome, descricao = :descricao, disponivel = :disponivel, generoId = :generoId, autorId = :autorId, editoraId = :editoraId",
                [
                    ':id'=>$id,
                    ':nome'=>$nome,
                    ':descricao'=>$descricao,
                    ':disponivel'=>$disponivel,
                    ':generoId'=> $generoId,
                    ':autorId'=> $autorId,
                    ':editoraId'=> $editoraId,
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Livro $livro)
    {
        try {
            $id = $livro->getId();

            return $this->delete('livro',"id = $id");

        }catch (Exception $e){

            throw new \Exception("Erro ao excluir", 500);
        }
    }
}