<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CriterioAprovacao
 *
 * @author diegu
 */
class CriterioAprovacao {
    //put your code here
    private $id;
    private $descricao;
    private $materiaPrimaId;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getMateriaPrimaId() {
        return $this->materiaPrimaId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setMateriaPrimaId($materiaPrimaId) {
        $this->materiaPrimaId = $materiaPrimaId;
    }


}
