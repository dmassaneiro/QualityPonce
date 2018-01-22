<?php


class PermissaoAcesso {
    
    private $id;
    private $descricao;
    private $situacao;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }


}
