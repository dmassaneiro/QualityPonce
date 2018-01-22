<?php

class TipoNaoConformidadeProdutoDAO {

    public function Inserir(TipoNaoConformidadeProduto $tiponc ){
        try {
            $sql = "INSERT INTO tiponaoconformidadeproduto (    
               
                  descricao)
                  VALUES (
                  :descricao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);


            $p_sql->bindValue(":descricao", $tiponc->getDescricao());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(TipoNaoConformidadeProduto $tiponc) {
        try {
            $sql = "UPDATE tiponaoconformidadeproduto set
                
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
            $sql = "DELETE FROM tiponaoconformidadeproduto WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $tiponcId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarNomeNC($ncId) {
        try {
            $sql = "SELECT * FROM tiponaoconformidadeproduto WHERE id = '$ncId'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar.".$e;
        }
    }
    
    
    public function BuscarTodosNcProduto() {
        try {
            $sql = "SELECT * FROM tiponaoconformidadeproduto order by descricao asc";
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
            $sql = "SELECT * FROM tiponaoconformidadeproduto WHERE id <>'$id' order by descricao asc";
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
        $tiponc = new TipoNaoConformidadeProduto();

        $tiponc->setId($row['id']);
        $tiponc->setDescricao($row['descricao']);


        return $tiponc;
    }

}
