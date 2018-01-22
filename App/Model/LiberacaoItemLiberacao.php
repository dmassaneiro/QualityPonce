<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LiberacaoItemLiberacao
 *
 * @author diegu
 */
class LiberacaoItemLiberacao {
    //put your code here
    private $liberacaoId;
    private $itemLiberacaoId;
    private $conferido;
    
    function getLiberacaoId() {
        return $this->liberacaoId;
    }

    function getItemLiberacaoId() {
        return $this->itemLiberacaoId;
    }

    function getConferido() {
        return $this->conferido;
    }

    function setLiberacaoId($liberacaoId) {
        $this->liberacaoId = $liberacaoId;
    }

    function setItemLiberacaoId($itemLiberacaoId) {
        $this->itemLiberacaoId = $itemLiberacaoId;
    }

    function setConferido($conferido) {
        $this->conferido = $conferido;
    }


}
