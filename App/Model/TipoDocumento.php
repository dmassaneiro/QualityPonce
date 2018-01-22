<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoDocumento
 *
 * @author diegu
 */
class TipoDocumento {
    //put your code here
    private $id;
    private $descricao;
    private $sigla;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getSigla() {
        return $this->sigla;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }


}
