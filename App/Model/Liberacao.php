<?php

class Liberacao {

    //put your code here
    private $ItemLiberacaoId;
    private $FichaTecnica_id;
    private $conferido;

    function getItemLiberacaoId() {
        return $this->ItemLiberacaoId;
    }

    function getFichaTecnica_id() {
        return $this->FichaTecnica_id;
    }

    function getConferido() {
        return $this->conferido;
    }

    function setItemLiberacaoId($ItemLiberacaoId) {
        $this->ItemLiberacaoId = $ItemLiberacaoId;
    }

    function setFichaTecnica_id($FichaTecnica_id) {
        $this->FichaTecnica_id = $FichaTecnica_id;
    }

    function setConferido($conferido) {
        $this->conferido = $conferido;
    }

}
