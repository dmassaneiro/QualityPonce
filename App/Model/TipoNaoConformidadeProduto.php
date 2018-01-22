<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoNaoConformidadeProduto
 *
 * @author diegu
 */
class TipoNaoConformidadeProduto {
    //put your code here
    private $id;
    private $descricao;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($nome) {
        $this->descricao = $nome;
    }


}
