<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Montagem
 *
 * @author diegu
 */
class Montagem {
    //put your code here
    private $itemMontagemId;
    private $fichaTecnicaId;
    private $data;
    private $responsavel;
    
    function getItemMontagemId() {
        return $this->itemMontagemId;
    }

    function getFichaTecnicaId() {
        return $this->fichaTecnicaId;
    }

    function getData() {
        return $this->data;
    }

    function getResponsavel() {
        return $this->responsavel;
    }

    function setItemMontagemId($itemMontagemId) {
        $this->itemMontagemId = $itemMontagemId;
    }

    function setFichaTecnicaId($fichaTecnicaId) {
        $this->fichaTecnicaId = $fichaTecnicaId;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }


    
   
}
