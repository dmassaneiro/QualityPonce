<?php

class AuditoriaDAO {

    public function Inserir(Auditoria $obj) {
        try {
            $sql = "INSERT INTO auditoria (    
               
                  dataInicio,
                  dataFim,
                  objetivos,
                  escopo,
                  conclusao,
                  setorId,
                  auditor,
                  situacao)
                  VALUES (
                  :dataInicio,
                  :dataFim,
                  :objetivos,
                  :escopo,
                  :conclusao,
                  :setorId,
                  :auditor,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataInicio", $obj->getDataInicio());
            $p_sql->bindValue(":dataFim", $obj->getDataFim());
            $p_sql->bindValue(":objetivos", $obj->getObjetivos());
            $p_sql->bindValue(":escopo", $obj->getEscopo());
            $p_sql->bindValue(":conclusao", $obj->getConclusao());
            $p_sql->bindValue(":setorId", $obj->getSetorId());
            $p_sql->bindValue(":auditor", $obj->getAuditor());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function EditarQuestionario(Auditoria $obj) {
        try {
            $sql = "UPDATE auditoria set
                          
                  dataInicio=:dataInicio,
                  dataFim=:dataFim,
                  setorId=:setorId,
                  auditor=:auditor
                                    
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataInicio", $obj->getDataInicio());
            $p_sql->bindValue(":dataFim", $obj->getDataFim());
            $p_sql->bindValue(":setorId", $obj->getSetorId());
            $p_sql->bindValue(":auditor", $obj->getAuditor());
            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }
    
    public function EditarResultado(Auditoria $obj) {
        try {
            $sql = "UPDATE auditoria set
                          
                  dataInicio=:dataInicio,
                  dataFim=:dataFim,
                  setorId=:setorId,
                  conclusao=:conclusao,
                  sugestao=:sugestao,
                  auditor=:auditor,
                  situacao=:situacao
                                    
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataInicio", $obj->getDataInicio());
            $p_sql->bindValue(":dataFim", $obj->getDataFim());
            $p_sql->bindValue(":setorId", $obj->getSetorId());
            $p_sql->bindValue(":conclusao", $obj->getConclusao());
            $p_sql->bindValue(":sugestao", $obj->getSugestao());
            $p_sql->bindValue(":auditor", $obj->getAuditor());
            $p_sql->bindValue(":situacao", $obj->getSituacao());
            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }
    
    public function Editar(Auditoria $obj) {
        try {
            $sql = "UPDATE auditoria set
                          
                  dataInicio=:dataInicio,
                  dataFim=:dataFim,
                  setorId=:setorId,
                  auditor=:auditor,
                  objetivos=:objetivos,

                  escopo=:escopo
                  
                                    
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataInicio", $obj->getDataInicio());
            $p_sql->bindValue(":dataFim", $obj->getDataFim());
            $p_sql->bindValue(":setorId", $obj->getSetorId());
            $p_sql->bindValue(":auditor", $obj->getAuditor());
            $p_sql->bindValue(":objetivos", $obj->getObjetivos());
//            $p_sql->bindValue(":situacao", $obj->getSituacao());
            $p_sql->bindValue(":escopo", $obj->getEscopo());
            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }
    public function Cancela(Auditoria $obj) {
        try {
            $sql = "UPDATE auditoria set
                
                  situacao=:situacao
                                    
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":situacao", $obj->getSituacao());
            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($setorId) {
        try {
            $sql = "DELETE FROM auditoria WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $setorId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarUltimoRegistro() {
        try {
            $sql = "SELECT id FROM auditoria ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM auditoria order by id desc";
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

    public function BuscarTodosPorStatus($situacao) {
        try {
            $sql = "SELECT * FROM auditoria
                    WHERE situacao = '$situacao' order by id desc";
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

    public function BuscarTodosNcProdutosControle($controle) {
        try {
            $sql = "SELECT * FROM laudoinspecao
                    WHERE controle = '$controle' order by id desc";
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
    public function BuscarSetor($controle) {
        try {
            $sql = "SELECT n.id as id, n.dataInicio as dataInicio, n.dataFim as dataFim,
                n.auditor as auditor, n.conclusao as conclusao,
                n.escopo as escopo, n.objetivos as objetivos,
                n.sugestao as sugestao, n.setorId as setorId,
                n.situacao as situacao, s.descricao
                FROM auditoria n
                INNER JOIN setor as s ON(n.setorId = s.id)
                WHERE s.descricao LIKE '%$controle%'
                order by n.id desc";
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

    public function BuscarTodosPorPeriodo($inicio, $fim) {
        try {
            $sql = "SELECT * FROM auditoria
                    WHERE dataInicio between '$inicio' and '$fim' order by id desc";
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

    public function BuscarTodosPorAuditor($auditor) {
        try {
                   $sql = "SELECT * FROM auditoria
                    WHERE auditor LIKE '%$auditor%'  order by id desc";
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

    public function BuscarRegistroParaEditar($id) {
        try {
            $sql = "SELECT * FROM auditoria where id='$id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function VerificaData($data) {
        try {
            $sql = "SELECT * FROM auditoria where dataFim <='$data' AND situacao = 'A'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function VerificaData2($data) {
        try {
            $sql = "SELECT * FROM auditoria where dataFim < '$data' AND situacao = 'A'";
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
    
   

    private function ListaId($id) {
        $dados = new Auditoria();
        $dados->setId($id['id']);

        return $dados;
    }
    function Lista($row) {
        $dados = new Auditoria();

        $dados->setId($row['id']);
        $dados->setDataInicio($row['dataInicio']);
        $dados->setDataFim($row['dataFim']);
        $dados->setConclusao($row['conclusao']);
        $dados->setSugestao($row['sugestao']);
        $dados->setEscopo($row['escopo']);
        $dados->setObjetivos($row['objetivos']);
        $dados->setSetorId($row['setorId']);
        $dados->setAuditor($row['auditor']);
        $dados->setSituacao($row['situacao']);

        return $dados;
    }

}
