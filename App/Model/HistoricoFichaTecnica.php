<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HistoricoFichaTecnica
 *
 * @author diegu
 */
class HistoricoFichaTecnica {
    //put your code here
    private $id;
    private $data;
    private $statusId;
    private $funcionarioId;
    private $fichaTecnicaId;
    
    function getFichaTecnicaId() {
        return $this->fichaTecnicaId;
    }

    function setFichaTecnicaId($fichaTecnicaId) {
        $this->fichaTecnicaId = $fichaTecnicaId;
    }

        
    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function getFuncionarioId() {
        return $this->funcionarioId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }

    function setFuncionarioId($funcionarioId) {
        $this->funcionarioId = $funcionarioId;
    }


}
