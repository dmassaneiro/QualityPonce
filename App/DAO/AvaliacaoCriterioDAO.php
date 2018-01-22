<?php

class AvaliacaoCriterioDAO {

    public function Inserir(AvaliacaoCriterio $obj) {
        try {
            $sql = "INSERT INTO avaliacaocriterio (    
                  avaliacaoFornecedorId,
                  criterioFornecedorId,
                  pontuacao)
                  VALUES (
                  :avaliacaoFornecedorId,
                  :criterioFornecedorId,
                  :pontuacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":avaliacaoFornecedorId", $obj->getAvaliacaoFornecedorId());
            $p_sql->bindValue(":criterioFornecedorId", $obj->getCriterioFornecedorId());
            $p_sql->bindValue(":pontuacao", $obj->getPontuacao());
          
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }
    
    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM avaliacaocriterio order by avaliacaoFornecedorId asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->lista($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    public function BuscarTodosID($id) {
        try {
            $sql = "SELECT * FROM avaliacaocriterio WHERE avaliacaoFornecedorId ='$id' order by avaliacaoFornecedorId asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->lista($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    private function Lista($row) {
        $dados = new AvaliacaoCriterio();

//        $dados->setId($row['id']);
        $dados->setAvaliacaoFornecedorId($row['avaliacaoFornecedorId']);
        $dados->setCriterioFornecedorId($row['criterioFornecedorId']);
        $dados->setPontuacao($row['pontuacao']);
        
        return $dados;
    }
     public function BuscarNomeCategoria($categoriaId) {
        try {
            $sql = "SELECT * FROM categoria WHERE id = '$categoriaId'
                     order by descricao desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar.".$e;
        }
    }

    private function listaNome($row) {
        $cat2 = new Categoria();
        $cat2->setDescricao($row['descricao']);

        return $cat2;
    }
 public function Deletar($Id) {
        try {
            $sql = "DELETE FROM avaliacaocriterio WHERE avaliacaoFornecedorId = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

}
