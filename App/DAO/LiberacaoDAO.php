<?php

class LiberacaoDAO {

    public function Inserir(Liberacao $obj) {
        try {
            $sql = "INSERT INTO liberacao (    
                  ItemLiberacao_id,
                  conferido,
                  FichaTecnica_id)
                  VALUES (
                  :ItemLiberacao_id,
                  :conferido,
                  :FichaTecnica_id)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":ItemLiberacao_id", $obj->getItemLiberacaoId());
            $p_sql->bindValue(":conferido", $obj->getConferido());
            $p_sql->bindValue(":FichaTecnica_id", $obj->getFichaTecnica_id());
           

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(Liberacao $obj) {
        try {
            $sql = "UPDATE  liberacao SET  
                
                  
                  conferido=:conferido
                  
                  WHERE  FichaTecnica_id=:FichaTecnica_id AND  ItemLiberacao_id=:ItemLiberacao_id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":ItemLiberacao_id", $obj->getItemLiberacaoId());
            $p_sql->bindValue(":conferido", $obj->getConferido());
            $p_sql->bindValue(":FichaTecnica_id", $obj->getFichaTecnica_id());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function BuscarTodosdaFicha($idficha) {
        try {
            $sql = "SELECT * FROM liberacao WHERE FichaTecnica_id ='$idficha' order by ItemLiberacao_id asc";
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



    private function Lista($row) {
        $dados = new Liberacao();

        $dados->setConferido($row['conferido']);
        $dados->setFichaTecnica_id($row['FichaTecnica_id']);
        $dados->setItemLiberacaoId($row['ItemLiberacao_id']);
       

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
            $sql = "DELETE FROM liberacao WHERE FichaTecnica_id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

}
