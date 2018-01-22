<?php

class ItemCorrenteDAO {

    public function Inserir(ItemCorrenteFuga $obj) {
        try {
            $sql = "INSERT INTO  modo (    
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

    public function Editar(ItemCorrenteFuga $obj) {
        try {
            $sql = "UPDATE  modo set
                
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
            $sql = "DELETE FROM  modo WHERE id = :cod";
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

    public function Contador() {
        try {
            $sql = "SELECT count(id) as id FROM itemcorrentefuga ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
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
    
    public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(modoId) as id FROM ensaiocorrentefuga WHERE modoId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $obj = new ItemCorrenteFuga();
        $obj->setId($row['id']);
        return $obj;
    }
    
    public function BuscarTodos2() {
        try {
            $sql = "SELECT * FROM  modo order by id desc";
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
   
    public function BuscarTodosDoProduto($idproduto) {
        try {
            $sql = "SELECT * FROM  itemrigidezdieletrica WHERE produtoId = '$idproduto' order by id asc";
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
    public function BuscarDescricaoCorrente($id) {
        try {
            $sql = "SELECT * FROM itemcorrentefuga WHERE id='$id'  order by id asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarTodosNome($nome) {
        try {
            $sql = "SELECT * FROM modo WHERE descricao LIKE '%$nome%' order by id desc";
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

    public function BotaoPesquisaPorNome($nome) {
        try {
            $sql = "SELECT * FROM modo WHERE descricao LIKE '%$nome%' 
                     order by id desc ";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function Lista($row) {
        $dados = new ItemCorrenteFuga();
        $dados->setId($row['id']);
        $dados->setDescricao($row['descricao']);
        $dados->setProdutoId($row['produtoId']);
        $dados->setSituacao($row['situacao']);

        return $dados;
    }
    
    private function ListaNome($row) {
        $dados = new ItemCorrenteFuga();
        $dados->setDescricao($row['descricao']);

        return $dados;
    }
    private function ListaId($row) {
        $dados = new ItemCorrenteFuga();

        $dados->setId($row['id']);

        return $dados;
    }

}
