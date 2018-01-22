<?php


class Funcionario {
   
    private $id;
    private $nome;
    private $sobrenome;
    private $sexo;
    private $dataCadastro;
    private $setorId;
    private $situacao;
    
    function getSituacao() {
        return $this->situacao;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

        
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getSetorId() {
        return $this->setorId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setSetorId($setorId) {
        $this->setorId = $setorId;
    }


}
