<?php

class CorrenteFugaDAO {

    public function Inserir(EnsaioCorrenteFuga $obj) {
        try {
            $sql = "INSERT INTO ensaiocorrentefuga (    
                  itemCorrenteFugaId,
                  data,
                  valorCa,
                  valorCc,
                  responsavel,
                  FichaTecnica_id,
                  modoId)
                  VALUES (
                  :itemCorrenteFugaId,
                  :data,
                  :valorCa,
                  :valorCc,
                  :responsavel,
                  :FichaTecnica_id,
                  :modoId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":itemCorrenteFugaId", $obj->getItemCorrenteFugaId());
            $p_sql->bindValue(":data", $obj->getData());
            $p_sql->bindValue(":valorCa", $obj->getValorCa());
            $p_sql->bindValue(":valorCc", $obj->getValorCc());
            $p_sql->bindValue(":responsavel", $obj->getResponsavel());
            $p_sql->bindValue(":FichaTecnica_id", $obj->getFichaTecnica_id());
            $p_sql->bindValue(":modoId", $obj->getModoId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(Montagem $obj) {
        try {
            $sql = "UPDATE  ensaiocorrentefuga SET  
                
                  itemMontafemId=:itemMontafemId,
                  data=:data,
                  responsavel=:responsavel,
                  resultado=:resultado,
                  correnteMa=:correnteMa
                  
                  WHERE  FichaTecnica_id=:FichaTecnica_id ";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":itemMontafemId", $obj->getItemRigidezDieletricaId());
            $p_sql->bindValue(":data", $obj->getData());
            $p_sql->bindValue(":resultado", $obj->getResultado());
            $p_sql->bindValue(":responsavel", $obj->getReponsavel());
            $p_sql->bindValue(":correnteMa", $obj->getCorrenteMa());
            $p_sql->bindValue(":FichaTecnica_id", $obj->getFichaTecnica_id());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }
    
    public function BuscarTodosdaFicha($idficha, $idmodo) {
        try {
            $sql = "SELECT * FROM ensaiocorrentefuga WHERE FichaTecnica_id ='$idficha'"
                    . "AND modoId='$idmodo' order by itemCorrenteFugaId asc";
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

    public function BuscarTodosNC($idauditoria) {
        try {
            $sql = "SELECT * FROM auditoriaquestionario WHERE auditoriaId ='$idauditoria' AND resposta ='NC'";
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

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM itemcorrentefuga WHERE situacao ='A' order by id asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->ListaItem($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    private function Lista($row) {
        $dados = new EnsaioCorrenteFuga();

        $dados->setData($row['data']);
        $dados->setFichaTecnica_id($row['FichaTecnica_id']);
        $dados->setItemCorrenteFugaId($row['itemCorrenteFugaId']);
        $dados->setModoId($row['modoId']);
        $dados->setResponsavel($row['responsavel']);
        $dados->setValorCa($row['valorCa']);
        $dados->setValorCc($row['valorCc']);
       

        return $dados;
    }
    private function ListaItem($row) {
        $dados = new ItemCorrenteFuga();

        $dados->setDescricao($row['descricao']);
        $dados->setId($row['id']);
//        $dados->setProdutoId($row['produtoId']);
       
       

        return $dados;
    }

    public function BuscarNomedaCorrente($idcorrente) {
        try {
            $sql = "SELECT * FROM itemcorrentefuga WHERE id = '$idcorrente'
                     order by descricao limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function listaNome($row) {
        $cat2 = new ItemCorrenteFuga();
        $cat2->setDescricao($row['descricao']);

        return $cat2;
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM ensaiocorrentefuga WHERE FichaTecnica_id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

}
