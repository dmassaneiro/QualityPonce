<?php

class DocumentoDAO {

    public function Inserir(Documento $dados) {
        try {
            $sql = "INSERT INTO documento (    
                  dataRevisao,
                  descricao,
                  autor,
                  dataAprovacao,
                  dataValidade,
                  tipoDocumentoId,
                  statusId)
                  VALUES (
                  :dataRevisao,
                  :descricao,
                  :autor,
                  :dataAprovacao,
                  :dataValidade,
                  :tipoDocumentoId,
                  :statusId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataRevisao", $dados->getDataRevisao());
            $p_sql->bindValue(":descricao", $dados->getDescricao());
            $p_sql->bindValue(":autor", $dados->getAutor());
            $p_sql->bindValue(":dataAprovacao", $dados->getDataAprovacao());
            $p_sql->bindValue(":dataValidade", $dados->getDataValidade());
            $p_sql->bindValue(":tipoDocumentoId", $dados->getTipoDocumentoId());
            $p_sql->bindValue(":statusId", $dados->getStatusId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Documento $dados) {
        try {
            $sql = "UPDATE documento set
                
                  dataRevisao=:dataRevisao,
                  descricao=:descricao,
                  autor=:autor,
                  dataAprovacao=:dataAprovacao,
                  dataValidade=:dataValidade,
                  tipoDocumentoId=:tipoDocumentoId,
                  statusId=:statusId
                                   
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataRevisao", $dados->getDataRevisao());
            $p_sql->bindValue(":descricao", $dados->getDescricao());
            $p_sql->bindValue(":autor", $dados->getAutor());
            $p_sql->bindValue(":dataAprovacao", $dados->getDataAprovacao());
            $p_sql->bindValue(":dataValidade", $dados->getDataValidade());
            $p_sql->bindValue(":tipoDocumentoId", $dados->getTipoDocumentoId());
            $p_sql->bindValue(":statusId", $dados->getStatusId());

            $p_sql->bindValue(":id", $dados->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM documento WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }

    public function BuscarUltimoRegistro() {
        try {
            $sql = "SELECT id FROM documento ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    
    public function BuscarTodosStatus($statusID) {
        try {
            $sql = "SELECT * FROM documento
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
    public function BuscarTodosPeriodo($inicio,$fim) {
        try {
            $sql = "SELECT * FROM documento
                    WHERE dataRevisao between '$inicio' and '$fim' order by id desc";
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
            $sql = "SELECT * FROM documento WHERE id = '$Id'
                     order by id desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
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
    public function VerificaValidade($data) {
        try {
            $sql = "SELECT * FROM documento WHERE dataValidade <= '$data'
                     order by id desc limit 1";
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
            $sql = "SELECT * FROM documento order by id desc";
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
        $dados = new Documento();

        $dados->setId($row['Id']);
        $dados->setDataRevisao($row['dataRevisao']);
        $dados->setDataValidade($row['dataValidade']);
        $dados->setDataAprovacao($row['dataAprovacao']);
        $dados->setAutor($row['autor']);
        $dados->setDescricao($row['descricao']);
        $dados->setTipoDocumentoId($row['tipoDocumentoId']);
        $dados->setStatusId($row['statusId']);

        return $dados;
    }
    private function ListaId($row) {
        $dados = new Documento();

        $dados->setId($row['id']);
              
        return $dados;
    }

}
