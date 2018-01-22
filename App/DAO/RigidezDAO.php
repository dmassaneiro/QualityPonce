<?php

class RigidezDAO {

    public function Inserir(EnsaioItemRigidezDieletrica $obj) {
        try {
            $sql = "INSERT INTO ensaiorigidezdieletrica (    
                  itemRigidezDieletricaId,
                  data,
                  resultado,
                  responsavel,
                  correnteMa,
                  FichaTecnica_id)
                  VALUES (
                  :itemRigidezDieletricaId,
                  :data,
                  :resultado,
                  :responsavel,
                  :correnteMa,
                  :FichaTecnica_id)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":itemRigidezDieletricaId", $obj->getItemRigidezDieletricaId());
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

    public function Editar(EnsaioItemRigidezDieletrica $obj) {
        try {
            $sql = "UPDATE  ensaiorigidezdieletrica SET  
                
                  itemRigidezDieletricaId=:itemRigidezDieletricaId,
                  data=:data,
                  responsavel=:responsavel,
                  resultado=:resultado,
                  correnteMa=:correnteMa
                  
                  WHERE  FichaTecnica_id=:FichaTecnica_id ";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":itemRigidezDieletricaId", $obj->getItemRigidezDieletricaId());
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

   public function BuscarTodosdaFicha($idficha) {
        try {
            $sql = "SELECT * FROM ensaiorigidezdieletrica WHERE FichaTecnica_id ='$idficha' order by itemRigidezDieletricaId asc";
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

    public function BuscarTodosID($id) {
        try {
            $sql = "SELECT * FROM auditoriaquestionario WHERE auditoriaId ='$id'";
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
        $dados = new EnsaioItemRigidezDieletrica();

        $dados->setItemRigidezDieletricaId($row['itemRigidezDieletricaId']);
        $dados->setFichaTecnica_id($row['FichaTecnica_id']);
        $dados->setData($row['data']);
        $dados->setReponsavel($row['responsavel']);
        $dados->setResultado($row['resultado']);
        $dados->setCorrenteMa($row['correnteMa']);

        return $dados;
    }

    public function BuscarNomeCategoria($categoriaId) {
        try {
            $sql = "SELECT * FROM categoria WHERE id = '$categoriaId'
                     order by descricao desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function listaNome($row) {
        $cat2 = new Categoria();
        $cat2->setDescricao($row['descricao']);

        return $cat2;
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM ensaiorigidezdieletrica WHERE FichaTecnica_id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

}
