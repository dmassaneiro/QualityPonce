<?php

class MateriaPrimaDAO {

    public function Inserir(MateriaPrima $dados) {
        try {
            $sql = "INSERT INTO materiaprima (    
                  nome,
                  descricao,
                  fornecedorId,
                  dataCadastro,
                  situacao)
                  VALUES (
                  :nome,
                  :descricao,
                  :fornecedorId,
                  :dataCadastro,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $dados->getNome());
            $p_sql->bindValue(":descricao", $dados->getDescricao());
            $p_sql->bindValue(":fornecedorId", $dados->getFornecedorId());
            $p_sql->bindValue(":dataCadastro", $dados->getDataCadastro());
            $p_sql->bindValue(":situacao", $dados->getSituacao());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(MateriaPrima $dados) {
        try {
            $sql = "UPDATE materiaprima set
                
                  nome=:nome,
                  descricao=:descricao,
                  fornecedorId=:fornecedorId,
                  situacao=:situacao
                                   
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $dados->getNome());
            $p_sql->bindValue(":descricao", $dados->getDescricao());
            $p_sql->bindValue(":fornecedorId", $dados->getFornecedorId());
            $p_sql->bindValue(":situacao", $dados->getSituacao());

            $p_sql->bindValue(":id", $dados->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM materiaprima WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir. $e";
        }
    }
    
    public function VerificaParaDeletar2($Id) {
        try {
            $sql = "SELECT count(materiaPrimaId) as id FROM  laudoinspecao WHERE materiaPrimaId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $setor = new MateriaPrima();
        $setor->setId($row['id']);
        return $setor;
    }

    public function BuscarEdit($Id) {
        try {
            $sql = "SELECT * FROM materiaprima WHERE id = '$Id'
                     order by nome desc limit 1";
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
    public function VerificaFornecedor($id) {
        try {
            $sql = "SELECT * FROM materiaprima WHERE fornecedorId = '$id'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function BuscaNome($id) {
        try {
            $sql = "SELECT * FROM materiaprima WHERE id = '$id'
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
            $sql = "SELECT * FROM materiaprima WHERE id = '$id'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM materiaprima order by nome asc";
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
    public function BuscarTodosDescricao($desc) {
        try {
            $sql = "SELECT * FROM materiaprima WHERE nome LIKE '%$desc%' order by nome asc";
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
    public function BuscarTodosAtiva() {
        try {
            $sql = "SELECT * FROM materiaprima WHERE situacao ='A' order by nome asc";
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
    public function BuscarTodosAtivaMenos($id) {
        try {
            $sql = "SELECT * FROM materiaprima WHERE id<>'$id'AND situacao ='A' order by nome asc";
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
        $dados = new MateriaPrima();

        $dados->setId($row['id']);
        $dados->setNome($row['nome']);
        $dados->setDescricao($row['descricao']);
        $dados->setFornecedorId($row['fornecedorId']);
        $dados->setDataCadastro($row['dataCadastro']);
        $dados->setSituacao($row['situacao']);

        return $dados;
    }

}
