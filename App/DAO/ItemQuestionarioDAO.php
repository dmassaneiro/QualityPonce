<?php

class ItemQuestionarioDAO {

    public function Inserir(ItemQuestionario $obj) {
        try {
            $sql = "INSERT INTO  itemquestionario (    
                  descricao,
                  tipoAuditoriaId,
                  situacao)
                  VALUES (
                  :descricao,
                  :tipoAuditoriaId,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":tipoAuditoriaId", $obj->getTipoAuditoriaId());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir<br> " . $e;
        }
    }

    public function Editar(ItemQuestionario $obj) {
        try {
            $sql = "UPDATE  itemquestionario set
                
                  descricao=:descricao,
                  tipoAuditoriaId=:tipoAuditoriaId,
                  situacao=:situacao
                                   
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $obj->getDescricao());
            $p_sql->bindValue(":tipoAuditoriaId", $obj->getTipoAuditoriaId());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM  itemquestionario WHERE id = :cod";
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
            $sql = "SELECT * FROM  itemquestionario WHERE situacao ='A' order by tipoAuditoriaId asc";
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
            $sql = "SELECT * FROM  itemquestionario order by tipoAuditoriaId asc";
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
            $sql = "SELECT count(itemQuestionarioId) as id FROM auditoriaquestionario WHERE itemQuestionarioId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
     private function ListaCount($row) {
        $setor = new ItemQuestionario();
        $setor->setId($row['id']);
        return $setor;
    }
    public function BuscarTodosDaAuditoria($idauditoria) {
        try {
            $sql = "SELECT * FROM  itemquestionario WHERE  order by id asc";
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
    public function BuscarDescricaoQuestao($id) {
        try {
            $sql = "SELECT * FROM itemquestionario WHERE id='$id'  order by id asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarTodosNome($nome) {
        try {
            $sql = "SELECT * FROM itemquestionario WHERE descricao LIKE '%$nome%'
                     order by descricao asc";
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
        $dados = new ItemQuestionario();
        $dados->setId($row['id']);
        $dados->setDescricao($row['descricao']);
        $dados->setTipoAuditoriaId($row['tipoAuditoriaId']);
        $dados->setSituacao($row['situacao']);


        return $dados;
    }
    private function ListaPeso($row) {
        $dados = new CriterioFornecedor();

        $dados->setNotaPeso($row['notaPeso']);


        return $dados;
    }

}
