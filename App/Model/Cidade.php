<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidade
 *
 * @author diegu
 */
class Cidade {
    //put your code here
    private $id;
    private $nome;
    private $estadoId;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEstadoId() {
        return $this->estadoId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEstadoId($estadoId) {
        $this->estadoId = $estadoId;
    }


}
