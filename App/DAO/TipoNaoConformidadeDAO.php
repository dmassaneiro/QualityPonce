<?php

class TipoNaoConformidadeDAO {

    public function Inserir(TipoNaoConformidade $tiponc ){
        try {
            $sql = "INSERT INTO tiponaoconformidade (    
               
                  descricao)
                  VALUES (
                  :descricao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);


            $p_sql->bindValue(":descricao", $tiponc->getDescricao());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(TipoNaoConformidade $tiponc) {
        try {
            $sql = "UPDATE tiponaoconformidade set
                
                  descricao=:descricao
                                                     
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $tiponc->getDescricao());

            $p_sql->bindValue(":id", $tiponc->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($tiponcId) {
        try {
            $sql = "DELETE FROM tiponaoconformidade WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $tiponcId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarNomeNC($ncId) {
        try {
            $sql = "SELECT * FROM tiponaoconformidade WHERE id = '$ncId'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar.".$e;
        }
    }
    public function VerificaParaDeletar($ncId) {
        try {
            $sql = "SELECT count(id) as id FROM naoconformidade WHERE tipoNaoConformidadeId = '$ncId'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar.".$e;
        }
    }
    
    
    public function BuscarTodosNcProcesso() {
        try {
            $sql = "SELECT * FROM tiponaoconformidade order by descricao asc";
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
    public function BuscarTodosNcProcessoDescricao($desc) {
        try {
            $sql = "SELECT * FROM tiponaoconformidade WHERE descricao LIKE '%$desc%' order by descricao asc";
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
    public function BuscarTodosNcProcessoMenos($id) {
        try {
            $sql = "SELECT * FROM tiponaoconformidade WHERE id <>'$id' order by descricao asc";
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
        $tiponc = new TipoNaoConformidade();

        $tiponc->setId($row['id']);
        $tiponc->setDescricao($row['descricao']);


        return $tiponc;
    }
    private function ListaCount($row) {
        $tiponc = new TipoNaoConformidade();

        $tiponc->setId($row['id']);
        
        return $tiponc;
    }

}
