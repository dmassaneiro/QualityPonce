<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Arquivo
 *
 * @author diegu
 */
class Arquivo {
    //put your code here
    private $caminho;
    private $documentoId;
    private $data;
    private $versao;
    
    function getVersao() {
        return $this->versao;
    }

    function setVersao($versao) {
        $this->versao = $versao;
    }

        
    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

        
    function getCaminho() {
        return $this->caminho;
    }

    function getDocumentoId() {
        return $this->documentoId;
    }

    function setCaminho($caminho) {
        $this->caminho = $caminho;
    }

    function setDocumentoId($documentoId) {
        $this->documentoId = $documentoId;
    }


}
