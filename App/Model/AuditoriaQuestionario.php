<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuditoriaQuestionario
 *
 * @author diegu
 */
class AuditoriaQuestionario {
    //put your code here
    private $auditoriaId;
    private $itemQuestionarioId;
    private $resposta;
    private $evidencias;
    
    function getAuditoriaId() {
        return $this->auditoriaId;
    }

    function getItemQuestionarioId() {
        return $this->itemQuestionarioId;
    }

    function getResposta() {
        return $this->resposta;
    }

    function getEvidencias() {
        return $this->evidencias;
    }

    function setAuditoriaId($auditoriaId) {
        $this->auditoriaId = $auditoriaId;
    }

    function setItemQuestionarioId($itemQuestionarioId) {
        $this->itemQuestionarioId = $itemQuestionarioId;
    }

    function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    function setEvidencias($evidencias) {
        $this->evidencias = $evidencias;
    }


}
