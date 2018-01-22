<?php

class TreinamentoFuncionarioDAO {
   
     public function Inserir(TreinamentoFuncionario $dados) {
        try {
            $sql = "INSERT INTO treinamentofuncionario (    
                  treinamentoId,
                  funcionarioId,
                  situacao)
                  VALUES (
                  :treinamentoId,
                  :funcionarioId,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":treinamentoId", $dados->getTreinamentoId());
            $p_sql->bindValue(":funcionarioId", $dados->getFuncionarioId());
            $p_sql->bindValue(":situacao", $dados->getSituacao());
            
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
            $sql = "DELETE FROM treinamentofuncionario WHERE treinamentoId = :cod";
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

    public function BuscarFuncionariosDoTreinamento($id) {
        try {
            $sql = "SELECT * FROM treinamentofuncionario WHERE treinamentoId = '$id'";
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
    public function BuscarFuncionariosDoTreinamento2($id) {
        try {
            $sql = "SELECT t.treinamentoId AS treinamentoId, t.funcionarioId as funcionarioId ,f.nome
                    FROM treinamentofuncionario t
                    INNER JOIN funcionario as f ON t.funcionarioId = f.id
                    WHERE treinamentoId = '$id'
                    order BY f.nome ";
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
        $dados = new TreinamentoFuncionario();
        $dados->setTreinamentoId($row['treinamentoId']);
        $dados->setFuncionarioId($row['funcionarioId']);
//        $dados->setSituacao($row['situacao']);
        

        return $dados;
    }
}
