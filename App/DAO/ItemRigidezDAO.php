<?php

class ItemRigidezDAO {

    public function Inserir(ItemRigidezDieletrica $obj) {
        try {
            $sql = "INSERT INTO  itemrigidezdieletrica (    
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

    public function Editar(ItemRigidezDieletrica $obj) {
        try {
            $sql = "UPDATE  itemrigidezdieletrica set
                
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
            $sql = "DELETE FROM  itemrigidezdieletrica WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }
    public function BuscarNotaPesoTtal($IdInspecao) {
        try {
            $sql = "SELECT sum(c.notaPeso) as notaPeso
                    FROM avaliacaocriterio a
                    INNER JOIN criteriofornecedor as c ON a.criterioFornecedorId = c.id
                    where a.avaliacaoFornecedorId ='$IdInspecao'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaPeso($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }


    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM  itemrigidezdieletrica order by id asc";
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
            $sql = "SELECT * FROM  itemrigidezdieletrica WHERE descricao LIKE '%$desc%' order by id asc";
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
            $sql = "SELECT * FROM  itemrigidezdieletrica order by produtoId desc";
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
    
    public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(itemRigidezDieletricaId) as id FROM ensaiorigidezdieletrica WHERE itemRigidezDieletricaId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $obj = new ItemRigidezDieletrica();
        $obj->setId($row['id']);
        return $obj;
    }
    public function BuscarTodosDoProduto($idproduto) {
        try {
            $sql = "SELECT * FROM  itemrigidezdieletrica WHERE produtoId = '$idproduto' AND situacao ='A' order by id asc";
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
    public function BuscarDescricaoRigidez($id) {
        try {
            $sql = "SELECT * FROM itemrigidezdieletrica WHERE id='$id'  order by id asc";
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
            $sql = "SELECT * FROM funcionario WHERE nome LIKE '%$nome%' 
                     order by nome desc ";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function Lista($row) {
        $dados = new ItemRigidezDieletrica();
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
