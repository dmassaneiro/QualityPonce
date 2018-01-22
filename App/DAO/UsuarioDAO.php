<?php

class UsuarioDAO {
    
    public function Inserir(Usuario $obj) {
        try {
            $sql = "INSERT INTO usuario (    
               
                  login,
                  senha,
                  dataCadastro,
                  permissaoGrupoId,
                  funcionarioId)
                  VALUES (
                  :login,
                  :senha,
                  :dataCadastro,
                  :permissaoGrupoId,
                  :funcionarioId)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            
            $p_sql->bindValue(":login", $obj->getLogin());
            $p_sql->bindValue(":senha", $obj->getSenha());
            $p_sql->bindValue(":dataCadastro", $obj->getDataCadastro());
            $p_sql->bindValue(":permissaoGrupoId", $obj->getPermissaoGrupoId());
            $p_sql->bindValue(":funcionarioId", $obj->getFuncionarioId());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Usuario $obj) {
        try {
            $sql = "UPDATE usuario set
                
                  login=:login,
                  senha=:senha,
                  dataCadastro=:dataCadastro,
                  permissaoGrupoId=:permissaoGrupoId,
                  funcionarioId=:funcionarioId
                                                     
                  WHERE id = :id";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":login", $obj->getLogin());
            $p_sql->bindValue(":senha", $obj->getSenha());
            $p_sql->bindValue(":dataCadastro", $obj->getDataCadastro());
            $p_sql->bindValue(":permissaoGrupoId", $obj->getPermissaoGrupoId());
            $p_sql->bindValue(":funcionarioId", $obj->getFuncionarioId());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($setorId) {
        try {
            $sql = "DELETE FROM usuario WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $setorId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
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
    public function VerificaseExiste($funcionarioId) {
        try {
            $sql = "SELECT * FROM usuario WHERE funcionarioId = '$funcionarioId'
                     order by id desc limit 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaFuncionario($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM usuario order by id asc";
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
    public function BuscaNomedoPermissao($id) {
        try {
            $sql = "SELECT * FROM permissaogrupo WHERE id = '$id' order by descricao asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Permissao($p_sql->fetch(PDO::FETCH_ASSOC));
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

        return $funcionario;
    }
    private function Permissao($row) {
        $funcionario = new PermissaoGrupo();
//        $funcionario->setId($row['id']);
        $funcionario->setDescricao($row['descricao']);
        

        return $funcionario;
    }
    private function Lista($row) {
        $u = new Usuario();
        $u->setId($row['id']);
        $u->setDataCadastro($row['dataCadastro']);
        $u->setLogin($row['login']);
        $u->setSenha($row['senha']);
        $u->setPermissaoGrupoId($row['permissaoGrupoId']);
        $u->setFuncionarioId($row['funcionarioId']);

        return $u;
    }
   
}
