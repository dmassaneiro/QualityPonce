<?php

class FichaTecnicaDAO {

    public function Inserir(FichaTecnica $obj) {
        try {
            $sql = "INSERT INTO fichatecnica (    
                  numeroOrdem,
                  numeriSerie,
                  dataInicio,
                  dataFim,
                  statusId,
                  produtoId)
                  VALUES (
                  :numeroOrdem,
                  :numeriSerie,
                  :dataInicio,
                  :dataFim,
                  :statusId,
                  :produtoId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":numeroOrdem", $obj->getNumeroOrdem());
            $p_sql->bindValue(":numeriSerie", $obj->getNumeroSerie());
            $p_sql->bindValue(":dataInicio", $obj->getDataInicio());
            $p_sql->bindValue(":dataFim", $obj->getDataFim());
            $p_sql->bindValue(":statusId", $obj->getStatusId());
            $p_sql->bindValue(":produtoId", $obj->getProdutoId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(FichaTecnica $obj) {
        try {
            $sql = "UPDATE fichatecnica set
                          
                  numeroOrdem=:numeroOrdem,
                  numeriSerie=:numeriSerie,
                  dataInicio=:dataInicio,
                  dataFim=:dataFim,
                  statusId=:statusId,
                  produtoId=:produtoId
                  
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":numeroOrdem", $obj->getNumeroOrdem());
            $p_sql->bindValue(":numeriSerie", $obj->getNumeroSerie());
            $p_sql->bindValue(":dataInicio", $obj->getDataInicio());
            $p_sql->bindValue(":dataFim", $obj->getDataFim());
            $p_sql->bindValue(":statusId", $obj->getStatusId());
            $p_sql->bindValue(":produtoId", $obj->getProdutoId());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Editar2(FichaTecnica $obj) {
        try {
            $sql = "UPDATE fichatecnica set
                          
                  numeroOrdem=:numeroOrdem,
                  numeriSerie=:numeriSerie,
                  dataInicio=:dataInicio,
                  dataFim=:dataFim,
                  
                  produtoId=:produtoId
                  
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":numeroOrdem", $obj->getNumeroOrdem());
            $p_sql->bindValue(":numeriSerie", $obj->getNumeroSerie());
            $p_sql->bindValue(":dataInicio", $obj->getDataInicio());
            $p_sql->bindValue(":dataFim", $obj->getDataFim());
//            $p_sql->bindValue(":statusId", $obj->getStatusId());
            $p_sql->bindValue(":produtoId", $obj->getProdutoId());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Cancela(FichaTecnica $obj) {
        try {
            $sql = "UPDATE fichatecnica set
                          
                  statusId=:statusId
                  
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":statusId", $obj->getStatusId());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function EditarConcluir(FichaTecnica $obj) {
        try {
            $sql = "UPDATE fichatecnica set
                          
                 statusId=:statusId
 
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":statusId", $obj->getStatusId());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($setorId) {
        try {
            $sql = "DELETE FROM fichatecnica WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $setorId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarUltimoRegistro() {
        try {
            $sql = "SELECT id FROM fichatecnica ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM fichatecnica order by id desc";
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

    public function BuscarTodosPorStatus($statusID) {
        try {
            $sql = "SELECT * FROM fichatecnica
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

    public function BuscarTodosPelaOrdem($nrordem) {
        try {
            $sql = "SELECT * FROM fichatecnica
                    WHERE numeroOrdem = '$nrordem' order by id desc";
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

    public function BuscarTodosPeloProduto($produto) {
        try {
            $sql = "SELECT f.id as id, f.numeroOrdem as numeroOrdem,f.numeriSerie as numeriSerie, f.dataInicio as dataInicio,
                    f.dataFim as dataFim, f.statusId as statusId, f.produtoId as produtoId,p.nome
                    FROM fichatecnica f
                    INNER JOIN produto as p ON f.produtoId=p.id
                    WHERE p.nome LIKE '%$produto%' order by id desc";
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

    public function BuscarTodosPelaSerie($nrordem) {
        try {
            $sql = "SELECT * FROM fichatecnica
                    WHERE numeriSerie = '$nrordem' order by id desc";
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
            $sql = "SELECT * FROM fichatecnica
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

    public function BuscarTodosVencidos($data) {
        try {
            $sql = "SELECT * FROM fichatecnica
                    WHERE dataFim < '$data' order by id desc";
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
            $sql = "SELECT * FROM fichatecnica
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

    public function BuscarTodosPorForncedor($cnpj) {
        $f = new FornecedorDAO();
        try {
            $rs = $f->BuscarCnpj($cnpj);

            $sql = "SELECT * FROM fichatecnica
                    WHERE fornecedorId = '$rs->getId()'  order by id desc";
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
            $sql = "SELECT * FROM fichatecnica where id='$id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function VerificaData($data) {
        try {
            $sql = "SELECT * FROM fichatecnica where dataFim =  '$data' AND statusId ='2'";
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
    public function VerificaData2($data) {
        try {
            $sql = "SELECT * FROM fichatecnica where dataFim < '$data' AND statusId ='2'";
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
        $dados = new FichaTecnica();
        $dados->setId($id['id']);

        return $dados;
    }

    function Lista($row) {
        $dados = new FichaTecnica();

        $dados->setId($row['id']);
        $dados->setDataFim($row['dataFim']);
        $dados->setDataInicio($row['dataInicio']);
        $dados->setNumeroOrdem($row['numeroOrdem']);
        $dados->setNumeroSerie($row['numeriSerie']);
        $dados->setProdutoId($row['produtoId']);
        $dados->setStatusId($row['statusId']);

        return $dados;
    }

}
