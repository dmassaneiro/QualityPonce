<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Susgestao
 *
 * @author diegu
 */
class Susgestao {
    //put your code here
    private $id;
    private $descricao;
    private $auditoriaId;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getAuditoriaId() {
        return $this->auditoriaId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setAuditoriaId($auditoriaId) {
        $this->auditoriaId = $auditoriaId;
    }


}
