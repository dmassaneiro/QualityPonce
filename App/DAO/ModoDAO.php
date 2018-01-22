<?php

class ModoDAO {

    public function Inserir(Modo2 $obj) {
        try {
            $sql = "INSERT INTO itemcorrentefuga (    
                  descricao,
                  situacao)
                  VALUES (
                  :descricao,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":situacao", $obj->getSituacao());
            

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(Modo2 $obj) {
        try {
            $sql = "UPDATE  itemcorrentefuga SET  
                
                  descricao=:descricao,
                  situacao=:situacao
                                    
                  WHERE  id=:id ";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":situacao", $obj->getSituacao());
           
            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function BuscarTodosdoProduto($idproduto) {
        try {
            $sql = "SELECT * FROM modo WHERE produtoId ='$idproduto' AND situacao ='A' order by id asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->lista2($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarTodos2() {
        try {
            $sql = "SELECT * FROM itemcorrentefuga order by id desc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->lista2($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    private function Lista($row) {
        $dados = new Modo();

        $dados->setId($row['id']);
        $dados->setDescricao($row['descricao']);
        $dados->setProdutoId($row['produtoId']);
        
        return $dados;
    }
    private function Lista2($row) {
        $dados = new Modo2();

        $dados->setId($row['id']);
        $dados->setDescricao($row['descricao']);
        $dados->setSituacao($row['situacao']);
        
        return $dados;
    }

    public function BuscarNomeModo($categoriaId) {
        try {
            $sql = "SELECT * FROM modo WHERE id = '$categoriaId'
                     order by descricao desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function listaNome($row) {
        $cat2 = new Modo();
        $cat2->setDescricao($row['descricao']);

        return $cat2;
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM itemcorrentefuga WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

    public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(itemCorrenteFugaId) as id FROM ensaiocorrentefuga WHERE itemCorrenteFugaId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $obj = new Modo2();
        $obj->setId($row['id']);
        return $obj;
    }
	
	 public function BuscarTodosporDescricao($desc) {
        try {
            $sql = "SELECT * FROM  itemcorrentefuga WHERE descricao LIKE '%$desc%' order by id asc";
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
    
}
