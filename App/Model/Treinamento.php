<?php


class Treinamento {
   
    private $id;
    private $descricao;
    private $localTreinamento;
    private $dataInicio;
    private $dataFim;
    private $aplicador;
    private $conteudo;
    private $descricaoMetodo;
    private $dataPrazo;
    private $dataVerificacao;
    private $evidencias;
    private $eficaz;
    private $responsavel;
    private $statusId;
    
    
    function getResponsavel() {
        return $this->responsavel;
    }

    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }

        function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getLocalTreinamento() {
        return $this->localTreinamento;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataFim() {
        return $this->dataFim;
    }

    function getAplicador() {
        return $this->aplicador;
    }

    function getConteudo() {
        return $this->conteudo;
    }

    function getDescricaoMetodo() {
        return $this->descricaoMetodo;
    }

    function getDataPrazo() {
        return $this->dataPrazo;
    }

    function getDataVerificacao() {
        return $this->dataVerificacao;
    }

    function getEvidencias() {
        return $this->evidencias;
    }

    function getEficaz() {
        return $this->eficaz;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setLocalTreinamento($localTreinamento) {
        $this->localTreinamento = $localTreinamento;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    function setAplicador($aplicador) {
        $this->aplicador = $aplicador;
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    function setDescricaoMetodo($descricaoMetodo) {
        $this->descricaoMetodo = $descricaoMetodo;
    }

    function setDataPrazo($dataPrazo) {
        $this->dataPrazo = $dataPrazo;
    }

    function setDataVerificacao($dataVerificacao) {
        $this->dataVerificacao = $dataVerificacao;
    }

    function setEvidencias($evidencias) {
        $this->evidencias = $evidencias;
    }

    function setEficaz($eficaz) {
        $this->eficaz = $eficaz;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }


    
}
