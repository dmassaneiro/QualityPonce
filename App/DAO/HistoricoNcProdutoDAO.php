<?php

class HistoricoNcProdutoDAO {
    
    public function Inserir(HistoricoConformidadeProduto $historicoNc) {
        try {
            $sql = "INSERT INTO historicoconformidadeproduto (    
                  data,
                  statusId,
                  funcionarioId,
                  naoConformidadeProdutoId)
                  VALUES (
                  :data,
                  :statusId,
                  :funcionarioId,
                  :naoConformidadeProdutoId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":data", $historicoNc->getData());
            $p_sql->bindValue(":statusId", $historicoNc->getStatusId());
            $p_sql->bindValue(":funcionarioId", $historicoNc->getFuncionarioId());
            $p_sql->bindValue(":naoConformidadeProdutoId", $historicoNc->getNaoConformidadeProdutoId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o historico" . $e;
        }
    }
    
    public function Deletar($produtoId) {
        try {
            $sql = "DELETE FROM historicoconformidadeproduto WHERE naoConformidadeProdutoId = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $produtoId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }
    
    public function BuscarTodosHistoricoNC($idnc) {
        try {
            $sql = "SELECT * FROM historicoconformidadeproduto where naoConformidadeProdutoId = '$idnc' order by data desc";
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
            $sql = "SELECT * FROM historicoconformidadeproduto where naoConformidadeProdutoId = '$idnc' order by data desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
  
    private function Lista($row) {
        $histNc = new HistoricoConformidadeProduto();

        $histNc->setId($row['id']);
        $histNc->setData($row['data']);
        $histNc->setStatusId($row['statusId']);
        $histNc->setFuncionarioId($row['funcionarioId']);
        $histNc->setNaoConformidadeProdutoId($row['naoConformidadeProdutoId']);
        
        return $histNc;
    }
}
