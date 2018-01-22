<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnsaioItemCorrenteFuga
 *
 * @author diegu
 */
class EnsaioItemCorrenteFuga {
    //put your code here
    private $ensaioCorrenteFugaId;
    private $itemCorrenteFugaId;
    private $data;
    private $valorCa;
    private $valorCc;
    private $responsavel;
    
    function getEnsaioCorrenteFugaId() {
        return $this->ensaioCorrenteFugaId;
    }

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

    function setEnsaioCorrenteFugaId($ensaioCorrenteFugaId) {
        $this->ensaioCorrenteFugaId = $ensaioCorrenteFugaId;
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


}
