<?php

//
//include_once '../../Config/ConexaoPDO.php';
//include_once '../DAO/FornecedorDAO.php';
//include_once '../Model/Fornecedor.php';

class LaudoInspecaoDAO {

    public function Inserir(LaudoInspecao $obj) {
        try {
            $sql = "INSERT INTO laudoinspecao (    
               
                  dataInspecao,
                  numeroNota,
                  numeroLote,
                  dataRecebimento,
                  quantidadeLote,
                  quantiadadeConforme,
                  quantidadeDefeito,
                  observacao,
                  statusId,
                  fornecedorId,
                  materiaPrimaId,
                  criterios,
                  tipoInspecao1,
                  tipoInspecao2)
                  
                  VALUES (
                  :dataInspecao,
                  :numeroNota,
                  :numeroLote,
                  :dataRecebimento,
                  :quantidadeLote,
                  :quantiadadeConforme,
                  :quantidadeDefeito,
                  :observacao,
                  :statusId,
                  :fornecedorId,
                  :materiaPrimaId,
                  :criterios,
                  :tipoInspecao1,
                  :tipoInspecao2)";

            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":dataInspecao", $obj->getDataInspecao());
            $p_sql->bindValue(":numeroNota", $obj->getNumeroNota());
            $p_sql->bindValue(":numeroLote", $obj->getNumeroLote());
            $p_sql->bindValue(":dataRecebimento", $obj->getDataRecebimento());
            $p_sql->bindValue(":quantidadeLote", $obj->getQuantidadeLote());
            $p_sql->bindValue(":quantiadadeConforme", $obj->getQuantidadeConforme());
            $p_sql->bindValue(":quantidadeDefeito", $obj->getQuantidadeDefeito());
            $p_sql->bindValue(":observacao", $obj->getObservacao());
            $p_sql->bindValue(":statusId", $obj->getStatusId());
            $p_sql->bindValue(":fornecedorId", $obj->getFornecedor());
            $p_sql->bindValue(":materiaPrimaId", $obj->getMateriaPrimaId());
            $p_sql->bindValue(":criterios", $obj->getCriterios());
            $p_sql->bindValue(":tipoInspecao1", $obj->getTipoinspecao1());
            $p_sql->bindValue(":tipoInspecao2", $obj->getTipoinspecao2());


            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Inserir " . $e;
        }
    }

    public function Editar(LaudoInspecao $obj) {
        try {
            $sql = "UPDATE laudoinspecao set
                          
                  numeroNota=:numeroNota,
                  numeroLote=:numeroLote,
                  dataRecebimento=:dataRecebimento,
                  quantidadeLote=:quantidadeLote,
                  quantiadadeConforme=:quantiadadeConforme,
                  quantidadeDefeito=:quantidadeDefeito,
                  observacao=:observacao,
                  statusId=:statusId,
                  fornecedorId=:fornecedorId,
                  materiaPrimaId=:materiaPrimaId,
                  criterios=:criterios,
                  tipoInspecao1=:tipoInspecao1,
                  tipoInspecao2=:tipoInspecao2
                
                  WHERE id = :id";


            $p_sql = ConexaoPDO::getInstance()->prepare($sql);

            $p_sql->bindValue(":numeroNota", $obj->getNumeroNota());
            $p_sql->bindValue(":numeroLote", $obj->getNumeroLote());
            $p_sql->bindValue(":dataRecebimento", $obj->getDataRecebimento());
            $p_sql->bindValue(":quantidadeLote", $obj->getQuantidadeLote());
            $p_sql->bindValue(":quantiadadeConforme", $obj->getQuantidadeConforme());
            $p_sql->bindValue(":quantidadeDefeito", $obj->getQuantidadeDefeito());
            $p_sql->bindValue(":observacao", $obj->getObservacao());
            $p_sql->bindValue(":statusId", $obj->getStatusId());
            $p_sql->bindValue(":fornecedorId", $obj->getFornecedor());
            $p_sql->bindValue(":materiaPrimaId", $obj->getMateriaPrimaId());
            $p_sql->bindValue(":criterios", $obj->getCriterios());
            $p_sql->bindValue(":tipoInspecao1", $obj->getTipoinspecao1());
            $p_sql->bindValue(":tipoInspecao2", $obj->getTipoinspecao2());

            $p_sql->bindValue(":id", $obj->getId());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br>" . $e;
        }
    }

    public function Deletar($setorId) {
        try {
            $sql = "DELETE FROM laudoinspecao WHERE id = :cod";
            $p_sql = ConexaoPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $setorId);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Escluir. $e";
        }
    }

    public function BuscarUltimoRegistro() {
        try {
            $sql = "SELECT id FROM laudoinspecao ORDER BY id DESC LIMIT 1";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->ListaId($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    public function BuscarTodos() {
        try {
            $sql = "SELECT * FROM laudoinspecao order by id desc";
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

    public function BuscarTodosPorForncedor($desc) {
        try {

            $sql = "SELECT l.id as id, l.dataInspecao as dataInspecao, l.numeroNota as numeroNota, l.numeroLote as numeroLote,
                    l.dataRecebimento as dataRecebimento, l.quantidadeLote as quantidadeLote,l.quantiadadeConforme as quantiadadeConforme, l.quantidadeDefeito as quantidadeDefeito,l.observacao as observacao,l.statusId as statusId,
                    l.fornecedorId as fornecedorId,l.materiaPrimaId as materiaPrimaId,l.criterios as criterios,
                    l.tipoInspecao1 as tipoInspecao1,l.tipoInspecao2 as tipoInspecao2 ,f.nome
                    FROM laudoinspecao l
                    INNER JOIN fornecedor as f ON l.fornecedorId=f.id
                    WHERE f.nome LIKE '%$desc%' ORDER BY l.id asc";
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
            $sql = "SELECT * FROM laudoinspecao where id='$id'";
            $p_sql = ConexaoPDO::getInstance()->query($sql);
            $p_sql->execute();
            return $this->Lista($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar buscar." . $e;
        }
    }

    private function ListaId($id) {
        $dados = new LaudoInspecao();
        $dados->setId($id['id']);

        return $dados;
    }

    function Lista($row) {
        $dados = new LaudoInspecao();

        $dados->setId($row['id']);
        $dados->setDataInspecao($row['dataInspecao']);
        $dados->setNumeroNota($row['numeroNota']);
        $dados->setNumeroLote($row['numeroLote']);
        $dados->setDataRecebimento($row['dataRecebimento']);
        $dados->setFornecedor($row['fornecedorId']);
        $dados->setQuantidadeLote($row['quantidadeLote']);
        $dados->setQuantidadeConforme($row['quantiadadeConforme']);
        $dados->setQuantidadeDefeito($row['quantidadeDefeito']);
        $dados->setObservacao($row['observacao']);
        $dados->setStatusId($row['statusId']);
        $dados->setMateriaPrimaId($row['materiaPrimaId']);
        $dados->setCriterios($row['criterios']);
        $dados->setTipoinspecao1($row['tipoInspecao1']);
        $dados->setTipoinspecao2($row['tipoInspecao2']);

        return $dados;
    }

}
