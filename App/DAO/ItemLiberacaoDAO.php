<?php

class ItemLiberacaoDAO {

    public function Inserir(ItemLiberacao $obj) {
        try {
            $sql = "INSERT INTO  itemliberacao (    
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

    public function Editar(ItemLiberacao $obj) {
        try {
            $sql = "UPDATE  itemliberacao set
                
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
            $sql = "DELETE FROM  itemliberacao WHERE id = :cod";
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
            $sql = "SELECT * FROM  itemliberacao order by id asc";
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
            $sql = "SELECT * FROM  itemliberacao order by produtoId desc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->Lista2($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    
    public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(ItemLiberacao_id) as id FROM liberacao WHERE ItemLiberacao_id = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $obj = new ItemLiberacao();
        $obj->setId($row['id']);
        return $obj;
    }
	
	 public function BuscarTodosporDescricao($desc) {
        try {
            $sql = "SELECT * FROM  itemliberacao WHERE descricao LIKE '%$desc%' order by id asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->Lista2($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
   
    public function BuscarTodosDoProduto($idproduto) {
        try {
            $sql = "SELECT * FROM  itemliberacao WHERE produtoId = '$idproduto' AND situacao='A' order by id asc";
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


    
    public function BuscarNomePeloId($id) {
        try {
            $sql = "SELECT * FROM itemliberacao WHERE id = '$id'
                     order by id asc limit 1";
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


        return $dados;
    }
    private function Lista2($row) {
        $dados = new ItemLiberacao();
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
