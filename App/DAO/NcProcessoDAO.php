<?php

class NcProcessoDAO {

    public function Inserir(NaoConformidade $nc) {
        try {
            $sql = "INSERT INTO naoconformidade (    
               
                  dataEmissao,
                  descricao,
                  justificativa,
                  acaoExcutada,
                  gravidade,
                  notificado,
                  AcaoCorretiva,
                  tipoNaoConformidadeId,
                  setorId,
                  statusId)
                  
                  VALUES (
                  :dataEmissao,
                  :descricao,
                  :justificativa,
                  :acaoExcutada,
                  :gravidade,
                  :notificado,
                  :AcaoCorretiva,
                  :tipoNaoConformidadeId,
                  :setorId,
                  :statusId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataEmissao", $nc->getDataEmisao());
            $p_sql->bindValue(":descricao", $nc->getDescricao());
            $p_sql->bindValue(":justificativa", $nc->getJustifiva());
            $p_sql->bindValue(":acaoExcutada", $nc->getAcaoExecutada());
            $p_sql->bindValue(":gravidade", $nc->getGravidade());
            $p_sql->bindValue(":notificado", $nc->getNotificado());
            $p_sql->bindValue(":AcaoCorretiva", $nc->getAcaoCorretiva());
            $p_sql->bindValue(":tipoNaoConformidadeId", $nc->getTipoNaoConformidadeId());
            $p_sql->bindValue(":setorId", $nc->getSetorId());
            $p_sql->bindValue(":statusId", $nc->getStatusId());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(NaoConformidade $nc) {
        try {
            $sql = "UPDATE naoconformidade set
                
                  dataEmissao=:dataEmissao,
                  descricao=:descricao,
                  justificativa=:justificativa,
                  acaoExcutada=:acaoExcutada,
                  gravidade=:gravidade,
                  notificado=:notificado,
                  AcaoCorretiva=:AcaoCorretiva,
                  tipoNaoConformidadeId=:tipoNaoConformidadeId,
                  setorId=:setorId,
                  statusId=:statusId
                
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataEmissao", $nc->getDataEmisao());
            $p_sql->bindValue(":descricao", $nc->getDescricao());
            $p_sql->bindValue(":justificativa", $nc->getJustifiva());
            $p_sql->bindValue(":acaoExcutada", $nc->getAcaoExecutada());
            $p_sql->bindValue(":gravidade", $nc->getGravidade());
            $p_sql->bindValue(":notificado", $nc->getNotificado());
            $p_sql->bindValue(":AcaoCorretiva", $nc->getAcaoCorretiva());
            $p_sql->bindValue(":tipoNaoConformidadeId", $nc->getTipoNaoConformidadeId());
            $p_sql->bindValue(":setorId", $nc->getSetorId());
            $p_sql->bindValue(":statusId", $nc->getStatusId());

            $p_sql->bindValue(":id", $nc->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($setorId) {
        try {
            $sql = "DELETE FROM naoconformidade WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $setorId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarUltimoRegistro() {
        try {
            $sql = "SELECT id FROM naoconformidade ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodosNcProcesso() {
        try {
            $sql = "SELECT * FROM naoconformidade order by id desc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->Lista($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarTodosNcProcessoStatus($statusID) {
        try {
            $sql = "SELECT * FROM naoconformidade
                    WHERE statusId = '$statusID' order by id desc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->Lista($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    public function BuscarTodosNcProcessoPeriodo($inicio,$fim) {
        try {
            $sql = "SELECT * FROM naoconformidade
                    WHERE dataEmissao between '$inicio' and '$fim' order by id desc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->Lista($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarTodosNcProcessoSetor($setor) {
        try {
            $sql = "SELECT n.id as id, n.dataEmissao as dataEmissao, n.descricao as descricao,
                n.justificativa as justificativa, n.acaoExcutada as acaoExcutada, 
                n.gravidade as gravidade, n.notificado as notificado, 
                n.tipoNaoConformidadeId as tipoNaoConformidadeId, n.setorId as setorId, 
                n.statusId as statusId, n.acaoCorretiva as acaoCorretiva,s.descricao 
                FROM naoconformidade n
                INNER JOIN setor as s ON(setorId = s.id)
                WHERE s.descricao LIKE '%$setor%'
                order by n.id desc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->Lista($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarRegistroParaEditar($id) {
        try {
            $sql = "SELECT * FROM naoconformidade where id='$id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function ListaId($id) {
        $ncid = new NaoConformidade();

        $ncid->setId($id['id']);

        return $ncid;
    }

    function Lista($row) {
        $nc = new NaoConformidade();

        $nc->setId($row['id']);
        $nc->setDataEmisao($row['dataEmissao']);
        $nc->setDescricao($row['descricao']);
        $nc->setJustifiva($row['justificativa']);
        $nc->setAcaoExecutada($row['acaoExcutada']);
        $nc->setAcaoCorretiva($row['acaoCorretiva']);
        $nc->setGravidade($row['gravidade']);
        $nc->setNotificado($row['notificado']);
        $nc->setTipoNaoConformidadeId($row['tipoNaoConformidadeId']);
        $nc->setSetorId($row['setorId']);
        $nc->setStatusId($row['statusId']);


        return $nc;
    }

}
