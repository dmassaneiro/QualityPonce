<?php

class HistoricoDocumentosDAO {
    
    public function Inserir(HistorioDocumentos $dados) {
        try {
            $sql = "INSERT INTO historicodocumentos (    
                  data,
                  statusId,
                  funcionarioId,
                  documentoId)
                  VALUES (
                  :data,
                  :statusId,
                  :funcionarioId,
                  :documentoId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":data", $dados->getData());
            $p_sql->bindValue(":statusId", $dados->getStatusId());
            $p_sql->bindValue(":funcionarioId", $dados->getFuncionarioId());
            $p_sql->bindValue(":documentoId", $dados->getDocumentoId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o historico" . $e;
        }
    }
    
    public function Deletar($produtoId) {
        try {
            $sql = "DELETE FROM historicodocumentos WHERE documentoId = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $produtoId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }
    
    public function BuscarTodosHistorico($idnc) {
        try {
            $sql = "SELECT * FROM historicodocumentos where documentoId = '$idnc' order by id desc";
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
        $dados = new HistorioDocumentos();

        $dados->setId($row['id']);
        $dados->setData($row['data']);
        $dados->setStatusId($row['statusId']);
        $dados->setFuncionarioId($row['funcionarioId']);
        $dados->setDocumentoId($row['documentoId']);
        
        return $dados;
    }
}
