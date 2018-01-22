<?php

class Fornecedor {
    //put your code here
    private $id;
    private $cnpj;
    private $nome;
    private $nomeFantasia;
    private $situacao;
    
    function getId() {
        return $this->id;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getNome() {
        return $this->nome;
    }

    function getNomeFantasia() {
        return $this->nomeFantasia;
    }

    

    function getSituacao() {
        return $this->situacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setNomeFantasia($nomeFantasia) {
        $this->nomeFantasia = $nomeFantasia;
    }

    
    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }


}
