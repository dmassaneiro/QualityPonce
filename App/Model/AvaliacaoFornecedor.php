<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AvaliacaoFornecedor
 *
 * @author diegu
 */
class AvaliacaoFornecedor {
    //put your code here
    private $id;
    private $data;
    private $media;
    private $produtosServicos;
    private $observacao;
    private $fornecedorId;
    private $statusId;
    
    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getMedia() {
        return $this->media;
    }

    function getProdutosServicos() {
        return $this->produtosServicos;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function getFornecedorId() {
        return $this->fornecedorId;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setMedia($media) {
        $this->media = $media;
    }

    function setProdutosServicos($produtosServicos) {
        $this->produtosServicos = $produtosServicos;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    function setFornecedorId($fornecedorId) {
        $this->fornecedorId = $fornecedorId;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }


}
