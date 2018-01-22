<?php

class TesteDAO {

    public function Inserir(TesteItemTeste $obj) {
        try {
            $sql = "INSERT INTO Teste (    
                  itemTesteId,
                  data,
                  resultado,
                  responsavel,
                  observacao,
                  FichaTecnica_id)
                  VALUES (
                  :itemTesteId,
                  :data,
                  :resultado,
                  :responsavel,
                  :observacao,
                  :FichaTecnica_id)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":itemTesteId", $obj->getItemTesteId());
            $p_sql->bindValue(":data", $obj->getData());
            $p_sql->bindValue(":resultado", $obj->getResultado());
            $p_sql->bindValue(":responsavel", $obj->getResponsavel());
            $p_sql->bindValue(":observacao", $obj->getObservacao());
            $p_sql->bindValue(":FichaTecnica_id", $obj->getFichaTecnica_id());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(TesteItemTeste $obj) {
        try {
            $sql = "UPDATE  teste SET  
                
                  
                  data=:data,
                  resultado=:resultado,
                  responsavel=:responsavel,
                  observacao=:observacao
                  
                  WHERE  FichaTecnica_id=:FichaTecnica_id AND itemTesteId=:itemTesteId";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":itemTesteId", $obj->getItemTesteId());
            $p_sql->bindValue(":data", $obj->getData());
            $p_sql->bindValue(":resultado", $obj->getResultado());
            $p_sql->bindValue(":responsavel", $obj->getResponsavel());
            $p_sql->bindValue(":observacao", $obj->getObservacao());
            $p_sql->bindValue(":FichaTecnica_id", $obj->getFichaTecnica_id());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function BuscarTodosdaFicha($idficha) {
        try {
            $sql = "SELECT * FROM teste WHERE FichaTecnica_id ='$idficha' order by itemTesteId asc";
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
        $dados = new TesteItemTeste();

        $dados->setData($row['data']);
        $dados->setFichaTecnica_id($row['FichaTecnica_id']);
        $dados->setItemTesteId($row['itemTesteId']);
        $dados->setObservacao($row['observacao']);
        $dados->setResponsavel($row['responsavel']);
        $dados->setResultado($row['resultado']);
        $dados->setTesteFuncionalId($row['FichaTecnica_id']);

        return $dados;
    }

    public function BuscarNomeTeste($categoriaId) {
        try {
            $sql = "SELECT * FROM itemteste WHERE id = '$categoriaId'
                     order by descricao desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function listaNome($row) {
        $cat2 = new ItemTeste();
        $cat2->setDescricao($row['descricao']);

        return $cat2;
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM teste WHERE FichaTecnica_id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

}
