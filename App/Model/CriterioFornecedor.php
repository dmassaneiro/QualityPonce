<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CriterioFornecedor
 *
 * @author diegu
 */
class CriterioFornecedor {
    //put your code here
    
    private $id;
    private $descricao;
    private $notaPeso;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getNotaPeso() {
        return $this->notaPeso;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setNotaPeso($notaPeso) {
        $this->notaPeso = $notaPeso;
    }


}
