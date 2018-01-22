<?php


class Tela {
    
    private $id;
    private $nome;
    private $titulo;
    private $permissaoId;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getPermissaoId() {
        return $this->permissaoId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setPermissaoId($permissaoId) {
        $this->permissaoId = $permissaoId;
    }


}
