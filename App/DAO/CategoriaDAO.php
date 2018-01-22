<?php

class CategoriaDAO {

    public function Inserir(Categoria $obj) {
        try {
            $sql = "INSERT INTO categoria (    
               
                  descricao)
                  VALUES (
                  :descricao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":descricao", $obj->getDescricao());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Categoria $obj) {
        try {
            $sql = "UPDATE categoria set
                
                  descricao=:descricao
                                                     
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM categoria WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    
    public function BuscarTodosCategoria() {
        try {
            $sql = "SELECT * FROM categoria order by descricao asc";
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
    public function BuscarTodosNome($nome) {
        try {
            $sql = "SELECT * FROM categoria WHERE descricao LIKE '%$nome%' order by descricao asc";
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
        $cat = new Categoria();

        $cat->setId($row['id']);
        $cat->setDescricao($row['descricao']);
        return $cat;
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

    public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(categoriaId) as id FROM produto WHERE categoriaId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $setor = new Categoria();
        $setor->setId($row['id']);
        return $setor;
    }

}
