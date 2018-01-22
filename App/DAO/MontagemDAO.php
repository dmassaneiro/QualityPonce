<?php

class MontagemDAO {

    public function Inserir(Montagem $obj) {
        try {
            $sql = "INSERT INTO montagem (    
                  itemMontafemId,
                  data,
                  responsavel,
                  FichaTecnica_id)
                  VALUES (
                  :itemMontafemId,
                  :data,
                  :responsavel,
                  :FichaTecnica_id)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":itemMontafemId", $obj->getItemMontagemId());
            $p_sql->bindValue(":data", $obj->getData());
            $p_sql->bindValue(":responsavel", $obj->getResponsavel());
            $p_sql->bindValue(":FichaTecnica_id", $obj->getFichaTecnicaId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(Montagem $obj) {
        try {
            $sql = "UPDATE  montagem SET  
                
                  
                  data=:data,
                  responsavel=:responsavel
                  
                  WHERE  itemMontafemId=:itemMontafemId AND FichaTecnica_id=:FichaTecnica_id ";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":data", $obj->getData());
            $p_sql->bindValue(":responsavel", $obj->getResponsavel());
            $p_sql->bindValue(":itemMontafemId", $obj->getItemMontagemId());
            $p_sql->bindValue(":FichaTecnica_id", $obj->getFichaTecnicaId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function BuscarTodosdaFicha($idficha) {
        try {
            $sql = "SELECT * FROM montagem WHERE FichaTecnica_id ='$idficha' order by itemMontafemId asc";
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
        $dados = new Montagem();

        $dados->setItemMontagemId($row['itemMontafemId']);
        $dados->setFichaTecnicaId($row['FichaTecnica_id']);
        $dados->setData($row['data']);
        $dados->setResponsavel($row['responsavel']);

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
    public function ValidaMontagem($idficha) {
        try {
            $sql = "SELECT count(id) as id FROM itemMontagem WHERE produtoId = '$idficha'
                     AND situacao='A' limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function listaNome($row) {
        $cat2 = new ItemMontagem();
        $cat2->setId($row['id']);

        return $cat2;
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM montagem WHERE FichaTecnica_id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

}
