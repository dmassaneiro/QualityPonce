<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TesteItemTeste
 *
 * @author diegu
 */
class TesteItemTeste {
    //put your code here
    private $testeFuncionalId;
    private $itemTesteId;
    private $data;
    private $resultado;
    private $responsavel;
    private $observacao;
    private $fichaTecnica_id;
    
    function getFichaTecnica_id() {
        return $this->fichaTecnica_id;
    }

    function setFichaTecnica_id($fichaTecnica_id) {
        $this->fichaTecnica_id = $fichaTecnica_id;
    }

        
    function getTesteFuncionalId() {
        return $this->testeFuncionalId;
    }

    function getItemTesteId() {
        return $this->itemTesteId;
    }

    function getData() {
        return $this->data;
    }

    function getResultado() {
        return $this->resultado;
    }

    function getResponsavel() {
        return $this->responsavel;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function setTesteFuncionalId($testeFuncionalId) {
        $this->testeFuncionalId = $testeFuncionalId;
    }

    function setItemTesteId($itemTesteId) {
        $this->itemTesteId = $itemTesteId;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setResultado($resultado) {
        $this->resultado = $resultado;
    }

    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }


}
