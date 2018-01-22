<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HistoricoAuditoria
 *
 * @author diegu
 */
class HistoricoAuditoria {
    //put your code here
    private $id;
    private $data;
    private $funcionarioId;
    private $statusId;
    private $auditoriaId;
    
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

    function getAuditoriaId() {
        return $this->auditoriaId;
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

    function setAuditoriaId($auditoriaId) {
        $this->auditoriaId = $auditoriaId;
    }


}
