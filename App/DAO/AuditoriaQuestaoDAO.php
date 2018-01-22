<?php

class AuditoriaQuestaoDAO {

    public function Inserir(AuditoriaQuestionario $obj) {
        try {
            $sql = "INSERT INTO auditoriaquestionario (    
                  auditoriaId,
                  itemQuestionarioId,
                  resposta,
                  evidencia)
                  VALUES (
                  :auditoriaId,
                  :itemQuestionarioId,
                  :resposta,
                  :evidencia)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":auditoriaId", $obj->getAuditoriaId());
            $p_sql->bindValue(":itemQuestionarioId", $obj->getItemQuestionarioId());
            $p_sql->bindValue(":resposta", $obj->getResposta());
            $p_sql->bindValue(":evidencia", $obj->getEvidencias());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(AuditoriaQuestionario $obj) {
        try {
            $sql = "UPDATE  auditoriaquestionario SET  
                
                  resposta=:resposta,
                  evidencia=:evidencia
                  
                  WHERE  itemQuestionarioId=:itemQuestionarioId ";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":itemQuestionarioId", $obj->getItemQuestionarioId());
            $p_sql->bindValue(":resposta", $obj->getResposta());
            $p_sql->bindValue(":evidencia", $obj->getEvidencias());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
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
        $dados = new AuditoriaQuestionario();

        $dados->setAuditoriaId($row['auditoriaId']);
        $dados->setEvidencias($row['evidencia']);
        $dados->setItemQuestionarioId($row['itemQuestionarioId']);
        $dados->setResposta($row['resposta']);

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
            $sql = "DELETE FROM auditoriaquestionario WHERE auditoriaId = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

}
