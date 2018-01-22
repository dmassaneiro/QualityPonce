<?php


class Menu {
    
    private $id;
    private $descricao;
    private $telaId;
    private $telaNome;
    private $menuVinculado;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getTelaId() {
        return $this->telaId;
    }

    function getTelaNome() {
        return $this->telaNome;
    }

    function getMenuVinculado() {
        return $this->menuVinculado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setTelaId($telaId) {
        $this->telaId = $telaId;
    }

    function setTelaNome($telaNome) {
        $this->telaNome = $telaNome;
    }

    function setMenuVinculado($menuVinculado) {
        $this->menuVinculado = $menuVinculado;
    }


}
