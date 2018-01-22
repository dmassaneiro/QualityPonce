<?php

class NcProdutoDAO {
   public function Inserir(NaoConformidadeProduto $nc) {
        try {
            $sql = "INSERT INTO naoconformidadeproduto (    
               
                  dataEmissao,
                  controle,
                  descricao,
                  acaoExcutada,
                  destino,
                  responsavel,
                  responsavel2,
                  responsavel3,
                  investigar,
                  notificados,
                  statusId,
                  tipoNaoConformidadeProdutoId)
                  
                  VALUES (
                  :dataEmissao,
                  :controle,
                  :descricao,
                  :acaoExcutada,
                  :destino,
                  :responsavel,
                  :responsavel2,
                  :responsavel3,
                  :investigar,
                  :notificados,
                  :statusId,
                  :tipoNaoConformidadeProdutoId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataEmissao", $nc->getDataEmissao());
            $p_sql->bindValue(":controle", $nc->getControle());
            $p_sql->bindValue(":descricao", $nc->getDescricao());
            $p_sql->bindValue(":acaoExcutada", $nc->getAcaoExecutada());
            $p_sql->bindValue(":destino", $nc->getDestino());
            $p_sql->bindValue(":responsavel", $nc->getResponsavel1());
            $p_sql->bindValue(":responsavel2", $nc->getResponsavel2());
            $p_sql->bindValue(":responsavel3", $nc->getResponsavel3());
            $p_sql->bindValue(":investigar", $nc->getInvestigar());
            $p_sql->bindValue(":notificados", $nc->getNotificados());
            $p_sql->bindValue(":statusId", $nc->getStatusId());
            $p_sql->bindValue(":tipoNaoConformidadeProdutoId", $nc->getTipoNaoConformidadeProdutoId());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(NaoConformidadeProduto $nc) {
        try {
            $sql = "UPDATE naoconformidadeproduto set
                
                  dataEmissao=:dataEmissao,
                  descricao=:descricao,
                  acaoExcutada=:acaoExcutada,
                  destino=:destino,
                  responsavel=:responsavel,
                  responsavel2=:responsavel2,
                  responsavel3=:responsavel3,
                  investigar=:investigar,
                  notificados=:notificados,
                  statusId=:statusId,
                  tipoNaoConformidadeProdutoId=:tipoNaoConformidadeProdutoId,
                  controle=:controle
                
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataEmissao", $nc->getDataEmissao());
            $p_sql->bindValue(":descricao", $nc->getDescricao());
            $p_sql->bindValue(":acaoExcutada", $nc->getAcaoExecutada());
            $p_sql->bindValue(":destino", $nc->getDestino());
            $p_sql->bindValue(":responsavel", $nc->getResponsavel1());
            $p_sql->bindValue(":responsavel2", $nc->getResponsavel2());
            $p_sql->bindValue(":responsavel3", $nc->getResponsavel3());
            $p_sql->bindValue(":investigar", $nc->getInvestigar());
            $p_sql->bindValue(":notificados", $nc->getNotificados());
            $p_sql->bindValue(":statusId", $nc->getStatusId());
            $p_sql->bindValue(":tipoNaoConformidadeProdutoId", $nc->getTipoNaoConformidadeProdutoId());
            $p_sql->bindValue(":controle", $nc->getControle());

            $p_sql->bindValue(":id", $nc->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($setorId) {
        try {
            $sql = "DELETE FROM naoconformidadeproduto WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $setorId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarUltimoRegistro() {
        try {
            $sql = "SELECT id FROM naoconformidadeproduto ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodosNcProduto() {
        try {
            $sql = "SELECT * FROM naoconformidadeproduto order by id desc";
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

    public function BuscarTodosNcProdutosStatus($statusID) {
        try {
            $sql = "SELECT * FROM naoconformidadeproduto
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
    public function BuscarTodosNcProdutosControle($controle) {
        try {
            $sql = "SELECT * FROM naoconformidadeproduto
                    WHERE controle = '$controle' order by id desc";
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
    public function BuscarTodosNcProdutoPeriodo($inicio,$fim) {
        try {
            $sql = "SELECT * FROM naoconformidadeproduto
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

   

    public function BuscarRegistroParaEditar($id) {
        try {
            $sql = "SELECT * FROM naoconformidadeproduto where id='$id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function ListaId($id) {
        $ncid = new NaoConformidadeProduto();

        $ncid->setId($id['id']);

        return $ncid;
    }

    function Lista($row) {
        $nc = new NaoConformidadeProduto();

        $nc->setId($row['id']);
        $nc->setControle($row['controle']);
        $nc->setDataEmissao($row['dataEmissao']);
        $nc->setDescricao($row['descricao']);
        $nc->setAcaoExecutada($row['acaoExcutada']);
        $nc->setDestino($row['destino']);
        $nc->setResponsavel1($row['responsavel']);
        $nc->setResponsavel2($row['responsavel2']);
        $nc->setResponsavel3($row['responsavel3']);
        $nc->setInvestigar($row['investigar']);
        $nc->setNotificados($row['notificados']);
        $nc->setTipoNaoConformidadeProdutoId($row['tipoNaoConformidadeProdutoId']);
        $nc->setStatusId($row['statusId']);
     
        return $nc;
    }
}
