<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreinamentoFuncionario
 *
 * @author diegu
 */
class TreinamentoFuncionario {
    //put your code here
    private $treinamentoId;
    private $funcionarioId;
    private $situacao;
    
    function getTreinamentoId() {
        return $this->treinamentoId;
    }

    function getFuncionarioId() {
        return $this->funcionarioId;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function setTreinamentoId($treinamentoId) {
        $this->treinamentoId = $treinamentoId;
    }

    function setFuncionarioId($funcionarioId) {
        $this->funcionarioId = $funcionarioId;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }


}
