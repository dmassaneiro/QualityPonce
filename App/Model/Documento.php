<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documento
 *
 * @author diegu
 */
class Documento {
    //put your code here
    private $id;
    private $dataRevisao;
    private $descricao;
    private $autor;
    private $dataAprovacao;
    private $dataValidade;
    private $tipoDocumentoId;
    private $statusId;
    
    function getId() {
        return $this->id;
    }

    function getDataRevisao() {
        return $this->dataRevisao;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getAutor() {
        return $this->autor;
    }

    function getDataAprovacao() {
        return $this->dataAprovacao;
    }

    function getDataValidade() {
        return $this->dataValidade;
    }

    function getTipoDocumentoId() {
        return $this->tipoDocumentoId;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDataRevisao($dataRevisao) {
        $this->dataRevisao = $dataRevisao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setDataAprovacao($dataAprovacao) {
        $this->dataAprovacao = $dataAprovacao;
    }

    function setDataValidade($dataValidade) {
        $this->dataValidade = $dataValidade;
    }

    function setTipoDocumentoId($tipoDocumentoId) {
        $this->tipoDocumentoId = $tipoDocumentoId;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }


}
