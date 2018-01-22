<?php

class CriterioFornecedorDAO {

    public function Inserir(CriterioFornecedor $obj) {
        try {
            $sql = "INSERT INTO criteriofornecedor (    
                  descricao,
                  notaPeso)
                  VALUES (
                  :descricao,
                  :notaPeso)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":notaPeso", $obj->getNotaPeso());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(CriterioFornecedor $obj) {
        try {
            $sql = "UPDATE criteriofornecedor set
                
                  descricao=:descricao,
                  notaPeso=:notaPeso
                                   
                  WHERE id =:id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":notaPeso", $obj->getNotaPeso());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM criteriofornecedor WHERE id = :cod";
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
            $sql = "SELECT * FROM criteriofornecedor order by id asc";
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
    public function BuscarTodosEdit($id) {
        try {
            $sql = "SELECT * FROM criteriofornecedor WHERE id='$id'  order by id asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarTodosNome($nome) {
        try {
            $sql = "SELECT * FROM criteriofornecedor WHERE descricao LIKE '%$nome%' 
                     order by id asc";
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
        $dados = new CriterioFornecedor();
        $dados->setId($row['id']);
        $dados->setDescricao($row['descricao']);
        $dados->setNotaPeso($row['notaPeso']);


        return $dados;
    }
    private function ListaPeso($row) {
        $dados = new CriterioFornecedor();

        $dados->setNotaPeso($row['notaPeso']);


        return $dados;
    }
     public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(criterioFornecedorId) as id FROM avaliacaocriterio WHERE criterioFornecedorId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $setor = new CriterioFornecedor();
        $setor->setId($row['id']);
        return $setor;
    }

}
