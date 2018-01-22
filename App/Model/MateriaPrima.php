<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MateriaPrima
 *
 * @author diegu
 */
class MateriaPrima {
    //put your code here
    private $id;
    private $nome;
    private $descricao;
    private $dataCadastro;
    private $situacao;
    private $fornecedorId;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function getFornecedorId() {
        return $this->fornecedorId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function setFornecedorId($fornecedorId) {
        $this->fornecedorId = $fornecedorId;
    }


}
