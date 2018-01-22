<?php

class ProdutoDAO {

    public function Inserir(Produto $produto) {
        try {
            $sql = "INSERT INTO produto (    
                  nome,
                  descricao,
                  categoriaId,
                  situacao)
                  VALUES (
                  :nome,
                  :descricao,
                  :categoriaId,
                  :situacao)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $produto->getNome());
            $p_sql->bindValue(":descricao", $produto->getDescricao());
            $p_sql->bindValue(":categoriaId", $produto->getCategoriaId());
            $p_sql->bindValue(":situacao", $produto->getSituacao());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir o representante" . $e;
        }
    }

    public function Editar(Produto $produto) {
        try {
            $sql = "UPDATE produto set
                
                  nome=:nome,
                  descricao=:descricao,
                  categoriaId=:categoriaId,
                  situacao=:situacao
                                   
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":nome", $produto->getNome());
            $p_sql->bindValue(":descricao", $produto->getDescricao());
            $p_sql->bindValue(":categoriaId", $produto->getCategoriaId());
            $p_sql->bindValue(":situacao", $produto->getSituacao());

            $p_sql->bindValue(":id", $produto->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($produtoId) {
        try {
            $sql = "DELETE FROM produto WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $produtoId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarTodosProdutos() {
        try {
            $sql = "SELECT * FROM produto order by nome asc";
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

    public function VerificaSeProdutoExiste($id) {
        try {
            $sql = "SELECT * FROM produto WHERE id = '$id' order by nome asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function VerificaParaDeletar($id) {
        try {
            $sql = "SELECT * FROM fichatecnica WHERE produtoId = '$id' order by id asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function VerificaParaDeletar2($id) {
        try {
            $sql = "SELECT * FROM itemmontagem WHERE produtoId = '$id' order by id asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function VerificaParaDeletar3($id) {
        try {
            $sql = "SELECT * FROM modo   WHERE produtoId = '$id' order by id asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }
    public function VerificaParaDeletar4($id) {
        try {
            $sql = "SELECT * FROM itemliberacao WHERE produtoId = '$id' order by id asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscaNomedoProduto($id) {
        try {
            $sql = "SELECT * FROM produto WHERE id = '$id' order by nome asc";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodosProdutosAtivo() {
        try {
            $sql = "SELECT * FROM produto WHERE situacao = 'A' order by nome asc";
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

    public function BuscarTodosProdutosAtivoMenos($idproduto) {
        try {
            $sql = "SELECT * FROM produto WHERE situacao = 'A' AND id<>$idproduto order by nome asc";
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
        $produto = new Produto();

        $produto->setId($row['id']);
        $produto->setNome($row['nome']);
        $produto->setDescricao($row['descricao']);
        $produto->setCategoriaId($row['categoriaId']);
        $produto->setSituacao($row['situacao']);

        return $produto;
    }

}
