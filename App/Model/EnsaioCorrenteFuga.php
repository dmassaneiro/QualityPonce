<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnsaioCorrenteFuga
 *
 * @author diegu
 */
class EnsaioCorrenteFuga {
    //put your code here
    private $itemCorrenteFugaId;
    private $data;
    private $valorCa;
    private $valorCc;
    private $responsavel;
    private $FichaTecnica_id;
    private $modoId;
    
    function getItemCorrenteFugaId() {
        return $this->itemCorrenteFugaId;
    }

    function getData() {
        return $this->data;
    }

    function getValorCa() {
        return $this->valorCa;
    }

    function getValorCc() {
        return $this->valorCc;
    }

    function getResponsavel() {
        return $this->responsavel;
    }

    function getFichaTecnica_id() {
        return $this->FichaTecnica_id;
    }

    function getModoId() {
        return $this->modoId;
    }

    function setItemCorrenteFugaId($itemCorrenteFugaId) {
        $this->itemCorrenteFugaId = $itemCorrenteFugaId;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setValorCa($valorCa) {
        $this->valorCa = $valorCa;
    }

    function setValorCc($valorCc) {
        $this->valorCc = $valorCc;
    }

    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }

    function setFichaTecnica_id($FichaTecnica_id) {
        $this->FichaTecnica_id = $FichaTecnica_id;
    }

    function setModoId($modoId) {
        $this->modoId = $modoId;
    }


    
}
