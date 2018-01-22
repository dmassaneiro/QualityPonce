<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemTeste
 *
 * @author diegu
 */
class ItemTeste {
    //put your code here
    private $id;
    private $descricao;
    private $produtoId;
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

    function getDescricao() {
        return $this->descricao;
    }

    function getProdutoId() {
        return $this->produtoId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setProdutoId($produtoId) {
        $this->produtoId = $produtoId;
    }


}
