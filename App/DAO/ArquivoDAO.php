<?php

class ArquivoDAO {
   
     public function Inserir(Arquivo $dados) {
        try {
            $sql = "INSERT INTO arquivo (    
                  caminho,
                  documentoId,
                  data,
                  versao)
                  VALUES (
                  :caminho,
                  :documentoId,
                  :data,
                  :versao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":caminho", $dados->getCaminho());
            $p_sql->bindValue(":documentoId", $dados->getDocumentoId());
            $p_sql->bindValue(":data", $dados->getData());
            $p_sql->bindValue(":versao", $dados->getVersao());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Arquivo $dados) {
        try {
            $sql = "UPDATE arquivo set
                
                  caminho=:caminho
                  
                                                    
                  WHERE documentoId = :documentoId";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":caminho", $dados->getCaminho());
           
            $p_sql->bindValue(":documentoId", $dados->getDocumentoId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($produtoId) {
        try {
            $sql = "DELETE FROM arquivo WHERE documentoId = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $produtoId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }
    public function Deletar2($produtoId) {
        try {
            $sql = "DELETE FROM arquivo WHERE caminho = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $produtoId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM arquivo order by caminho asc";
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
    public function BuscarTodos2($id) {
        try {
            $sql = "SELECT * FROM arquivo WHERE documentoId='$id' order by versao desc";
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
        $dados = new Arquivo();

        
        $dados->setCaminho($row['caminho']);
        $dados->setData($row['data']);
        $dados->setVersao($row['versao']);
        


        return $dados;
    }

    public function BuscarTodosDescricao($desc) {
        try {
            $sql = "SELECT * FROM fornecedor  WHERE nome LIKE '%$desc%' order by nome asc";
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

    public function VerificaSeJaExiste($nome) {
        try {
            $sql = "SELECT * FROM arquivo WHERE caminho = '$nome'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function BuscarNome($Id) {
        try {
            $sql = "SELECT * FROM arquivo WHERE documentoId = '$Id'
                      limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    
    public function BuscarVersao($Id) {
        try {
            $sql = "SELECT * FROM arquivo WHERE documentoId = '$Id'
                      order by versao desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function BuscaroUltimoParaImprimir($Id) {
        try {
            $sql = "SELECT * FROM arquivo WHERE documentoId = '$Id'
                      order by id desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    
    private function listaNome($row) {
        $obj = new Arquivo();

        $obj->setCaminho($row['caminho']);
        $obj->setDocumentoId($row['documentoId']);
        $obj->setVersao($row['versao']);
//        $obj->setDocumentoId($row['documentoId']);
        
        return $obj;
    }
    
}
