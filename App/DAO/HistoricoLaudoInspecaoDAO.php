<?php

class HistoricoLaudoInspecaoDAO {
    
    public function Inserir(HistoricoLaudo $dados) {
        try {
            $sql = "INSERT INTO historicolaudo (    
                  data,
                  statusId,
                  funcionarioId,
                  laudoInspecaoId)
                  VALUES (
                  :data,
                  :statusId,
                  :funcionarioId,
                  :laudoInspecaoId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":data", $dados->getData());
            $p_sql->bindValue(":statusId", $dados->getStatusId());
            $p_sql->bindValue(":funcionarioId", $dados->getFuncionarioId());
            $p_sql->bindValue(":laudoInspecaoId", $dados->getLaudoInspecaoId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }
    
    public function Deletar($id) {
        try {
            $sql = "DELETE FROM historicolaudo WHERE laudoInspecaoId = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }
    
    public function BuscarTodosHistorico($id) {
        try {
            $sql = "SELECT * FROM historicolaudo where laudoInspecaoId = '$id' order by data desc";
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
     public function BuscarTodosHistoricoFuncionario($id) {
        try {
            $sql = "SELECT * FROM historicolaudo where laudoInspecaoId = '$id' order by data desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
  
    private function Lista($row) {
        $obj = new HistoricoLaudo();

        $obj->setId($row['id']);
        $obj->setData($row['data']);
        $obj->setStatusId($row['statusId']);
        $obj->setFuncionarioId($row['funcionarioId']);
        $obj->setLaudoInspecaoId($row['laudoInspecaoId']);
        
        return $obj;
    }
}
