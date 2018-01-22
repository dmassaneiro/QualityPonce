<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TesteFuncional
 *
 * @author diegu
 */
class TesteFuncional {
    //put your code here
    private $id;
    private $fichaTecnicaId;
    
    function getId() {
        return $this->id;
    }

    function getFichaTecnicaId() {
        return $this->fichaTecnicaId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFichaTecnicaId($fichaTecnicaId) {
        $this->fichaTecnicaId = $fichaTecnicaId;
    }


}
