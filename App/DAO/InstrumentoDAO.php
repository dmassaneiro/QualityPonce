<?php

class InstrumentoDAO {

    public function Inserir(Instrumento $obj) {
        try {
            $sql = "INSERT INTO instrumento (    
               
                  descricao,
                  identificacao,
                  dataValidade,
                  situacao)
                  VALUES (
                  :descricao,
                  :identificacao,
                  :dataValidade,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":identificacao", $obj->getIdentificacao());
            $p_sql->bindValue(":dataValidade", $obj->getDataValidade());
            $p_sql->bindValue(":situacao", $obj->getSituacao());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Instrumento $obj) {
        try {
            $sql = "UPDATE instrumento set
                
                  descricao=:descricao,
                  identificacao=:identificacao,
                  dataValidade=:dataValidade,
                  situacao=:situacao
                                                     
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":identificacao", $obj->getIdentificacao());
            $p_sql->bindValue(":dataValidade", $obj->getDataValidade());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM instrumento WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarPorNome($nome) {
        try {
            $sql = "SELECT * FROM instrumento WHERE descricao = '$nome'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function BuscaroNomePeloId($id) {
        try {
            $sql = "SELECT * FROM instrumento WHERE id = '$id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function VerificaParaDeletar($setorId) {
        try {
            $sql = "SELECT count(instrumentoId) as id FROM fichatecnicainstrumento WHERE instrumentoId = '$setorId'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM instrumento WHERE situacao = 'A' order by descricao asc";
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
    public function BuscarTodos2() {
        try {
                $sql = "SELECT * FROM instrumento order by dataValidade asc";
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
    
    public function VerificaValidade($dataatual) {
        try {
            $sql = "SELECT * FROM instrumento where dataValidade <= '$dataatual' AND situacao ='A' order by id desc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodosporDescricao($desc) {
        try {
            $sql = "SELECT * FROM instrumento  WHERE descricao LIKE '%$desc%' order by descricao asc";
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

    public function BuscarTodosSetoresMenos($id) {
        try {
            $sql = "SELECT * FROM setor WHERE id<>'$id' order by descricao asc";
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
        $dados = new Instrumento();
        $dados->setId($row['id']);
        $dados->setDescricao($row['descricao']);
        $dados->setIdentificacao($row['identificacao']);
        $dados->setDataValidade($row['dataValidade']);
        $dados->setSituacao($row['situacao']);
        return $dados;
    }

    private function ListaCount($row) {
        $setor = new Instrumento();
        $setor->setId($row['id']);
        return $setor;
    }

}
