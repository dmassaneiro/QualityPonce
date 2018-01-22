<?php

class ItemMontagemDAO {

    public function Inserir(ItemMontagem $obj) {
        try {
            $sql = "INSERT INTO  itemmontagem (    
                  descricao,
                  produtoId,
                  situacao)
                  VALUES (
                  :descricao,
                  :produtoId,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":produtoId", $obj->getProdutoId());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(ItemMontagem $obj) {
        try {
            $sql = "UPDATE  itemmontagem set
                
                  descricao=:descricao,
                  situacao=:situacao
                                   
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM  itemmontagem WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }
   public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(itemMontafemId) as id FROM montagem WHERE itemMontafemId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $obj = new ItemMontagem();
        $obj->setId($row['id']);
        return $obj;
    }


    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM  itemmontagem order by id asc";
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
    public function BuscarTodos2() {
        try {
            $sql = "SELECT * FROM  itemmontagem order by id desc";
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
    public function BuscarTodosDoProduto($id) {
        try {
            $sql = "SELECT * FROM  itemmontagem WHERE produtoId='$id' AND situacao='A'  order by id asc";
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
    public function BuscarTodosporDescricao($desc) {
        try {
            $sql = "SELECT * FROM  itemmontagem WHERE descricao LIKE '%$desc%' order by id asc";
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
    public function BuscarDescricaoMontagem($id) {
        try {
            $sql = "SELECT * FROM itemmontagem WHERE id='$id'  order by id asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarTodosFuncionarioNome($nome) {
        try {
            $sql = "SELECT * FROM funcionario WHERE nome LIKE '%$nome%' OR sobrenome LIKE '%$nome%'
                     order by nome asc";
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

    
    public function BuscarId($Nome) {
        try {
            $sql = "SELECT * FROM criteriofornecedor WHERE nome = '$Nome'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BotaoPesquisaPorNome($nome) {
        try {
            $sql = "SELECT * FROM itemmontagem WHERE descricao LIKE '%$nome%' 
                     order by id desc ";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function Lista($row) {
        $dados = new ItemMontagem();
        $dados->setId($row['id']);
        $dados->setDescricao($row['descricao']);
        $dados->setProdutoId($row['produtoId']);
        $dados->setSituacao($row['situacao']);


        return $dados;
    }
    private function ListaPeso($row) {
        $dados = new CriterioFornecedor();

        $dados->setNotaPeso($row['notaPeso']);


        return $dados;
    }

}
