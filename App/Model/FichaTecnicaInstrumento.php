<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FichaTecnicaInstrumento
 *
 * @author diegu
 */
class FichaTecnicaInstrumento {
    //put your code here
    private $fichaTecnicaId;
    private $instrumentoId;
    
    function getFichaTecnicaId() {
        return $this->fichaTecnicaId;
    }

    function getInstrumentoId() {
        return $this->instrumentoId;
    }

    function setFichaTecnicaId($fichaTecnicaId) {
        $this->fichaTecnicaId = $fichaTecnicaId;
    }

    function setInstrumentoId($instrumentoId) {
        $this->instrumentoId = $instrumentoId;
    }


}
