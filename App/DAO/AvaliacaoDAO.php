<?php

class AvaliacaoDAO {

    public function Inserir(AvaliacaoFornecedor $obj) {
        try {
            $sql = "INSERT INTO avaliacaofornecedor (    
               
                  data,
                  media,
                  produtosServicos,
                  observacao,
                  Fornecedor_id,
                  statusId)
                  VALUES (
                  :data,
                  :media,
                  :produtosServicos,
                  :observacao,
                  :Fornecedor_id,
                  :statusId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":data", $obj->getData());
            $p_sql->bindValue(":media", $obj->getMedia());
            $p_sql->bindValue(":produtosServicos", $obj->getProdutosServicos());
            $p_sql->bindValue(":observacao", $obj->getObservacao());
            $p_sql->bindValue(":Fornecedor_id", $obj->getFornecedorId());
            $p_sql->bindValue(":statusId", $obj->getStatusId());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(AvaliacaoFornecedor $obj) {
        try {
            $sql = "UPDATE avaliacaofornecedor set
                          
                  data=:data,
                  media=:media,
                  produtosServicos=:produtosServicos,
                  observacao=:observacao,
                  Fornecedor_id=:Fornecedor_id,
                  statusId=:statusId
                  
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":data", $obj->getData());
            $p_sql->bindValue(":media", $obj->getMedia());
            $p_sql->bindValue(":produtosServicos", $obj->getProdutosServicos());
            $p_sql->bindValue(":observacao", $obj->getObservacao());
            $p_sql->bindValue(":Fornecedor_id", $obj->getFornecedorId());
            $p_sql->bindValue(":statusId", $obj->getStatusId());
            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($setorId) {
        try {
            $sql = "DELETE FROM avaliacaofornecedor WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $setorId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarUltimoRegistro() {
        try {
            $sql = "SELECT id FROM avaliacaofornecedor ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM avaliacaofornecedor order by id desc";
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
            $sql = "SELECT * FROM laudoinspecao
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

    public function BuscarTodosNcProdutosControle($controle) {
        try {
            $sql = "SELECT * FROM laudoinspecao
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

    public function BuscarTodosPorPeriodo($inicio, $fim) {
        try {
            $sql = "SELECT * FROM laudoinspecao
                    WHERE dataInspecao between '$inicio' and '$fim' order by id desc";
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

            $sql = "SELECT * FROM laudoinspecao
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
            $sql = "SELECT * FROM avaliacaofornecedor where id='$id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function ListaId($id) {
        $dados = new AvaliacaoFornecedor();
        $dados->setId($id['id']);

        return $dados;
    }

    function Lista($row) {
        $dados = new AvaliacaoFornecedor();

        $dados->setId($row['id']);
        $dados->setData($row['data']);
        $dados->setMedia($row['media']);
        $dados->setProdutosServicos($row['produtosServicos']);
        $dados->setObservacao($row['observacao']);
        $dados->setFornecedorId($row['Fornecedor_id']);
        $dados->setStatusId($row['statusId']);
        
        return $dados;
    }

}
