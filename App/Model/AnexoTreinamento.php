<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnexoTreinamento
 *
 * @author diegu
 */
class AnexoTreinamento {
    //put your code here
    private $caminho;
    private $treinamentoId;
    
    function getCaminho() {
        return $this->caminho;
    }

    function getTreinamentoId() {
        return $this->treinamentoId;
    }

    function setCaminho($caminho) {
        $this->caminho = $caminho;
    }

    function setTreinamentoId($treinamentoId) {
        $this->treinamentoId = $treinamentoId;
    }


}
