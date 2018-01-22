<?php

class FornecedorDAO {

    public function Inserir(Fornecedor $obj) {
        try {
            $sql = "INSERT INTO fornecedor (    
                  nome,
                  nomeFantasia,
                  cnpj,
                  situacao)
                  VALUES (
                  :nome,
                  :nomeFantasia,
                  :cnpj,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $obj->getNome());
            $p_sql->bindValue(":nomeFantasia", $obj->getNomeFantasia());
            $p_sql->bindValue(":cnpj", $obj->getCnpj());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Fornecedor $obj) {
        try {
            $sql = "UPDATE fornecedor set
                
                  nome=:nome,
                  nomeFantasia=:nomeFantasia,
                  cnpj=:cnpj,
                  situacao=:situacao
                                   
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $obj->getNome());
            $p_sql->bindValue(":nomeFantasia", $obj->getNomeFantasia());
            $p_sql->bindValue(":cnpj", $obj->getCnpj());
            $p_sql->bindValue(":situacao", $obj->getSituacao());


            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM fornecedor WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarTodosAtivo() {
        try {
            $sql = "SELECT * FROM fornecedor WHERE situacao ='A' order by nome asc";
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

    public function BuscarTodosAtivoMenos($id) {
        try {
            $sql = "SELECT * FROM fornecedor WHERE id<>'$id' AND situacao ='A' order by nome asc";
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

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM fornecedor  order by nome asc";
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
        $dados = new Fornecedor();

        $dados->setId($row['id']);
        $dados->setNome($row['nome']);
        $dados->setNomeFantasia($row['nomeFantasia']);
        $dados->setCnpj($row['cnpj']);
//        $dados->setContatoId($row['contatoId']);
//        $dados->setEnderecoId($row['enderecoId']);
        $dados->setSituacao($row['situacao']);


        return $dados;
    }

    public function BuscarTodosDescricao($desc) {
        try {
            $sql = "SELECT * FROM fornecedor  WHERE nome LIKE '%$desc%' order by nome asc";
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

    public function BuscarNome($Id) {
        try {
            $sql = "SELECT * FROM fornecedor WHERE id = '$Id'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function VerificaCnpj($cnpj) {
        try {
            $sql = "SELECT * FROM fornecedor WHERE cnpj = '$cnpj'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarCnpj($cnpj) {
        try {
            $sql = "SELECT * FROM fornecedor WHERE cnpj = '$cnpj'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarPorNome($Id) {
        try {
            $sql = "SELECT * FROM fornecedor WHERE nome = '$Id'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->listaNome($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function listaNome($row) {
        $f = new Fornecedor();

        $f->setId($row['id']);
        $f->setNome($row['nome']);
        $f->setCnpj($row['cnpj']);

        return $f;
    }

    public function VerificaParaDeletar($Id) {
        try {
            $sql = "SELECT count(fornecedorId) as id FROM materiaprima WHERE fornecedorId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function VerificaParaDeletar2($Id) {
        try {
            $sql = "SELECT count(Fornecedor_id) as id FROM avaliacaofornecedor WHERE Fornecedor_id = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function ListaCount($row) {
        $setor = new Fornecedor();
        $setor->setId($row['id']);
        return $setor;
    }

}
