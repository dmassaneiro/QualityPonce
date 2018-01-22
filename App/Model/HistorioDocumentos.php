<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HistorioDocumentos
 *
 * @author diegu
 */
class HistorioDocumentos {
    
    private $id;
    private $data;
    private $funcionarioId;
    private $statusId;
    private $documentoId;
    
    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getFuncionarioId() {
        return $this->funcionarioId;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function getDocumentoId() {
        return $this->documentoId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setFuncionarioId($funcionarioId) {
        $this->funcionarioId = $funcionarioId;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }

    function setDocumentoId($documentoId) {
        $this->documentoId = $documentoId;
    }


}
