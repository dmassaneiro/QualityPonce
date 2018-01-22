<?php

class StatusDAO {

    public function BuscarNomeStatus($statusId) {
        try {
            $sql = "SELECT * FROM status WHERE id = '$statusId'
                     order by descricao desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaStatus($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function BuscarNomeFuncionariodoStatus($idnc) {
        try {
            $sql = "SELECT * FROM status WHERE id = '$idnc'
                     order by id asc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaStatus($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function listaStatus($row) {
        $status = new Status();
        $status->setId($row['id']);
        $status->setDescricao($row['descricao']);

        return $status;
    }

}
