<?php

class TipoDocumentoDAO {
     public function Inserir(TipoDocumento $dados) {
        try {
            $sql = "INSERT INTO tipodocumento (    
               
                  descricao,
                  sigla)
                  VALUES (
                  :descricao,
                  :sigla)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":descricao", $dados->getDescricao());
            $p_sql->bindValue(":sigla", $dados->getSigla());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir  " . $e;
        }
    }

    public function Editar(TipoDocumento $dados) {
        try {
            $sql = "UPDATE tipodocumento set
                
                  descricao=:descricao,
                  sigla=:sigla
                                                     
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $dados->getDescricao());
            $p_sql->bindValue(":sigla", $dados->getSigla());

            $p_sql->bindValue(":id", $dados->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($setorId) {
        try {
            $sql = "DELETE FROM tipodocumento WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $setorId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarNome($Id) {
        try {
            $sql = "SELECT * FROM tipodocumento WHERE id = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(id) as id FROM documento WHERE tipoDocumentoId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM tipodocumento order by descricao asc";
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

    public function BuscarTodosDescricao($desc) {
        try {
            $sql = "SELECT * FROM tipodocumento  WHERE descricao LIKE '%$desc%' order by descricao asc";
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

    public function BuscarTodosMenos($id) {
        try {
            $sql = "SELECT * FROM tipodocumento WHERE id<>'$id' order by descricao asc";
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
        $dados = new TipoDocumento();
        $dados->setId($row['id']);
        $dados->setDescricao($row['descricao']);
        $dados->setSigla($row['sigla']);
        return $dados;
    }

    private function ListaCount($row) {
        $setor = new Setor();
        $setor->setId($row['id']);
        return $setor;
    }

}
