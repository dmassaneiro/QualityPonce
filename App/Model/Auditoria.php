<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auditoria
 *
 * @author diegu
 */
class Auditoria {
    //put your code here
    private $id;
    private $dataInicio;
    private $dataFim;
    private $objetivos;
    private $escopo;
    private $sugestao;
    private $conclusao;
    private $setorId;
    private $auditor;
    private $situacao;
    
    function getSituacao() {
        return $this->situacao;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

        
    function getSugestao() {
        return $this->sugestao;
    }

    function setSugestao($sugestao) {
        $this->sugestao = $sugestao;
    }

        
    function getAuditor() {
        return $this->auditor;
    }

    function setAuditor($auditor) {
        $this->auditor = $auditor;
    }

        
    function getId() {
        return $this->id;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataFim() {
        return $this->dataFim;
    }

    function getObjetivos() {
        return $this->objetivos;
    }

    function getEscopo() {
        return $this->escopo;
    }

    function getConclusao() {
        return $this->conclusao;
    }

    function getSetorId() {
        return $this->setorId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    function setObjetivos($objetivos) {
        $this->objetivos = $objetivos;
    }

    function setEscopo($escopo) {
        $this->escopo = $escopo;
    }

    function setConclusao($conclusao) {
        $this->conclusao = $conclusao;
    }

    function setSetorId($setorId) {
        $this->setorId = $setorId;
    }


}
