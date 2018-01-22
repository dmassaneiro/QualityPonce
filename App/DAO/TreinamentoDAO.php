<?php

//include_once '../Model/Treinamento.php';

class TreinamentoDAO {

    public function Inserir(Treinamento $dados) {
        try {
            $sql = "INSERT INTO treinamento (    
                  descricao,
                  localTreinamento,
                  dataInicio,
                  dataFim,
                  aplicador,
                  conteudo,
                  descricaoMetodo,
                  dataPrazo,
                  dataVerificacao,
                  evidencias,
                  eficaz,
                  responsavel,
                  statusId)
                  VALUES (
                  :descricao,
                  :localTreinamento,
                  :dataInicio,
                  :dataFim,
                  :aplicador,
                  :conteudo,
                  :descricaoMetodo,
                  :dataPrazo,
                  :dataVerificacao,
                  :evidencias,
                  :eficaz,
                  :responsavel,
                  :statusId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $dados->getDescricao());
            $p_sql->bindValue(":localTreinamento", $dados->getLocalTreinamento());
            $p_sql->bindValue(":dataInicio", $dados->getDataInicio());
            $p_sql->bindValue(":dataFim", $dados->getDataFim());
            $p_sql->bindValue(":aplicador", $dados->getAplicador());
            $p_sql->bindValue(":conteudo", $dados->getConteudo());
            $p_sql->bindValue(":descricaoMetodo", $dados->getDescricaoMetodo());
            $p_sql->bindValue(":dataPrazo", $dados->getDataPrazo());
            $p_sql->bindValue(":dataVerificacao", $dados->getDataVerificacao());
            $p_sql->bindValue(":evidencias", $dados->getEvidencias());
            $p_sql->bindValue(":eficaz", $dados->getEficaz());
            $p_sql->bindValue(":responsavel", $dados->getResponsavel());
            $p_sql->bindValue(":statusId", $dados->getStatusId());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Treinamento $dados) {
        try {
            $sql = "UPDATE treinamento set
                
                  descricao=:descricao,
                  localTreinamento=:localTreinamento,
                  dataInicio=:dataInicio,
                  dataFim=:dataFim,
                  aplicador=:aplicador,
                  conteudo=:conteudo,
                  descricaoMetodo=:descricaoMetodo,
                  dataPrazo=:dataPrazo,
                  dataVerificacao=:dataVerificacao,
                  evidencias=:evidencias,
                  eficaz=:eficaz,
                  responsavel=:responsavel,
                  statusId=:statusId
                                                    
                  WHERE id =:id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":descricao", $dados->getDescricao());
            $p_sql->bindValue(":localTreinamento", $dados->getLocalTreinamento());
            $p_sql->bindValue(":dataInicio", $dados->getDataInicio());
            $p_sql->bindValue(":dataFim", $dados->getDataFim());
            $p_sql->bindValue(":aplicador", $dados->getAplicador());
            $p_sql->bindValue(":conteudo", $dados->getConteudo());
            $p_sql->bindValue(":descricaoMetodo", $dados->getDescricaoMetodo());
            $p_sql->bindValue(":dataPrazo", $dados->getDataPrazo());
            $p_sql->bindValue(":dataVerificacao", $dados->getDataVerificacao());
            $p_sql->bindValue(":evidencias", $dados->getEvidencias());
            $p_sql->bindValue(":eficaz", $dados->getEficaz());
            $p_sql->bindValue(":responsavel", $dados->getResponsavel());
            $p_sql->bindValue(":statusId", $dados->getStatusId());
            $p_sql->bindValue(":id", $dados->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }
    public function Cancela(Treinamento $dados) {
        try {
            $sql = "UPDATE treinamento set
                
                  statusId=:statusId
                                                    
                  WHERE id =:id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":statusId", $dados->getStatusId());
            $p_sql->bindValue(":id", $dados->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM treinamento WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

    public function BuscarUltimoRegistro() {
        try {
            $sql = "SELECT id FROM treinamento ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodosStatus($statusID) {
        try {
            $sql = "SELECT * FROM treinamento
                    WHERE statusId = '$statusID' order by id desc";
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

    public function BuscarTodosPeriodo($inicio, $fim) {
        try {
            $sql = "SELECT * FROM treinamento
                    WHERE datainicio between '$inicio' and '$fim' order by id desc";
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
    public function BuscarTodosDescricao($desc) {
        try {
            $sql = "SELECT * FROM treinamento
                    WHERE descricao LIKE '%$desc%'  order by id desc";
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

    public function BuscarTodosTipoDocumento($desc) {
        try {
            $sql = "SELECT n.id as Id, n.tipoDocumentoId as tipoDocumentoId, n.autor as autor,
                n.dataRevisao as dataRevisao, n.dataValidade as dataValidade,n.dataAprovacao as dataAprovacao, 
                n.statusId as statusId,s.descricao 
                FROM documento n
                INNER JOIN tipodocumento as s ON(n.tipoDocumentoId = s.id)
                WHERE s.descricao LIKE '%$desc%'
                order by n.id desc  ";
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

    public function BuscarEdit($Id) {
        try {
            $sql = "SELECT * FROM treinamento WHERE id = '$Id'
                     order by id desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function VerificaSeExiste($nome) {
        try {
            $sql = "SELECT * FROM materiaprima WHERE nome = '$nome'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscaPeloId($id) {
        try {
            $sql = "SELECT * FROM documento WHERE id = '$id'
                     order by dataRevisao desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM treinamento order by id desc";
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
        $dados = new Treinamento();

        $dados->setId($row['id']);
        $dados->setLocalTreinamento($row['localTreinamento']);
        $dados->setDataInicio($row['dataInicio']);
        $dados->setDataFim($row['dataFim']);
        $dados->setAplicador($row['aplicador']);
        $dados->setConteudo($row['conteudo']);
        $dados->setDescricaoMetodo($row['descricaoMetodo']);
        $dados->setDataPrazo($row['dataPrazo']);
        $dados->setDataVerificacao($row['dataVerificacao']);
        $dados->setEvidencias($row['evidencias']);
        $dados->setEficaz($row['eficaz']);
        $dados->setResponsavel($row['responsavel']);
        $dados->setStatusId($row['statusId']);
        $dados->setDescricao($row['descricao']);

        return $dados;
    }

    private function ListaId($row) {
        $dados = new Treinamento();

        $dados->setId($row['id']);

        return $dados;
    }
     public function VerificaData($data) {
        try {
            $sql = "SELECT * FROM treinamento where dataFim <='$data' AND statusId = '2'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
     public function VerificaData2($data) {
        try {
            $sql = "SELECT * FROM treinamento where dataFim < '$data' AND statusId = '2'";
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

}
