<?php

class FuncionarioDAO {

    public function Inserir(Funcionario $obj) {
        try {
            $sql = "INSERT INTO funcionario (    
                  nome,
                  sobrenome,
                  sexo,
                  dataCadastro,
                  setorId,
                  situacao)
                  VALUES (
                  :nome,
                  :sobrenome,
                  :sexo,
                  :dataCadastro,
                  :setorId,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $obj->getNome());
            $p_sql->bindValue(":sobrenome", $obj->getSobrenome());
            $p_sql->bindValue(":sexo", $obj->getSexo());
            $p_sql->bindValue(":dataCadastro", $obj->getDataCadastro());
            $p_sql->bindValue(":setorId", $obj->getSetorId());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Funcionario $obj) {
        try {
            $sql = "UPDATE funcionario set
                
                  nome=:nome,
                  sobrenome=:sobrenome,
                  sexo=:sexo,
                  dataCadastro=:dataCadastro,
                  setorId=:setorId,
                  situacao=:situacao
                                   
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $obj->getNome());
            $p_sql->bindValue(":sobrenome", $obj->getSobrenome());
            $p_sql->bindValue(":sexo", $obj->getSexo());
            $p_sql->bindValue(":dataCadastro", $obj->getDataCadastro());
            $p_sql->bindValue(":setorId", $obj->getSetorId());
            $p_sql->bindValue(":situacao", $obj->getSituacao());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($Id) {
        try {
            $sql = "DELETE FROM funcionario WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $Id);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarTodosFuncionario() {
        try {
            $sql = "SELECT * FROM funcionario order by nome asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->ListaFuncionario($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    public function BuscarTodosFuncionarioAtivo() {
        try {
            $sql = "SELECT * FROM funcionario WHERE situacao = 'A' order by nome asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->ListaFuncionario($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    public function BuscarTodosFuncionarioAtivoMenos($id) {
        try {
            $sql = "SELECT * FROM funcionario WHERE id <>'$id' AND situacao = 'A' order by nome asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->ListaFuncionario($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarTodosFuncionarioNome($nome) {
        try {
            $sql = "SELECT * FROM funcionario WHERE nome LIKE '%$nome%' OR sobrenome LIKE '%$nome%'
                     order by nome asc";
            $result = ConexaoPDO::getInstance()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->ListaFuncionario($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function BuscarNomeFuncionario($funcionarioId) {
        try {
            $sql = "SELECT * FROM funcionario WHERE id = '$funcionarioId'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaFuncionario($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function BuscarId($Nome) {
        try {
            $sql = "SELECT * FROM funcionario WHERE nome = '$Nome'
                     order by nome desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaFuncionario($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

   
    public function BotaoPesquisaPorNome($nome) {
        try {
            $sql = "SELECT * FROM funcionario WHERE nome LIKE '%$nome%' 
                     order by nome desc ";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaFuncionario($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function ListaFuncionario($row) {
        $funcionario = new Funcionario();
        $funcionario->setId($row['id']);
        $funcionario->setNome($row['nome']);
        $funcionario->setSobrenome($row['sobrenome']);
        $funcionario->setSexo($row['sexo']);
        $funcionario->setDataCadastro($row['dataCadastro']);
        $funcionario->setSetorId($row['setorId']);
        $funcionario->setSituacao($row['situacao']);

        return $funcionario;
    }

    public function VerificaParaDeletar1($Id) {
        try {
            $sql = "SELECT count(funcionarioId) as id FROM treinamentofuncionario WHERE funcionarioId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function VerificaParaDeletar2($Id) {
        try {
            $sql = "SELECT count(funcionarioId) as id FROM  usuario WHERE funcionarioId = '$Id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaCount($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    private function ListaCount($row) {
        $setor = new Funcionario();
        $setor->setId($row['id']);
        return $setor;
    }
}
