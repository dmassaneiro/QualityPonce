<?php

class HistoricoNcProcessoDAO {
    
    public function Inserir(HistoricoNaoConformidade $historicoNc) {
        try {
            $sql = "INSERT INTO historiconaoconformidade (    
                  data,
                  statusId,
                  funcionarioId,
                  naoConformidadeId)
                  VALUES (
                  :data,
                  :statusId,
                  :funcionarioId,
                  :naoConformidadeId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":data", $historicoNc->getData());
            $p_sql->bindValue(":statusId", $historicoNc->getStatusId());
            $p_sql->bindValue(":funcionarioId", $historicoNc->getFuncionarioId());
            $p_sql->bindValue(":naoConformidadeId", $historicoNc->getNaoConformidadeId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o historico" . $e;
        }
    }
    public function Editar(Produto $produto) {
        try {
            $sql = "UPDATE produto set
                
                  nome=:nome,
                  descricao=:descricao,
                  categoriaId=:categoriaId,
                  situacao=:situacao
                                   
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $produto->getNome());
            $p_sql->bindValue(":descricao", $produto->getDescricao());
            $p_sql->bindValue(":categoriaId", $produto->getCategoriaId());
            $p_sql->bindValue(":situacao", $produto->getSituacao());
           
            $p_sql->bindValue(":id", $produto->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }
    
    public function Deletar($produtoId) {
        try {
            $sql = "DELETE FROM historiconaoconformidade WHERE naoConformidadeId = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $produtoId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }
    
    public function BuscarTodosHistoricoNC($idnc) {
        try {
            $sql = "SELECT * FROM historiconaoconformidade where naoConformidadeId = '$idnc' order by data desc";
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
     public function BuscarTodosHistoricoNCFuncionario($idnc) {
        try {
            $sql = "SELECT * FROM historiconaoconformidade where naoConformidadeId = '$idnc' order by data desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
  
    private function Lista($row) {
        $histNc = new HistoricoNaoConformidade();

        $histNc->setId($row['id']);
        $histNc->setData($row['data']);
        $histNc->setStatusId($row['statusId']);
        $histNc->setFuncionarioId($row['funcionarioId']);
        $histNc->setNaoConformidadeId($row['naoConformidadeId']);
        
        return $histNc;
    }
}
