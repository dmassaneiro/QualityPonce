<?php

class FichaTecnicaInstrumentoDAO {

    public function Inserir(FichaTecnicaInstrumento $dados) {
        try {
            $sql = "INSERT INTO fichatecnicainstrumento (    
                  fichaTecnicaId,
                  instrumentoId)
                  VALUES (
                  :fichaTecnicaId,
                  :instrumentoId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":fichaTecnicaId", $dados->getFichaTecnicaId());
            $p_sql->bindValue(":instrumentoId", $dados->getInstrumentoId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(FichaTecnicaInstrumento $dados) {
        try {
            $sql = "UPDATE fichatecnicainstrumento set
                
                  instrumentoId=:instrumentoId
                                        
                  WHERE fichaTecnicaId = :fichaTecnicaId";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":instrumentoId", $dados->getInstrumentoId());

            $p_sql->bindValue(":fichaTecnicaId", $dados->getFichaTecnicaId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($produtoId) {
        try {
            $sql = "DELETE FROM fichatecnicainstrumento WHERE fichaTecnicaId = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $produtoId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }
     public function BuscarTodosdaFicha($idficha) {
        try {
            $sql = "SELECT * FROM fichatecnicainstrumento WHERE fichaTecnicaId ='$idficha' order by instrumentoId asc";
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
        $dados = new FichaTecnicaInstrumento();

//        $dados->setFichaTecnicaId($row['data']);
        $dados->setInstrumentoId($row['instrumentoId']);
       
        return $dados;
    }

}
